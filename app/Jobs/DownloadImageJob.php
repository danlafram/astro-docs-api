<?php

namespace App\Jobs;

use App\Services\ImageService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DownloadImageJob implements ShouldQueue
{
    use Queueable;

    /**
     * The ID of the image we are indexing
     */
    protected $image_id;

    /**
     * The ID of the site we are indexing for
     */
    protected $cloud_id;

    /**
     * The ID of the site we are indexing for
     */
    protected $api_token;

    /**
     * The ID of the space the page belongs to
     */
    protected $space_id;

    /**
     * The download URL of the image
     */
    protected $download_url;

    /**
     * Create a new job instance.
     */
    public function __construct($download_url, $api_token)
    {
        $this->download_url = $download_url;
        $this->api_token = $api_token;
    }

    /**
     * Execute the job.
     */
    public function handle(ImageService $imageService): void
    {
        $imageService->download_image($this->download_url, $this->api_token);
    }
}
