<?php

namespace App\Services;

use App\Jobs\IndexImage;
use Carbon\Carbon;
use App\Models\ContentPage;
use App\Models\Image;
use App\Models\Site;
use App\Services\OpenSearchService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * This function is responsible for downloading the image from Confluence and 
     * Uploading it to the CDN so it can be referenced in the web.
     */
    public function download_image($download_url, $api_token, $cloud_id, $img_title)
    {
        // Download the contents, or hybrid upload to the CDN.
        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer $api_token"
            ])->get($download_url); // Generate this instead of static...

            $imageContent = $response->body();

            // Swap this out for a CDN
            // Maybe use the site name or site ID as the storage prefix? Would be way nicer/readable as site name
            // Maybe also use page ID as prefix so there layers? Is that necessary?
            $res = Storage::disk('s3')->put("$cloud_id/$img_title", $imageContent);
        } catch(\Exception $e){
            logger($e->getMessage());
            logger("failed to upload attachment to CDN");
        }
    }
}
