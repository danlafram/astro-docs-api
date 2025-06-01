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
    public function download_image($download_url, $api_token)
    {
        // Download the contents, or hybrid upload to the CDN.
        try {
            logger("Download URL: " . $download_url);
            
            $response = Http::withHeaders([
                'Authorization' => "Bearer $api_token"
            ])->get($download_url); // Generate this instead of static...

            logger($response->status());

            logger(print_r($response->body(), true));

            $imageContent = $response->body();

            Storage::disk('local')->put('imagee.jpg', $imageContent);
        } catch(\Exception $e){
            logger($e->getMessage());
            logger("failed to download the attachment");
        }
    }
}
