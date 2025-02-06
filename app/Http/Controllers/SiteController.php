<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Page;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Services\OpenSearchService;

class SiteController extends Controller
{
    /**
     * Create a new site and an index to go with that site.
     * TODO: Site names need to be unique since, but Atlassian should be good at handling that for us already
     * Required parameters:
     * siteName - String - The name of the Atlassian site (e.g spoke-dev)
     * cloudId - String - UUID of the Atlassian tenant
     * siteUrl - String - The domain of the Atlassian tenant
     * installerAccountId - String - Atlassian ID of the person installing the
     * ownerAccountId - String - Atlassian ID of the person who owns the app
     */
    public function store(Request $request)
    {
        // Create the new site for the user
        $bodyContent = json_decode($request->getContent(), true);

        $jwt_token = $request->bearerToken();

        $decoded_token = $this->decode_jwt($jwt_token);

        $cloud_id = $decoded_token->context->cloudId;
        
        // Create an OS index
        $openSearchService = new OpenSearchService();
        
        $params = [
            'index' => str_replace('-', '_', $bodyContent['siteName']), // Format is spoke_dev instead of spoke-dev
        ];
        
        $response = $openSearchService->client->indices()->create($params);

        // Create the tenant here
        $tenant = Tenant::create();

        // Store the site with any additional details provided
        $site = Site::create([
            'site_name' => $bodyContent['siteName'],
            'cloud_id' => $cloud_id,
            'site_url' => $bodyContent['siteUrl'],
            'installer_account_id' => $bodyContent['installerAccountId'],
            'owner_account_id' => $bodyContent['ownerAccountId'],
            'index' => $response['index'],
            'tenant_id' => $tenant->id
        ]);

        $tenant->domains()->create(['domain' => $bodyContent['siteName'] . '.' . config('app.suffix_domain')]);
        
        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Returns the site associated with the cloudId
     * Required parameters:
     * cloudId - String - UUID of the Atlassian tenant
     */
    public function show(Request $request)
    {
        $jwt_token = $request->bearerToken();

        $decoded_token = $this->decode_jwt($jwt_token);

        $cloud_id = $decoded_token->context->cloudId;

        $site = Site::where('cloud_id', '=', $cloud_id)->first();
        
        if(isset($site)){
            $pages = Page::where('site_id', '=', $site->id)->get(['id', 'title', 'visible', 'views', 'confluence_id', 'search_id']);
            // Installation not required. Exisitng account
            // Return all of the indexed pages for this site
            return response()->json(['success' => true, 'pages' => $pages], 200); // TODO: Consider optimizign by only getting the page attributes we need
        } else {
            // First time logging in. We will require a bit of installation
            // Need them to give us a name for the site (or just default to the atlassian URL?)
            // Site names have to be unique for domains and tenancy
            return response()->json(['success' => false], 200); // TODO: Update this
        }
    }

    private function decode_jwt($token)
    {
        return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));
    }
}
