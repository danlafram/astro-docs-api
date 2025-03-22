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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</body>
</html>