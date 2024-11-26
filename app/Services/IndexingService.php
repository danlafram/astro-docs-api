<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Page;
use App\Models\Site;
use Illuminate\Support\Facades\Http;
use Elastic\Elasticsearch\ClientBuilder;

class IndexingService
{
    // Maybe use cloud_id instead of cloud_id here since its not used...
    public function index($page_id, $cloud_id, $api_token)
    {
        try {
            // Get the page data
            $page_data = $this->get_page_data($page_id, $cloud_id, $api_token);

            $site = Site::where('cloud_id', '=', $cloud_id)->first();

            // Index the page data
            $client = ClientBuilder::create()
                ->setHosts(['http://localhost:9200']) // TODO: Move to .env
                ->setApiKey('NTRjQUZKTUJaVHludXl4ZE81X246OXNFSWEzV1NSRmF4dlFMeUlnZ1hLQQ==') // TODO: Move to .env
                ->build();

            $params = [
                'index' => $site->index,
                'id' => $page_data->id, // TODO: Swap this out with $page_data
                'body'  => [
                    'title' => $page_data->title, // TODO: Swap this out with $page_data
                    'document' => $page_data->body->view->value, // TODO: Swap this out with $page_data
                    'stripped_document' => strip_tags($page_data->body->view->value) // TODO: Swap this out with $page_data
                ]
            ];

            $response = $client->index($params);

            $data = $response->asObject();

            $page = Page::firstOrCreate(
                ['confluence_id' => $page_data->id],
                [
                    'title' => $page_data->title,
                    'slug' => $this->get_slug($page_data->title),
                    'search_id' => $data->_id,
                    'confluence_id' => $page_data->id,
                    'confluence_created_at' => Carbon::parse($page_data->createdAt),
                    'confluence_updated_at' => Carbon::parse($page_data->version->createdAt),
                    'site_id' => $site->id,
                    'visible' => true,
                ]
            );

            return true;
        } catch (\Exception $e) {
            logger('Error processing index job');
            logger(print_r($e, true));
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
