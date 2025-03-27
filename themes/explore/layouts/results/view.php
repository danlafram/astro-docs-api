<!doctype html>
<html lang="en">

<?php

use App\Services\FrontendSearchService;
if (isset($_GET['query'])) {
    $response = FrontendSearchService::search(htmlspecialchars($_GET['query']));
} else {
    $response = [
        'query' => 'Test query',
        'hits' => 2,
        'results' => [
            [
                'fields' => [
                    'title' => ['First page title']
                ],
                'highlight' => [
                    'title' => ['Follow these steps to install on your space today.Question - Can I control which pages are visible on.']
                ],
            ],
            [
                'fields' => [
                    'title' => ['Second page title'],
                ],
                'highlight' => [
                    'title' => ['will be using this space titled “Help Center”:Step 2 - InstallationNavigate to https://astro-docs.com/install'],
                ],
            ],
        ],
    ];
}
?>

[block slug="header" id="header1"]

<body>

    [block slug="navigation" id="navigation-top"]

    <main>
        <div class="p-10 bg-linear-to-t from-sky-500 to-indigo-500">
            <div class='mt-10 mx-auto text-center'>
                <h1 class='text-3xl text-white'>Search results for "<?php echo $response['query']; ?>"</h1>
                <?php
                if ($response['hits'] > 1) {
                    echo "<p class='text-white'>" . $response['hits'] . ' pages found</p>';
                } elseif ($response['hits'] == 1) {
                    echo "<p class='text-white'>" . $response['hits'] . ' page found</p>';
                } else {
                    echo "<p class='text-white'>No results found for query</p>";
                }
                ?>
            </div>

            [block slug="searchbar" id="sb1"]
        </div>
        <div class="flex flex-col max-w-fit content-center mx-auto lg:mt-10">
            <?php
            if (count($response['results']) > 0) {
                foreach ($response['results'] as $result) {
                    $highlight_stripped_html = '';
                    $highlight_title_html = '';
                    if (isset($result['highlight']['stripped_document'])) {
                        foreach ($result['highlight']['stripped_document'] as $highlight) {
                            $highlight_stripped_html = "<p class='ml-5 text-base'>$highlight...</p>";
                        }
                    }
                    if (isset($result['highlight']['title'])) {
                        foreach ($result['highlight']['title'] as $highlight) {
                            $highlight_title_html = "<p class='ml-5 text-base'>$highlight...</p>";
                        }
                    }
                    echo "
                                                    <div class='m-2 max-w-fit'>
                                                        <a class='text-2xl text-sky-400 hover:underline' href=" .
                        url('page/' . strtolower(str_replace(' ', '-', $result['fields']['title'][0]))) .
                        '>' .
                        $result['fields']['title'][0] .
                        "</a>
                                                        $highlight_stripped_html
                                                        $highlight_title_html
                                                    </div>
                                                ";
                }
            } else {
                echo "<p class='mx-auto text-2xl'>No results found for query'" . $response['query'] . "'</p>";
            }
            ?>
        </div>

        <?= $body ?>
    </main>

    <!-- Optional JavaScript -->
    <!-- THIS AND THAT -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
</body>

</html>
