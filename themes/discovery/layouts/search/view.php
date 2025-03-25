<!doctype html>
<html lang="en">

<?php
use App\Services\FrontendSearchService;
$pages = FrontendSearchService::recommendations();
?>

[block slug="header"]

<body>
    <!-- <div id="main" class="row"> -->
    [block slug="navigation" id="navigation-top"]

    <main class='flex flex-col lg:min-w-md h-screen pt-28'>
        <!-- This div/component should be editable -->
        [block slug="title"]

        [block slug="searchbar"]

        <div class='grid grid-cols-2 mx-auto gap-4 mt-10 text-center'>
            <?php
            foreach ($pages as $page) {
                echo "<div class='rounded-full bg-gray-200 py-1 px-5 flex flex-col'>
                                                            <a class='my-auto text-centre hover:underline text-black'
                                                            href=/page/$page->slug>$page->title</a>
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
                                <div class='p-2 border-y-1 last:border-y-0'><a class='text-black' href="/page/${href}">${hit.fields.title}</a></div>
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
