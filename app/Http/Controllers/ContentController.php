<?php

namespace App\Http\Controllers;

use App\Jobs\TrackQueryJob;
use App\Models\ContentPage;
use App\Models\Page;
use App\Models\Site;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Services\OpenSearchService;
use App\Services\PageRepository;

class ContentController extends Controller
{

    /**
     * This function is responsible for searching elasticsearch based on the user's query.
     * Required parameters:
     * query - String - The search query that will be used to query Elasticsearch
     */
    public function search(Request $request)
    {
        // TODO: Cache these values
        $query = $request->input('query');

        $theme_id = tenant()->domain()->first()->theme_id;
        logger("Theme ID: " . $theme_id);
        $theme = Theme::find($theme_id);
        logger(print_r($theme, true));

        config()->set('pagebuilder.theme.active_theme', $theme->name);

        $pageBuilder = app()->make('phpPageBuilder', [
            'theme' => $theme->name
        ]);

         if(isset($query)){

            $page = (new PageRepository)->findWhere('name', 'Results');
    
            $renderedContent = $pageBuilder->pageBuilder->renderPage($page[0]);
            
            return response($renderedContent, 200)->header('Content-Type', 'text/html');

         } else {
            $page = (new PageRepository)->findWhere('name', 'Search');
    
            $renderedContent = $pageBuilder->pageBuilder->renderPage($page[0]);
            
            return response($renderedContent, 200)->header('Content-Type', 'text/html');
         }
    }

    public function live_search(Request $request)
    {   
        $query = $request->input('query');

        $openSearchService = new OpenSearchService();

        $index = tenant()->site->index;

        $params = [
            'index' => $index,
            'body'  => [
                'size' => 10,
                '_source' => false, // Don't get the full document yet
                'fields' => [
                    'title',
                ],
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['title', 'stripped_document']
                    ]
                ],
                'highlight' => [
                    'pre_tags' => ['<b>'],
                    'post_tags' => ['</b>'],
                    'fields' => [
                        'title' => [
                            'pre_tags' => ['<em class="font-bold">'], // TODO: Add inline styles here since they aren't getting picked up by Vite or something on the fly
                            'post_tags' => ['</em>']
                        ]
                    ]
                ]
            ]
        ];

        $response = $openSearchService->client->search($params);

        return response()->json([
            'success' => true,
            'results' => $response['hits']['hits']
        ], 200);
    }

    /**
     * This function will retrieve the page data and display it.
     * TODO: When implementing caching, cache a stringified object of { body, title, and last_updated } so we won't have to hit ES or MySQL on subsequent requests
     * TODO: Consider a cache key of 
     * TODO: I don't think this is being used anymore. Might be safe to remove.
     */
    public function renderPage(Request $request)
    {
        // TODO: First, check the Cache to see if we already have this page stored.
        try {
            // get the route URL
            $exploded_url = explode('/', $request->url());
            $page_slug = end($exploded_url);

            $page = ContentPage::where('slug', '=', $page_slug)->where('site_id', '=', tenant()->site->id)->first();

            if (!$page->visible) {
                $pages = ContentPage::where('visible', '=', 1)->where('page_id', '=', tenant()->site->id)->inRandomOrder()
                    ->limit(4)
                    ->get();
                return view('errors.404')->with('pages', $pages);
            }

            $openSearchService = new OpenSearchService();

            $index = tenant()->site->index;
            $params = [
                'index' => $index,
                'id'    => $page->search_id
            ];

            $response = $openSearchService->client->get($params);

            $page->increment('views'); // TODO: Put this on a queue

            // return the page with retrieved data
            return view('pages.page')
                ->with('body', $response['_source']['document']) // TODO: Cache this value
                ->with('title', $response['_source']['title']) // TODO: Cache this value
                ->with('last_updated', $page->confluence_updated_at); // TODO: Cache this value

        } catch (\Exception $e) {
            // TODO: Add some logging here that we could maybe surface to an internal tool to keep track of exceptions
            // Return 404
            // Make sure not to return a hidden/non-visible page
            logger('Error occured in renderPage method');
            logger(print_r($e->getMessage(), true));
            $pages = ContentPage::where('visible', '=', 1)->where('site_id', '=', tenant()->site->id)->inRandomOrder()
                ->limit(4)
                ->get();
            return view('errors.404')->with('pages', $pages);
        }
    }

    /**
     * Displays the search page with 4 random pages to suggest to users
     */
    public function showSearch(Request $request)
    {
        // First, get 4 (max) random pages
        // TODO: Random order now, but start tracking page analytics and display the most frequented pages (?)
        $site = Site::where('tenant_id', '=', tenant()->id)->first();
        $pages = ContentPage::where('visible', '=', 1)->where('site_id', '=', tenant()->site->id)->inRandomOrder()
            ->limit(4)
            ->get();

        return view('pages.search')->with('pages', $pages)->with('site_name', $site->site_name);
    }

    /**
     * Toggle and update the visibility of the specified page
     * Required parameters:
     * confluence_id - String - ID of the specific Confluence page
     */
    public function toggle_visibility(Request $request, string $id)
    {
        // Find the page based on the ID
        $page = ContentPage::find($id);
        // Update the visibility
        if (isset($page)) {
            $page->visible = !$page->visible;
            $page->update();
        } else {
            return response()->json(['success' => false, 'message' => "Page with ID {$id} not found"], 404);
        }

        return response()->json(['success' => true, 'message' => 'Successfully toggled page visibility'], 200);
    }

    /**
     * Return a list of all the indexed pages we have
     */
    public function indexed_pages(Request $request)
    {
        $jwt_token = $request->bearerToken();

        $decoded_token = $this->decode_jwt($jwt_token);

        $cloud_id = $decoded_token->context->cloudId;

        $site = Site::where('cloud_id', '=', $cloud_id)->first();

        $pages = ContentPage::where('site_id', '=', $site->id)->get(['id', 'title', 'visible', 'views', 'confluence_id', 'search_id']);

        return $pages;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $configuration = Configuration::create($request->except(['_token', 'images']));
        $page = ContentPage::create([
            'name' => $request->input('name'),
            'route' => $request->input('route'),
            'data' => $request->input('data'),
        ]);

        return $page;
    }

    private function decode_jwt($token)
    {
        return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));
    }
}
