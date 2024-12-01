@extends('layouts.default', ['title' => $title])
@section('content')
    {{-- TODO: Use the current tenant login to display the company name/logo/etc. --}}
    <x-header />

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white antialiased">
        {{-- Page content starts --}}
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue">
                <article
                    class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                    <h1 class='mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl'>
                        <?php
                        echo $title;
                        ?>
                    </h1>
                    <span> Content last updated: {{$last_updated}}</span>
                    

                    <?php
                    echo $body;
                    ?>
                </article>
        </div>
        {{-- Page content ends --}}
    </main>
    {{-- <x-contact />
    <x-footer /> --}}
</body>
<script>
    $(document).ready(function() {

        $('a').each(function (tag) {
            // NOTE: There are a lot of bold assumptions here. 
            // May have to revisit depending on URL formatting
            // If there is an error in routing, start here.
            if($(this).attr('href').includes('/wiki/')){
                let split_path = $(this).attr('href').split('/');
                let new_path = split_path.at(-1).replaceAll('+', '-').toLowerCase();
                $(this).attr('href', new_path);
            }

        })

    

    });
</script>

@stop
