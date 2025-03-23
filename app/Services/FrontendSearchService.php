<?php

namespace App\Services;

use App\Jobs\TrackQueryJob;
use App\Services\OpenSearchService;

class FrontendSearchService
{
    public static function search(string $query)
    {
        logger("Static search hit");

        $openSearchService = new OpenSearchService();

        $index = tenant()->site->index;

        $params = [
            'index' => $index,
            'body'  => [
                'size' => 10,
                '_source' => false, // Don't get the full document yet
                'fields' => [
                    'stripped_document',
                    'title',
                ],
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['title', 'stripped_document']
                    ]
                ],
                'highlight' => [
                    'pre_tags' => ['<b>'],
                    'post_tags' => ['</b>'],
                    'fields' => [
                        'stripped_document' => [
                            'pre_tags' => ['<em class="font-bold">'], 
                            'post_tags' => ['</em>']
                        ],
                        'title' => [
                            'pre_tags' => ['<em class="font-bold">'],
                            'post_tags' => ['</em>']
                        ]
                    ]
                ]
            ]
        ];

        $response = $openSearchService->client->search($params);

        TrackQueryJob::dispatch($query, tenant()->site->id, $response['hits']['total']['value']);

        // Here is where it gets complicated. Need to return echo or something with the data
        $data = [
            'results' => $response['hits']['hits'],
            'query' => $query,
            'hits' => $response['hits']['total']['value'],
        ];

        return $data;
    }
}