<?php

namespace App\Jobs;

use App\Mail\NewInstallEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NewInstallJob implements ShouldQueue
{
    use Queueable;

    /**
     * The ID of the site we are indexing for
     */
    protected $site_name;

    /**
     * The ID of the space the page belongs to
     */
    protected $site_url;

    /**
     * Create a new job instance.
     */
    public function __construct($site_name, $site_url)
    {
        $this->site_name = $site_name;
        $this->site_url = $site_url;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send email
        try {
            // TODO: Queue the message instead of inline
            Mail::to('dan@spoke.dev')->send(new NewInstallEmail($this->site_name, $this->site_url));
        } catch(\Exception $e){
            // Return to error page.
            logger("failed to send new install message");
        }
    }
}
