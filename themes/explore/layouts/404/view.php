<!doctype html>
<html lang="en">

<?php
use App\Services\FrontendSearchService;
$pages = FrontendSearchService::recommendations();
// TODO: Add default pages here?
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
