<?php

namespace App\Jobs;

use App\Models\Query;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TrackQueryJob implements ShouldQueue
{
    use Queueable;

    protected $query;

    protected $site_id;

    protected $hits;

    /**
     * Create a new job instance.
     */
    public function __construct($query, $site_id, $hits)
    {
        $this->query = $query;
        $this->site_id = $site_id;
        $this->hits = $hits;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // TODO
        // Get existing query, if it doesn't exist, create it
        // Add any relevant information to the query
        $query = Query::where('query', '=', $this->query)->where('site_id', '=', $this->site_id)->first();
        if(isset($query)){
            // Increment occurences
            $query->increment('occurences');
            // Update hits
            $query->hits = $this->hits;
            $query->save;
        } else {
            // Create the new query
            Query::create([
                'query' => $this->query,
                'hits' => $this->hits,
                'site_id' => $this->site_id
            ]);
        }
    }
}
