<?php

namespace App\Services;

use App\Jobs\TrackQueryJob;
use App\Models\ContentPage;
use App\Services\OpenSearchService;


/**
 * This class is what the front end usesn to interact with the API
 * This class should be a 'contract' meaning the format that the data returned must be documented and absolutely respected. 
 * Otherwise, it could break someone's theme.
 */
class FrontendSearchService
{
    public static function search(string $query)
    {
        // Check if its page builder query?
        logger("Query: " . $query);
        $openSearchService = new OpenSearchService();

        $index = tenant()->site->index;

        $params = [
            'index' => $index,
            'body' => [
                'size' => 10,
                '_source' => false, // Don't get the full document yet
                'fields' => ['stripped_document', 'title'],
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['title', 'stripped_document'],
                    ],
                ],
                'highlight' => [
                    'pre_tags' => ['<b>'],
                    'post_tags' => ['</b>'],
                    'fields' => [
                        'stripped_document' => [
                            'pre_tags' => ['<em class="font-bold">'],
                            'post_tags' => ['</em>'],
                        ],
                        'title' => [
                            'pre_tags' => ['<em class="font-bold">'],
                            'post_tags' => ['</em>'],
                        ],
                    ],
                ],
            ],
        ];

        $response = $openSearchService->client->search($params);

        TrackQueryJob::dispatch($query, tenant()->site->id, $response['hits']['total']['value']);

        $data = [
            'results' => $response['hits']['hits'],
            'query' => $query,
            'hits' => $response['hits']['total']['value'],
        ];

        return $data;
    }

    // Still need to handle 404 page here to respect the actual theme. A 404 component is necessary. 
    // Another thing to add to config.json is auto-generate 404 component and have it required for any theme to be uploaded.
    public static function content(string $slug)
    {
        $page = ContentPage::where('slug', '=', $slug)
            ->where('site_id', '=', tenant()->site->id)
            ->first();

        if (!$page->visible) {
            $pages = ContentPage::where('visible', '=', 1)
                ->where('page_id', '=', tenant()->site->id)
                ->inRandomOrder()
                ->limit(4)
                ->get();
            return view('errors.404')->with('pages', $pages); // TODO: Update this to render the 404 content instead
        }

        $openSearchService = new OpenSearchService();

        $index = tenant()->site->index;
        $params = [
            'index' => $index,
            'id' => $page->search_id,
        ];

        $response = $openSearchService->client->get($params);

        $page->increment('views'); // TODO: Put this on a queue

        return [
            'body' => $response['_source']['document'],
            'title' => $response['_source']['title'],
            'last_updated' => $page->confluence_updated_at,
        ];
    }

    public static function recommendations()
    {
        $pages = ContentPage::where('visible', '=', 1)->where('site_id', '=', tenant()->site->id)->inRandomOrder()
            ->limit(4)
            ->get();

        return $pages;
    }
}
