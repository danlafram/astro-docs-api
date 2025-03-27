<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;
use App\Models\Page;
use App\Models\Query;
use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $site = Site::where('tenant_id', '=', tenant()->id)->first();
        
        $pages = ContentPage::where('site_id', '=', $site->id)->get();

        $queries = Query::where('site_id', '=', $site->id)->get();

        return view('dashboard')->with('pages', $pages)->with('queries', $queries);
    }
}
