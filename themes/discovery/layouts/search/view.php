<!doctype html>
<html lang="en">

[block slug="header"]

<body>
<!-- <div id="main" class="row"> -->
[block slug="navigation" id="navigation-top"]

<main class='flex flex-col lg:min-w-md h-screen pt-28'>
        <!-- This div/component should be editable -->
        <div class='mx-auto m-5 text-center'>
            <!-- <p>{{$site_name}}'s knowledge base</p> -->
            <p>Company's knowledge base</p>
            <h1 class=' text-4xl my-5'>Search for anything in our documentation</h1>
        </div>
        
        <!-- Extract search bar into its own component -->
        [block slug="searchbar"]
        

        <div class='grid grid-cols-2 mx-auto gap-4 mt-10 text-center'>
            <div class='rounded-full bg-gray-200 py-1 px-5 flex flex-col'>
                <a class='my-auto text-centre hover:underline text-black'
                href="#">Test 1</a>
            </div>
                <div class='rounded-full bg-gray-200 py-1 px-5 flex flex-col'>
                    <a class='my-auto text-centre hover:underline text-black'
                href="#">Test 2</a>
            </div>
            <div class='rounded-full bg-gray-200 py-1 px-5 flex flex-col'>
                    <a class='my-auto text-centre hover:underline text-black'
                href="#">Test 3</a>
            </div>
            <div class='rounded-full bg-gray-200 py-1 px-5 flex flex-col'>
                    <a class='my-auto text-centre hover:underline text-black'
                href="#">Test 4</a>
            </div>
        </div>
    </main>
<!-- </div> -->

<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->

<script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
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
                        if(data?.results?.length > 0){
                            $("#results-list").empty();
                            if($('#results-list').hasClass('hidden')){
                                $('#results-list').toggleClass('hidden');
                                $('#results-list').toggleClass('border-t-0');
                                $('#search').toggleClass('border-b-0 rounded-t-lg rounded-lg');
                            }
                        }

                        data.results.forEach((hit) => {
                            let href = hit.fields.title[0].replaceAll(' ', '-').toLowerCase();
                            $('#results-list').append(`
                                <div class='border p-2'><a class='text-black' href="/${href}">${hit.fields.title}</a></div>
                            `)
                        })
                    }
                });
            } else {
                if(input_value == ''){
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