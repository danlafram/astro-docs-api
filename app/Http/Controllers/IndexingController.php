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
     * This function handles the indexing of a single page to ElasticSearch
     * 
     * Required parameters:
     * cloudId - String - UUID of the Atlassian tenant
     * confluence_id - String - ID of the specific Confluence page
     * title - String - The title of the Confluence page
     * document - String - The contents of the Confluence page
     */
    public function indexData(Request $request)
    {
        logger("starting index data request...");
        $batch = Bus::batch([]);

        // TODO: Take most of this logic out and put it into the IndexingService
        // This function will now be responsible for creating a batch
        // and adding pages to the batch then returning the batch ID
        // logger("Indexing single document...");
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
        }

        // // Get the site we are using
        // logger("Getting site...");
        // $site = Site::where('cloud_id', '=', $bodyContent['cloudId'])->first();
        // logger("Getting site...");
        
        // $client = ClientBuilder::create()
        //     ->setHosts(['http://localhost:9200']) // TODO: Move to .env
        //     ->setApiKey('NTRjQUZKTUJaVHludXl4ZE81X246OXNFSWEzV1NSRmF4dlFMeUlnZ1hLQQ==') // TODO: Move to .env
        //     ->build();

        // $params = [
        //     'index' => $site->index,
        //     'id' => $bodyContent['confluence_id'], // Confluence page ID is unique enough since all users will have their own index.
        //     'body'  => [
        //         'title' => $bodyContent['title'],
        //         'document' => $bodyContent['document'],
        //         'stripped_document' => strip_tags($bodyContent['document'])
        //     ]
        // ];

        // $response = $client->index($params);

        // $data = $response->asObject();

        // // Ensure the page isn't already indexed before creating using firstOrCreate.
        // // TODO: Add tenant_id to the query to ensure absolute uniqueness.
        // $page = Page::firstOrCreate(
        //     ['confluence_id' => $bodyContent['confluence_id']],
        //     [
        //         'title' => $bodyContent['title'],
        //         'slug' => $this->getSlug($bodyContent['title']),
        //         'search_id' => $data->_id,
        //         'confluence_id' => $bodyContent['confluence_id'],
        //         'confluence_created_at' => Carbon::parse($bodyContent['confluence_created_at']),
        //         'confluence_updated_at' => Carbon::parse($bodyContent['confluence_updated_at']),
        //         'site_id' => $site->id,
        //         'visible' => true,
        //     ]
        // );

        // return response()->json(['success' => true, 'page' => $page], 200);
    }

    /**
     * This function handles removing the page from Elastic search and the database
     * 
     * Required parameters:
     * confluence_id - String - ID of the specific Confluence page
     */
    public function deletePage(Request $request)
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

    private function getSlug($string)
    {
        $updated_string = strtolower(str_replace(' ', '-', $string));
        return preg_replace('/[^A-Za-z0-9\-]/', '', $updated_string);
    }
}
