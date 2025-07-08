<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;
use PHPageBuilder\PHPageBuilder;
use Throwable;

class PageBuilderController extends Controller
{
    /**
     * Edit the given page with the page builder.
     *
     * @param int|null $pageId
     * @throws Throwable
     */
    public function build($pageId = null)
    {
        // Set theme ID dynamically
        $theme_id = tenant()->domain()->first()->theme_id;
        $theme = Theme::find($theme_id);

        config(['pagebuilder.theme.active_theme' => $theme->name]);

        $route = $_GET['route'] ?? null;
        $action = $_GET['action'] ?? null;
        $pageId = is_numeric($pageId) ? $pageId : ($_GET['page'] ?? null);
        $pageRepository = new \App\Services\PageRepository;
        $page = $pageRepository->findWithId($pageId);
        
        $phpPageBuilder = new PHPageBuilder(config('pagebuilder'));

        $customScripts = view("pagebuilder.scripts")->render();
        $phpPageBuilder->getPageBuilder()->customScripts('head', $customScripts);

        $phpPageBuilder->getPageBuilder()->handleRequest($route, $action, $page);
    }
}
