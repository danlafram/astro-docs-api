<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Models\Site;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($cloud_id)
    {
        $site = Site::where('cloud_id', '=', $cloud_id)->first();

        $queries = Query::where('site_id', '=', $site->id)->get();

        return response()->json([
            'queries' => $queries,
            'success' => true,
        ], 200);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Query $query)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Query $query)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Query $query)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Query $query)
    {
        //
    }
}
