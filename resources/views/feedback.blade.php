<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AstroDocs</title>
    <link rel="icon" href="{{ asset('img/Astro-logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
{{-- TODO: Figure this out to display success/error message --}}
@include('includes.analytics')
<body class="font-sans antialiased">
    <main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-base font-semibold text-indigo-600">Submission successful!</p>
            <h1 class="mt-4 text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">Thanks for reaching out!
            </h1>
            <p class="mt-6 text-pretty text-lg font-medium text-gray-500 sm:text-xl/8">We'll get back to you as soon as we can</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="/"
                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go
                    back home</a>
            </div>
        </div>
    </main>

</body>

</html>
