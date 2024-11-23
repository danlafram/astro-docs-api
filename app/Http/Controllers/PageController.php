<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\Request;
use Elastic\Elasticsearch\ClientBuilder;

class PageController extends Controller
{

    /**
     * This function is responsible for searching elasticsearch based on the user's query.
     * Required parameters:
     * query - String - The search query that will be used to query Elasticsearch
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $client = ClientBuilder::create()
            ->setHosts(['http://localhost:9200']) // TODO: Move to .env
            ->setApiKey('NTRjQUZKTUJaVHludXl4ZE81X246OXNFSWEzV1NSRmF4dlFMeUlnZ1hLQQ==') // TODO: Move to .env
            ->build();

        $index = tenant()->site->index;

        $params = [
            'index' => $index,
            'body'  => [
                'size' => 10,
                '_source' => false, // Don't get the full document yet
                'fields' => [
                    'title' // Only care about the field and the highlights (TODO: highlights)
                ],
                'query' => [
                    'match' => [
                        'stripped_document' => $query
                    ]
                ],
                'highlight' => [
                    'pre_tags' => ['<b>'],
                    'post_tags' => ['</b>'],
                    'fields' => [
                        'stripped_document' => [
                            'pre_tags' => ['<em class="font-bold">'],
                            'post_tags' => ['</em>']
                        ]
                    ]
                ]
            ]
        ];

        $response = $client->search($params);
        $data = $response->asObject();

        return view('pages.results')->with('results', $data->hits->hits)->with('query', $query)->with('hits', $data->hits->total->value);
    }

    /**
     * This function will retrieve the page data and display it.
     * TODO: When implementing caching, cache a stringified object of { body, title, and last_updated } so we won't have to hit ES or MySQL on subsequent requests
     * TODO: Consider a cache key of 
     */
    public function renderPage(Request $request)
    {
        // TODO: First, check the Cache to see if we already have this page stored.
        try {
            // get the route URL
            $url = explode('/', $request->url());
            $page_slug = end($url);

            $page = Page::where('slug', '=', $page_slug)->first();

            if(!$page->visible){
                $pages = Page::where('visible', '=', 1)->inRandomOrder()
                ->limit(4)
                ->get();
                return view('errors.404')->with('pages', $pages);
            }

            // get the page associated to it
            $client = ClientBuilder::create()
                ->setHosts(['http://localhost:9200']) // TODO: Move to .env
                ->setApiKey('NTRjQUZKTUJaVHludXl4ZE81X246OXNFSWEzV1NSRmF4dlFMeUlnZ1hLQQ==') // TODO: Move to .env
                ->build();
            $index = tenant()->site->index;
            $params = [
                'index' => $index,
                'id'    => $page->search_id
            ];

            $response = $client->get($params);
            $data = $response->asObject();

            defer(fn() => $page->increment('views'));

            // return the page with retrieved data
            return view('pages.page')
                        ->with('body', $data->_source->document) // TODO: Cache this value
                        ->with('title', $data->_source->title) // TODO: Cache this value
                        ->with('last_updated', $page->confluence_updated_at); // TODO: Cache this value
        } catch (\Exception $e) {
            // TODO: Add some logging here that we could maybe surface to an internal tool to keep track of exceptions
            // Return 404
            // Make sure not to return a hidden/non-visible page
            logger(print_r($e, true));
            $pages = Page::where('visible', '=', 1)->inRandomOrder()
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
        $pages = Page::inRandomOrder()
            ->limit(4)
            ->get();

        return view('pages.search')->with('pages', $pages)->with('site_name', $site->site_name);
    }

    /**
     * Toggle and update the visibility of the specified page
     * Required parameters:
     * confluence_id - String - ID of the specific Confluence page
     */
    public function toggleVisibility(string $id)
    {
        // Find the page based on the ID
        $page = Page::find($id);
        // Update the visibility
        if(isset($page)){
            $page->visible = !$page->visible;
            $page->update();
        } else {
            return response()->json(['success' => false, 'message' => "Page with ID {$id} not found"], 404);
        }

        return response()->json(['success' => true, 'message' => 'Successfully toggled page visibility'], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $configuration = Configuration::create($request->except(['_token', 'images']));
        $page = Page::create([
            'name' => $request->input('name'),
            'route' => $request->input('route'),
            'data' => $request->input('data'),
        ]);

        return $page;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //   
    }
}
