<?php

namespace App\Jobs;

use App\Services\IndexingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class IndexImage implements ShouldQueue
{
    use Queueable;

    /**
     * The ID of the space we are indexing
     */
    protected $page_id;

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
     * Create a new job instance.
     */
    public function __construct($page_id, $cloud_id, $api_token, $space_id)
    {
        $this->page_id = $page_id;
        $this->cloud_id = $cloud_id;
        $this->api_token = $api_token;
        $this->space_id = $space_id;
    }

    /**
     * Execute the job.
     */
    public function handle(IndexingService $indexingService): void
    {
        $indexingService->index_image($this->page_id, $this->cloud_id, $this->api_token, $this->space_id);
    }
}
