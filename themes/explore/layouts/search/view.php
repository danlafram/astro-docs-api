<!doctype html>
<html lang="en">

<?php
use App\Services\FrontendSearchService;

$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$slug = end($link_array);
$pages = [];

if($slug == 'build'){
    $pages = (object)[
        (object)[
            "title" => "How to Change Your Primary Email Address",
            "slug" => "how-to-get-started-with-your-new-saas-account",
            "views" => 4,
            "visible" => 1,
            "created_at" => "2025-03-23 04:13:52",
            "updated_at" => "2025-03-26 01:27:49",
        ],
        (object)[
            "title" => "API Overview",
            "slug" => "api-overview",
            "views" => 3,
            "visible" => 1,
            "created_at" => "2025-03-23 04:13:52",
            "updated_at" => "2025-03-26 01:27:49",
        ],
        (object)[
            "title" => "Step-by-Step Guide to Adding Users to Your Account",
            "slug" => "step-by-step-guide-to-adding-users-to-your-account",
            "views" => 3,
            "visible" => 1,
            "created_at" => "2025-03-23 04:13:52",
            "updated_at" => "2025-03-26 01:27:49",
        ]
    ];
} else {
    $pages = FrontendSearchService::recommendations();
}

// TODO: Add default pages here?
?>

[block slug="header" id="h1"]

<body>
    <!-- <div id="main" class="row"> -->
    [block slug="navigation" id="navigation-top"]

    <main class='flex flex-col lg:min-w-md h-screen'>
        <!-- This div/component should be editable -->
        <div class='p-10 bg-linear-to-t from-sky-500 to-indigo-500'>
            [block slug="title" id="t1"]

            [block slug="searchbar" id="s1"]
        </div>
        <h3 class='mx-auto mt-10 text-2xl text-sky-800'>Popular content</h3>
        <div class='grid grid-cols-3 mx-auto gap-4 mt-10 text-center'>
            <?php
            foreach ($pages as $page) {
                echo "<div class='bg-white border border-gray-300 shadow-md rounded-sm py-1 px-5 flex flex-col'>
                                                                        <a class='my-auto text-centre hover:underline text-sky-800'
                                                                        href='/page/$page->slug'>$page->title</a>
                                                                    </div>";
            }
            ?>
        </div>

        <?= $body ?>
    </main>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                var input_value = $('#search').val();
                if (input_value !== undefined && input_value.length) {
                    $.ajax({
                        type: "POST",
                        url: "/live_search",
                        data: {
                            '_token': '<?= csrf_token() ?>',
                            'query': input_value
                        },
                        success: function(data) {
                            if (data?.results?.length > 0) {
                                $("#results-list").empty();
                                if ($('#results-list').hasClass('hidden')) {
                                    $('#results-list').toggleClass('hidden');
                                    $('#results-list').toggleClass('border-t-0');
                                    $('#search').toggleClass(
                                        'border-b-0 rounded-t-lg rounded-lg');
                                }
                            }

                            data.results.forEach((hit) => {
                                let href = hit.fields.title[0].replaceAll(' ', '-')
                                    .toLowerCase();
                                $('#results-list').append(`
                                <div class='bg-white p-2 border-y-1 last:border-y-0 last:rounded-b-lg'><a class='text-black' href="/page/${href}">${hit.fields.title}</a></div>
                            `)
                            })
                        }
                    });
                } else {
                    if (input_value == '') {
                        $("#results-list").empty();
                        $('#results-list').toggleClass('hidden');
                        $('#search').toggleClass('border-b-0 rounded-t-lg rounded-lg');
                    }
                }

            });
        });
    </script>
</body>

</html>
