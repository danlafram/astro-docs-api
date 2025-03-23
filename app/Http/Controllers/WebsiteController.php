<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use \Stripe\StripeClient;
use App\Models\Booking;
use App\Models\ContentPage;
use App\Models\Theme;
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
        $theme_id = tenant()->domain()->first()->theme_id;
        $theme = Theme::find($theme_id);
        config()->set('pagebuilder.theme.active_theme', $theme->name);
        $pageBuilder = app()->make('phpPageBuilder', [
            'theme' => $theme->name
        ]);
        $pageBuilder->handlePublicRequest();
    }

    // We will have to build this for astro-docs specific use case.
    public function page(Request $request)
    {   
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

            $theme_id = tenant()->domain()->first()->theme_id;
            $theme = Theme::find($theme_id);

            config()->set('pagebuilder.theme.active_theme', $theme->name);

            $pageBuilder = app()->make('phpPageBuilder', [
                'theme' => $theme->name
            ]);

            $page = (new PageRepository)->findWhere('name', 'Content');
    
            $renderedContent = $pageBuilder->pageBuilder->renderPage($page[0]);
            
            return response($renderedContent, 200)->header('Content-Type', 'text/html');

        } catch (\Exception $e) {
            // TODO: Add some logging here that we could maybe surface to an internal tool to keep track of exceptions
            // Return 404
            // Make sure not to return a hidden/non-visible page
            logger('Error occured in renderPage method');
            logger(print_r($e->getMessage(), true));
            $pages = ContentPage::where('visible', '=', 1)->where('site_id', '=', tenant()->site->id)->inRandomOrder()
                ->limit(4)
                ->get();
            // TODO: Not sure how this will work with page builder... Should probably return echo'd content instead.
            // This means we need a 404 page part of the default theme to.
            return view('errors.404')->with('pages', $pages);
        }
    }

    // public function show_listings()
    // {
    //     $pageBuilder = app()->make('phpPageBuilder');
    //     $page =  (new PageRepository)->findWhere('name', 'listings'); // This should always return the listing page
    //     $renderedContent = $pageBuilder->pageBuilder->renderPage($page[0]); // do we need to access [0] or can we just return first.

    //     echo $renderedContent;
    // }
}
