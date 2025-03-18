<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $route = $_GET['route'] ?? null;
        $action = $_GET['action'] ?? null;
        $pageId = is_numeric($pageId) ? $pageId : ($_GET['page'] ?? null);
        $pageRepository = new \App\Services\PageRepository;
        $page = $pageRepository->findWithId($pageId);

        $phpPageBuilder = app()->make('phpPageBuilder');
        $pageBuilder = $phpPageBuilder->getPageBuilder();

        $customScripts = view("pagebuilder.scripts")->render();
        $pageBuilder->customScripts('head', $customScripts);

        $pageBuilder->handleRequest($route, $action, $page);
    }
}
