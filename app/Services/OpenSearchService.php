<?php

namespace App\Services;
use OpenSearch\ClientBuilder;

class OpenSearchService
{
    public $client;

    public function __construct()
    {
        $client = ClientBuilder::fromConfig([
            'Hosts' => [
               'http://localhost:9200' // Make this .env driven
            ],
            'Retries' => 2,
            'SSLVerification' => false // If prod, this is true
         ]);

         $this->client = $client;
    }
    
}
