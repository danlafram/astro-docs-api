<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use \Stripe\StripeClient;
use App\Models\Booking;
use App\Models\ContentPage;
use App\Services\OpenSearchService;
use App\Services\PageRepository;
use Carbon\Carbon;
use \DateTime;

class WebsiteController extends Controller
{
    /**
     * Show the website page that corresponds with the current URI.
     */
    public function uri(Request $request)
    {
        $theme = tenant()->domain()->first()->active_theme;
        config()->set('pagebuilder.theme.active_theme', $theme);
        $pageBuilder = app()->make('phpPageBuilder', [
            'theme' => $theme
        ]);
        $pageBuilder->handlePublicRequest();
    }

    // We will have to build this for astro-docs specific use case.
    public function page(Request $request)
    {
        $exploded_url = explode('/', $request->url());
        $page_slug = end($exploded_url); // Use the page slug to find the content
        dd($page_slug);
        
        // try {
        //     // get the route URL
        //     $exploded_url = explode('/', $request->url());
        //     $page_slug = end($exploded_url);

        //     $page = ContentPage::where('slug', '=', $page_slug)->where('site_id', '=', tenant()->site->id)->first();

        //     if (!$page->visible) {
        //         $pages = ContentPage::where('visible', '=', 1)->where('page_id', '=', tenant()->site->id)->inRandomOrder()
        //             ->limit(4)
        //             ->get();
        //         return view('errors.404')->with('pages', $pages);
        //     }

        //     $openSearchService = new OpenSearchService();

        //     $index = tenant()->site->index;
        //     $params = [
        //         'index' => $index,
        //         'id'    => $page->search_id
        //     ];

        //     $response = $openSearchService->client->get($params);

        //     $page->increment('views'); // TODO: Put this on a queue

        //     // return the page with retrieved data
        //     // TODO: Need to echo this out instead of returning a page
        //     return view('pages.page')
        //         ->with('body', $response['_source']['document']) // TODO: Cache this value
        //         ->with('title', $response['_source']['title']) // TODO: Cache this value
        //         ->with('last_updated', $page->confluence_updated_at); // TODO: Cache this value

        // } catch (\Exception $e) {
        //     // TODO: Add some logging here that we could maybe surface to an internal tool to keep track of exceptions
        //     // Return 404
        //     // Make sure not to return a hidden/non-visible page
        //     logger('Error occured in renderPage method');
        //     logger(print_r($e->getMessage(), true));
        //     $pages = ContentPage::where('visible', '=', 1)->where('site_id', '=', tenant()->site->id)->inRandomOrder()
        //         ->limit(4)
        //         ->get();
        //     // TODO: Not sure how this will work with page builder... Should probably return echo'd content instead.
        //     return view('errors.404')->with('pages', $pages);
        // }

        // $pageBuilder = app()->make('phpPageBuilder');
        // $page = (new PageRepository)->findWhere('name', 'content'); // findWhere is using tenant_id.
        
        // $renderedContent = $pageBuilder->pageBuilder->renderPage($page[0]); // do we need to access [0] or can we just return first.
        // echo $renderedContent;
    }

    // public function show_listings()
    // {
    //     $pageBuilder = app()->make('phpPageBuilder');
    //     $page =  (new PageRepository)->findWhere('name', 'listings'); // This should always return the listing page
    //     $renderedContent = $pageBuilder->pageBuilder->renderPage($page[0]); // do we need to access [0] or can we just return first.

    //     echo $renderedContent;
    // }
}
