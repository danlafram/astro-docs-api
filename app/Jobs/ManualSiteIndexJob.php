<?php

namespace App\Jobs;

use App\Models\Site;
use Illuminate\Support\Facades\Bus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ManualSiteIndexJob implements ShouldQueue
{
    use Queueable;

    /**
     * The ID of the site we want to re-index
     */
    protected $site_id;

    /**
     * Create a new job instance.
     */
    public function __construct($site_id)
    {
        $this->site_id = $site_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get the site
        // Get all pages in the site
        // Batch IndexPageJob
        // Run batch
        $site = Site::find($this->site_id);
        if(isset($site)){
            $batch = Bus::batch([]);
            // foreach($site->pages as $page){
            //     $batch->add([
            //         new IndexPageJob($page->id, $site->cloud_id, $site->api_token) // TODO: Once $api_token is on the site model, make this a thing
            //     ]);
            // }
        }
    }
}
