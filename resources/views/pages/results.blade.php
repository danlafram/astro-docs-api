<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">
    <x-header/>
    <main>
        <div class='mt-10 mx-auto text-center'>
            <h1 class='text-3xl'>Search results for "{{ $query }}"</h1>
            @if($hits > 1)
                <p>{{ $hits }} pages found</p>
            @elseif($hits == 1)
                <p>{{ $hits }} page found</p>
            @else
                <p>No results found for query</p>
            @endif
        </div>
        {{-- Keep the Search bar available --}}
        <x-searchbar :query="$query"/>

        {{-- Search results --}}
        <div class="flex flex-col max-w-fit content-center mx-auto lg:mt-10">
            @if (count($results) > 0)
                @foreach ($results as $result)
                    <div class='m-2 max-w-fit'>
                            <a class="text-2xl text-sky-400 hover:underline"
                                href="{{ url(strtolower(str_replace(' ', '-', $result['fields']['title'][0]))) }}">{{ $result['fields']['title'][0] }}</a>


                            {{-- Check if we are looking at stripped_document or title --}}
                            @if(isset($result['highlight']['stripped_document']))
                                @foreach ($result['highlight']['stripped_document'] as $highlight)
                                    <p class="ml-5 text-base">
                                        <?php
                                            echo $highlight;
                                        ?>...
                                    </p>
                                @endforeach
                            @endif
                            @if(isset($result['highlight']['title']))
                                @foreach ($result['highlight']['title'] as $highlight)
                                    <p class="ml-5 text-base">
                                        <?php
                                            echo $highlight;
                                        ?>
                                    </p>
                                @endforeach
                            @endif
                    </div>
                @endforeach
            @else
                <p class='mx-auto text-2xl'>No results found for query "{{ $query }}"</p>
            @endif
        </div>
    </main>
</body>

</html>
