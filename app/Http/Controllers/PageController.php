<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Elastic\Elasticsearch\ClientBuilder;

class PageController extends Controller
{

    /**
     * This function is responsible for searching elasticsearch based on the user's query.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $client = ClientBuilder::create()
            ->setHosts(['http://localhost:9200']) // TODO: Move to .env
            ->setApiKey('NTRjQUZKTUJaVHludXl4ZE81X246OXNFSWEzV1NSRmF4dlFMeUlnZ1hLQQ==') // TODO: Move to .env
            ->build();

        $params = [
            'index' => 'astro-docs',
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
     * 
     */
    public function renderPage(Request $request)
    {
        try {
            // get the route URL
            $url = explode('/', $request->url());
            $page_slug = end($url);

            $page = Page::where('slug', '=', $page_slug)->first();

            // get the page associated to it
            $client = ClientBuilder::create()
                ->setHosts(['http://localhost:9200']) // TODO: Move to .env
                ->setApiKey('NTRjQUZKTUJaVHludXl4ZE81X246OXNFSWEzV1NSRmF4dlFMeUlnZ1hLQQ==') // TODO: Move to .env
                ->build();

            $params = [
                'index' => 'astro-docs', // TODO: Made this dynamic depending on the tenant
                'id'    => $page->search_id // TODO - swap this out with something dynamic based on page rendering strategy
            ];

            $response = $client->get($params);
            $data = $response->asObject();

            defer(fn() => $page->increment('views'));

            // return the page with retrieved data
            return view('pages.page')
                        ->with('body', $data->_source->document)
                        ->with('title', $data->_source->title)
                        ->with('last_updated', $page->confluence_updated_at);
        } catch (\Exception $e) {
            // TODO: Add some logging here that we could maybe surface to an internal tool to keep track of exceptions
            // Return 404
            logger($e);
            $pages = Page::inRandomOrder()
                ->limit(4)
                ->get();
            return view('errors.404')->with('pages', $pages);
        }
    }

    /**
     * Displays the search page alongside any useful data
     */
    public function showSearch(Request $request)
    {
        // First, get 4 (max) random pages
        // TODO: Random order now, but start tracking page analytics and display the most frequented pages (?)
        $pages = Page::inRandomOrder()
            ->limit(4)
            ->get();


        return view('pages.search')->with('pages', $pages);
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
