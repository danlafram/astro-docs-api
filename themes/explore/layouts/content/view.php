<!doctype html>
<html lang="en">

[block slug="header"]

<?php
use App\Services\FrontendSearchService;

$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$slug = end($link_array);

$response = FrontendSearchService::content(htmlspecialchars($slug));

?>

<body>

    [block slug="navigation" id="navigation-top"]

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
        <!-- Page content starts -->
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto sm:w-2/3 lg:w-3/5 format format-sm sm:format-base lg:format-lg format-blue">
                <article class="format format-sm sm:format-base lg:format-lg format-blue">
                    <h1 class='mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl'>
                        <?php echo $response['title']; ?>
                    </h1>
                    <p class='my-5'> Content last updated <?php echo $response['last_updated']; ?></p>

                    <?php
                    echo $response['body'];
                    ?>

                </article>
            </article>
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('a').each(function(tag) {
                // NOTE: There are a lot of bold assumptions here. 
                // May have to revisit depending on URL formatting
                // If there is an error in routing, start here.
                if ($(this).attr('href').includes('/wiki/')) {
                    let split_path = $(this).attr('href').split('/');
                    let new_path = split_path.at(-1).replaceAll('+', '-').toLowerCase();
                    $(this).attr('href', new_path);
                }
            })
        });
    </script>

</body>

</html>
