<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Elastic\Elasticsearch\ClientBuilder;

class SiteController extends Controller
{
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
        // Create the new site for the user
        $bodyContent = json_decode($request->getContent(), true);

        // Create an ES index
        $client = ClientBuilder::create()
            ->setHosts(['http://localhost:9200']) // TODO: Move to .env
            ->setApiKey('NTRjQUZKTUJaVHludXl4ZE81X246OXNFSWEzV1NSRmF4dlFMeUlnZ1hLQQ==') // TODO: Move to .env
            ->build();
        
        $params = [
            'index' => str_replace('-', '_', $bodyContent['siteName']), // Format is spoke_dev instead of spoke-dev
        ];
        
        $response = $client->indices()->create($params);
        $data = $response->asObject();

        // Store the site with any additional details provided
        $site = Site::create([
            'siteName' => $bodyContent['siteName'],
            'cloudId' => $bodyContent['cloudId'],
            'siteUrl' => $bodyContent['siteUrl'],
            'installerAccountId' => $bodyContent['installerAccountId'],
            'ownerAccountId' => $bodyContent['ownerAccountId'],
            'index' => $data->index
        ]);
        // Anything else?
        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $cloudId)
    {
        $site = Site::where('cloudId', '=', $cloudId)->first();
        if(isset($site)){
            // Installation not required. Exisitng account
            // Return all of the indexed pages for this site
            return response()->json(['success' => true, 'site' => $site], 200);
        } else {
            // First time logging in. We will require a bit of installation
            // Need them to give us a name for the site (or just default to the atlassian URL?)
            // Site names have to be unique for domains and tenancy
            return response()->json(['success' => false], 200); // Update this
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        //
    }
}
