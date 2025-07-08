<?php

namespace App\Http\Controllers;

use App\Jobs\IndexPageJob;
use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use App\Services\OpenSearchService;
use Illuminate\Support\Facades\Http;


class IndexingController extends Controller
{
    /**
     * This function handles the indexing of a Space in Confluence
     * 
     * Required parameters:
     * cloudId - String - UUID of the Atlassian tenant
     * spaceId - String - ID of the specific Confluence space
     */
    public function index_data(Request $request)
    {
        $batch = Bus::batch([]);

        // This function will now be responsible for creating a batch
        // and adding pages to the batch then returning the batch ID
        $api_token = $request->header()['x-forge-oauth-system'][0];

        $jwt_token = $request->bearerToken();

        $decoded_token = $this->decode_jwt($jwt_token);

        $cloud_id = $decoded_token->context->cloudId;

        // Get first 250 pages in the selected space
        $bodyContent = json_decode($request->getContent(), true);

        $space_id = $bodyContent['spaceId'];
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $api_token"
        ])->get("https://api.atlassian.com/ex/confluence/$cloud_id/wiki/api/v2/spaces/$space_id/pages");

        if ($response->status() === 200) {
            // Now loop over response body results and add a job to the batch with the ID of each page that isn't the space home page
            $confluence_response = json_decode($response->body());
            foreach ($confluence_response->results as $page) {
                if (isset($page->parentType)) {
                    $batch->add([
                        new IndexPageJob($page->id, $cloud_id, $api_token, $space_id)
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

    public function index_page(Request $request)
    {
        $api_token = $request->header()['x-forge-oauth-system'][0];

        $jwt_token = $request->bearerToken();

        $decoded_token = $this->decode_jwt($jwt_token);

        $cloud_id = $decoded_token->context->cloudId;

        $bodyContent = json_decode($request->getContent(), true);
        $page_id = $bodyContent['pageId'];
        
        $space_id = $bodyContent['spaceId'];


        // Dispatch the single job
        IndexPageJob::dispatch($page_id, $cloud_id, $api_token, $space_id);

        return response()->json([
            'success' => true,
        ], 200);
    }

    /**
     * TODO: Convert this to a job and handle async.
     * This function handles removing the page from Elastic search and the database
     * 
     * Required parameters:
     * confluence_id - String - ID of the specific Confluence page
     */
    public function delete_page(Request $request)
    {
        $bodyContent = json_decode($request->getContent(), true);

        $openSearchService = new OpenSearchService();

        $page = Page::where('confluence_id', '=', $bodyContent['confluence_id'])->first();

        $index = $page->site->index;

        $params = [
            'index' => $index,
            'id' => $bodyContent['confluence_id'], // Confluence page ID is unique enough since all users will have their own index.
        ];

        $openSearchService->client->delete($params);

        $page->delete();

        return response()->json(['success' => 'success'], 200);
    }

    /**
     * This function will handle the ability to re-index the data 
     */
    public function reindex_data(Request $request)
    {
        logger("Starting to reindex data...");
        $batch = Bus::batch([]);

        // This function will now be responsible for creating a batch
        // and adding pages to the batch then returning the batch ID
        $api_token = $request->header()['x-forge-oauth-system'][0];

        $jwt_token = $request->bearerToken();

        $decoded_token = $this->decode_jwt($jwt_token);

        $cloud_id = $decoded_token->context->cloudId;

        try {
            $site = Site::where('cloud_id', '=', $cloud_id)->first();
            $pages = $site->pages;

            // Now loop over response body results and add a job to the batch with the ID of each page that isn't the space home page
            foreach ($pages as $page) {
                $batch->add([
                    new IndexPageJob($page->confluence_id, $cloud_id, $api_token, $site->space_id)
                ]);
            }

            $batch->name("reindex-site")->dispatch();

            return response()->json([
                'batch' => $batch,
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            logger('Error occured in reindex method');
            logger(print_r($e->getMessage(), true));
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    private function decode_jwt($token)
    {
        return json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))));
    }
}
