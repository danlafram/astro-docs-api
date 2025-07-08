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
?>

[block slug="header" id="h1"]

<body>
    <!-- <div id="main" class="row"> -->
    [block slug="navigation" id="navigation-top"]

    <main class='flex flex-col lg:min-w-md h-screen'>
        <!-- This div/component should be editable -->
        <div class='mx-auto m-5 text-center'>
            <p>Whoops, 404 page not found</p>
            <h1 class=' text-4xl my-5'>We couldn't find the page you were looking for</h1>
            <br />
        </div>
        <h3 class='mx-auto mt-10 text-2xl text-sky-800'>Can we suggest something else?</h3>
        <div class='grid grid-cols-3 mx-auto gap-4 mt-10 text-center'>
            <?php
            foreach ($pages as $page) {
                echo "<div class='bg-white border border-gray-300 shadow-md rounded-sm py-1 px-5 flex flex-col'>
                                                            <a class='my-auto text-centre hover:underline text-sky-800'
                                                            href=/page/$page->slug>$page->title</a>
                                                        </div>";
            }
            ?>
        </div>

        <?= $body ?>
    </main>

</body>

</html>
