<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Page;
use App\Models\Site;
use App\Services\OpenSearchService;
use Illuminate\Support\Facades\Http;

class IndexingService
{
    /**
     * This function is responsible for indexing a specific Confluence page in Opensearch.
     */
    public function index($page_id, $cloud_id, $api_token, $space_id)
    {
        try {
            // Get the page data
            $page_data = $this->get_page_data($page_id, $cloud_id, $api_token);

            $site = Site::where('cloud_id', '=', $cloud_id)->first();

            // Sometimes, the app can be installed but not actually setup.
            if(!isset($site)){
                return true;
            }

            // Check if the page is even part of the Space we have indexed.
            // Currently only allowed to index one Space
            if($site->space_id !== $space_id){
                return true;
            }


            // Index the page data
            $openSearchService = new OpenSearchService();

            $params = [
                'index' => $site->index,
                'id' => $page_data->id,
                'body'  => [
                    'title' => $page_data->title,
                    'document' => $page_data->body->view->value,
                    'stripped_document' => strip_tags($page_data->body->view->value)
                ]
            ];

            $response = $openSearchService->client->index($params);

            $page = Page::where('confluence_id', '=', $page_data->id)
                            ->where('search_id', '=', $response['_id'])
                            ->first();

            if (isset($page)) {
                // Update it
                $page->title = $page_data->title;
                $page->slug = $this->get_slug($page_data->title);
                $page->confluence_updated_at = Carbon::parse($page_data->version->createdAt);
                $page->save();
            } else {
                $page = Page::firstOrCreate(
                    ['confluence_id' => $page_data->id],
                    [
                        'title' => $page_data->title,
                        'slug' => $this->get_slug($page_data->title),
                        'search_id' => $response['_id'],
                        'confluence_id' => $page_data->id,
                        'confluence_created_at' => Carbon::parse($page_data->createdAt),
                        'confluence_updated_at' => Carbon::parse($page_data->version->createdAt),
                        'site_id' => $site->id,
                        'visible' => true,
                    ]
                );
            }

            return true;
        } catch (\Exception $e) {
            logger('Error processing index job');
            logger(print_r($e->getMessage(), true));
            
        }
    }

    private function get_page_data($page_id, $cloud_id, $api_token)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $api_token"
        ])->get("https://api.atlassian.com/ex/confluence/$cloud_id/wiki/api/v2/pages/$page_id?body-format=view");
        
        if ($response->status() === 200) {
            return json_decode($response->body());
        }
    }

    private function get_slug($string)
    {
        $updated_string = strtolower(str_replace(' ', '-', $string));
        return preg_replace('/[^A-Za-z0-9\-]/', '', $updated_string);
    }
}
