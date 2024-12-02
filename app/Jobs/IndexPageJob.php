<?php

namespace App\Jobs;

use App\Services\IndexingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Batchable;

class IndexPageJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

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
     * Create a new job instance.
     */
    public function __construct($page_id, $cloud_id, $api_token)
    {
        $this->page_id = $page_id;
        $this->cloud_id = $cloud_id;
        $this->api_token = $api_token;
    }

    /**
     * Execute the job.
     */
    public function handle(IndexingService $indexingService): void
    {
        $indexingService->index($this->page_id, $this->cloud_id, $this->api_token);
    }
}
