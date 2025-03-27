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
            'theme' => $theme->name,
        ]);
        $pageBuilder->handlePublicRequest();
    }

    // We will have to build this for astro-docs specific use case.
    public function page(Request $request)
    {
        $theme_id = tenant()->domain()->first()->theme_id;
        $theme = Theme::find($theme_id);

        config()->set('pagebuilder.theme.active_theme', $theme->name);

        $pageBuilder = app()->make('phpPageBuilder', [
            'theme' => $theme->name,
        ]);

        // Since we moved the page finding to FrontendSearchService, that now needs to handle 404 responses as well.
        // Consider caching this page since we know the FronEndSearchService will need this exact information.
        try {
            $path = $request->getPathInfo();
            $exploded_path = explode('/', $path);
            $slug = end($exploded_path);

            $page = ContentPage::where('slug', '=', $slug)
            ->where('site_id', '=', tenant()->site->id)
            ->first();

            if(!isset($page) || !$page->visible){
                // Page not found or is not set to be visible, return 404
                $page = (new PageRepository())->findWhere('name', '404');

                $renderedContent = $pageBuilder->pageBuilder->renderPage($page[0]);

                return response($renderedContent, 200)->header('Content-Type', 'text/html');
            }

            $page = (new PageRepository())->findWhere('name', 'content');

            $renderedContent = $pageBuilder->pageBuilder->renderPage($page[0]);

            return response($renderedContent, 200)->header('Content-Type', 'text/html');
        } catch (\Exception $e) {
            // Return 404 if anything goes wrong above...
            logger('Error occured in renderPage method');
            logger(print_r($e->getMessage(), true));

            $page = (new PageRepository())->findWhere('name', '404');

            $renderedContent = $pageBuilder->pageBuilder->renderPage($page[0]);

            return response($renderedContent, 200)->header('Content-Type', 'text/html');
        }
    }
}
