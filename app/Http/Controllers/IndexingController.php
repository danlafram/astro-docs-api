<?php

namespace App\Http\Controllers;

use App\Jobs\IndexPageJob;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Http;
use Elastic\Elasticsearch\ClientBuilder;

class IndexingController extends Controller
{
    /**
     * TODO: Update this since it has changed
     * This function handles the indexing of a single page to ElasticSearch
     * 
     * Required parameters:
     * cloudId - String - UUID of the Atlassian tenant
     * confluence_id - String - ID of the specific Confluence page
     * title - String - The title of the Confluence page
     * document - String - The contents of the Confluence page
     */
    public function index_data(Request $request)
    {
        $batch = Bus::batch([]);

        // This function will now be responsible for creating a batch
        // and adding pages to the batch then returning the batch ID
        $api_token = $request->header()['x-forge-oauth-system'][0];

        // Get first 250 pages in the selected space
        $bodyContent = json_decode($request->getContent(), true);
        $space_id = $bodyContent['spaceId'];
        $cloud_id = $bodyContent['cloudId'];
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $api_token"
        ])->get("https://api.atlassian.com/ex/confluence/$cloud_id/wiki/api/v2/spaces/$space_id/pages");

        if($response->status() === 200){
            // Now loop over response body results and add a job to the batch with the ID of each page that isn't the space home page
            $confluence_response = json_decode($response->body());
            foreach($confluence_response->results as $page){
                if(isset($page->parentType)){
                    $batch->add([
                        new IndexPageJob($page->id, $cloud_id, $api_token)
                    ]);
                } else {
                    continue;
                }
            }

            $batch->name("index-site")->dispatch();

            return response()->json([
                'batch' => $batch,
                'success' => true,
            ], 200);
        } else {
            logger("Something went wrong with Confluence API request to get pages");
        }
    }

    /**
     * This function handles removing the page from Elastic search and the database
     * 
     * Required parameters:
     * confluence_id - String - ID of the specific Confluence page
     */
    public function delete_page(Request $request)
    {
        $bodyContent = json_decode($request->getContent(), true);

        $client = ClientBuilder::create()
            ->setHosts(['http://localhost:9200']) // TODO: Move to .env
            ->setApiKey('NTRjQUZKTUJaVHludXl4ZE81X246OXNFSWEzV1NSRmF4dlFMeUlnZ1hLQQ==') // TODO: Move to .env
            ->build();
        
        $index = tenant()->site->index;

        $params = [
            'index' => $index, 
            'id' => $bodyContent['confluence_id'], // Confluence page ID is unique enough since all users will have their own index.
        ];

        $client->delete($params);

        $page = Page::where('confluence_id', '=', $bodyContent['confluence_id'])->first();

        $page->delete();

        return response()->json(['success' => 'success'], 200);
    }
}
