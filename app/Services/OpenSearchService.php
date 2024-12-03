<?php

namespace App\Services;
use OpenSearch\ClientBuilder;

class OpenSearchService
{
    public $client;

    public function __construct()
    {
        if(app()->isProduction()) {
            logger("Connection string: " . config('app.opensearch_host') . ':' . config('app.opensearch_port'));
            $this->client = (new ClientBuilder())
            ->setHosts([config('app.opensearch_host') . ':' . config('app.opensearch_port')])
            ->setBasicAuthentication(config('app.opensearch_user'), config('app.opensearch_password')) // For testing only. Don't store credentials in code.
            ->setSSLVerification(true)
            ->build();
        } else {
            $client = ClientBuilder::fromConfig([
                'Hosts' => [
                    config('app.opensearch_host') . ':' . config('app.opensearch_port') // Make this .env driven
                ],
                'Retries' => 2,
                'SSLVerification' => false // If prod, this is true
             ]);
    
             $this->client = $client;
        }
        
    }
    
}
