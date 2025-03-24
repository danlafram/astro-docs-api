<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentPage;
use App\Models\Theme;
use App\Services\PageRepository;

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
        // Since we moved the page finding to FrontendSearchService, that now needs to handle 404 responses as well.
        try {
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
}
