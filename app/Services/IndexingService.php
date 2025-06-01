<?php

namespace App\Services;

use App\Jobs\DownloadImageJob;
use App\Jobs\IndexImage;
use Carbon\Carbon;
use App\Models\ContentPage;
use App\Models\Image;
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

            $page = ContentPage::where('confluence_id', '=', $page_data->id)
                            ->where('search_id', '=', $response['_id'])
                            ->first();

            if (isset($page)) {
                // Update it
                $page->title = $page_data->title;
                $page->slug = $this->get_slug($page_data->title);
                $page->confluence_updated_at = Carbon::parse($page_data->version->createdAt);
                $page->save();
            } else {
                $page = ContentPage::firstOrCreate(
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

            // From here, kick off the image indexing job
            IndexImage::dispatch($page_id, $cloud_id, $api_token, $space_id);

            return true;
        } catch (\Exception $e) {
            logger('Error processing index job');
            logger(print_r($e->getMessage(), true));
            
        }
    }

    public function index_image($page_id, $cloud_id, $api_token, $space_id)
    {
        // Get the attachments on the page
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $api_token"
        ])->get("https://api.atlassian.com/ex/confluence/$cloud_id/wiki/api/v2/pages/$page_id/attachments");
        
        // logger(print_r($response, true));

        if ($response->status() === 200) {
            $results = json_decode($response->body());
            if(!empty($results->results)){
                logger("There are attachments on this page");
                foreach($results->results as $attachment){
                    if(str_contains($attachment->mediaType, 'image')){
                        logger("Page ID: " . $page_id);
                        logger("Attachment ID: " . $attachment->id);

                        logger($api_token);
                        // Extract things like file size, title, anything else useful and store it.
                        // This should be create or update so we don't duplicate
                        // This also might not even need to be persisted, but just cached temporarily.
                        // $image = Image::create([
                        //     'title' => $attachment->title,
                        //     'media_type' => $attachment->mediaType,
                        //     'download_link' => $attachment->downloadLink,
                        //     'file_size' => $attachment->fileSize,
                        //     'attachment_id' => $attachment->id,
                        // ]);
                        // Dispatch new job to actually download the link
                        DownloadImageJob::dispatch("https://api.atlassian.com/ex/confluence/$cloud_id/wiki/rest/api/content/$page_id/child/attachment/$attachment->id/download", $api_token);
                    } else {
                        // Ignore for now, but think about handling video here.
                    }
                    // Check if attachment is an image. Don't do videos yet.
                }
                // Loop through them, create resources in DB, 
                // and enqueue new jobs
                // Extract the URL and metadata (size, extension, etc.)

                // Store the metadata in DB

                // Tract the full URL and what the created URL will be on CDN

                // Send the image content to CDN using another background job
                // Consider passing the batch ID and adding these jobs to the 
                // batch so that indexing times are accurate
            } else {
                return;
            }
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
