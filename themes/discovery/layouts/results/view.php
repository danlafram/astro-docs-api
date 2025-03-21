<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?= $page->get('title') ?></title>
    <link rel="stylesheet" href="<?= phpb_theme_asset('css/style.css') ?>" />
</head>
<body>

<!-- TODO: Add php calls here to populate required data -->

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

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.tailwindcss.com"></script>
</body>
</html>