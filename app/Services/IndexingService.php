<?php

namespace App\Services;

use App\Jobs\DownloadImageJob;
use App\Jobs\IndexImage;
use Carbon\Carbon;
use App\Models\ContentPage;
use App\Models\Image;
use App\Models\Site;
use App\Services\OpenSearchService;
use DOMDocument;
use DOMXPath;
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

            $html = $page_data->body->view->value;

            $parsed_html = $this->parse_img_tags($html, $cloud_id, $page_id);

            $params = [
                'index' => $site->index,
                'id' => $page_data->id,
                'body'  => [
                    'title' => $page_data->title,
                    // TODO: Modify image tag here to swag out all values and add CDN link instead
                    'document' => $parsed_html,
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

    /**
     * TODO: Add comments
     * TODO: Add try/catch to the call to atlassian API
     */
    public function index_image($page_id, $cloud_id, $api_token, $space_id)
    {
        // Get the attachments on the page
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => "Bearer $api_token"
        ])->get("https://api.atlassian.com/ex/confluence/$cloud_id/wiki/api/v2/pages/$page_id/attachments");

        if ($response->status() === 200) {
            $results = json_decode($response->body());
            if(!empty($results->results)){
                foreach($results->results as $attachment){
                    if(str_contains($attachment->mediaType, 'image')){
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
                        DownloadImageJob::dispatch("https://api.atlassian.com/ex/confluence/$cloud_id/wiki/rest/api/content/$page_id/child/attachment/$attachment->id/download", $api_token, $cloud_id, $attachment->title);
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

    /**
     * This function is responsible for replace existing img tags with previous Confulence CDN links
     * with Astro Docs CDN links
     */
    private function parse_img_tags($html, $cloud_id, $page_id)
    {
        // Extract the name of the image from the property 'data-linked-resource-default-alias' inside img tag
        $doc = new DOMDocument();
        // There were some weird encoding things happening usign saveHTML so we need to force the encoding to avoid it
        $doc->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($doc);

        // Get img tags
        $img_tags = $xpath->evaluate("//img");

        // Loop through the source tags
        if(!empty($img_tags)){
            foreach($img_tags as $img_tag){
                // Extract the file name from property 'data-linked-resource-default-alias'
                $img_name = $img_tag->getAttribute("data-linked-resource-default-alias");

                $new_src_value = "https://d20jnt108amegu.cloudfront.net/$cloud_id/$img_name";

                // Remove all attribute tags Confluence adds
                while ($img_tag->hasAttributes()){
                    $img_tag->removeAttributeNode($img_tag->attributes->item(0));
                }
                
                // Then swap out the src URL for each img tag
                $img_tag->setAttribute('src', $new_src_value);
            }
        } else { 
            return $html;
        }

        return $doc->saveHTML();
    }
}
