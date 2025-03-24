<!doctype html>
<html lang="en">
<style>
    h2 {
        font-size: 24px;
        margin-top: 1em;
        margin-bottom: 1em;
    }

    em {
        font-weight: 700;
    }

    a {
        color: blue;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

[block slug="header"]

<?php
use App\Services\FrontendSearchService;

$link = $_SERVER['PHP_SELF'];
$link_array = explode('/', $link);
$slug = end($link_array);

$response = FrontendSearchService::content(htmlspecialchars($slug));

// echo print_r($response, true);

?>

<body>

    [block slug="navigation" id="navigation-top"]

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
        <!-- Page content starts -->
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto sm:w-2/3 lg:w-3/5 format format-sm sm:format-base lg:format-lg format-blue">
                <article class="format format-sm sm:format-base lg:format-lg format-blue">
                    <h1 class='mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl'>
                        Docs page
                    </h1>
                    <p class='my-5'> Content last updated <?php echo $response['last_updated']; ?></p>

                    <?php
                    echo $response['body'];
                    ?>

                </article>
            </article>
        </div>
        <!-- Page content ends -->
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>
