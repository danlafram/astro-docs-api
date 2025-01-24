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
@include('includes.analytics')
<body class="font-sans antialiased">
    <main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-base font-semibold text-indigo-600">Want to try out Astro Docs?</p>
            <h1 class="mt-4 text-balance text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">Click the button below to install Astro Docs
            </h1>
            <button
                class='mt-10 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'>
             <a target='_blank' href='https://developer.atlassian.com/console/install/3c6824f8-22af-4238-a071-317cb020ea6f?signature=AYABeDO0%2FaJni5iwvE8VEqCoXHkAAAADAAdhd3Mta21zAEthcm46YXdzOmttczp1cy1lYXN0LTE6NzA5NTg3ODM1MjQzOmtleS83ZjcxNzcxZC02OWM4LTRlOWItYWU5Ny05MzJkMmNhZjM0NDIAuAECAQB4KZa3ByJMxgsvFlMeMgRb2S0t8rnCLHGz2RGbmY8aB5YBYDqF4BysL2aUJSIPl5rtygAAAH4wfAYJKoZIhvcNAQcGoG8wbQIBADBoBgkqhkiG9w0BBwEwHgYJYIZIAWUDBAEuMBEEDF6%2B75O6AHwYjNsZKQIBEIA7K8UClOCtPIQn7LHmwEPgWL4kDcXfsD47d0WofeS6TZ%2FlB0dSBaIIxnieFMjpElMIaMGCKMoLj9Lku%2BsAB2F3cy1rbXMAS2Fybjphd3M6a21zOmV1LXdlc3QtMTo3MDk1ODc4MzUyNDM6a2V5LzU1OWQ0NTE2LWE3OTEtNDdkZi1iYmVkLTAyNjFlODY4ZWE1YwC4AQICAHhHSGfAZiYvvl%2F9LQQFkXnRjF1ris3bi0pNob1s2MiregE9BqFxGe%2BRf9F7Hnh0ZSWTAAAAfjB8BgkqhkiG9w0BBwagbzBtAgEAMGgGCSqGSIb3DQEHATAeBglghkgBZQMEAS4wEQQMFU1u8KW3z1PukIAPAgEQgDskaAFmF%2BJ%2BFxcaDjGUaDaktx0fADEc3PpJb5Mtnp1Y9h1TISi3S5ssn8qADM%2FFbToyny6kF9n6050NxgAHYXdzLWttcwBLYXJuOmF3czprbXM6dXMtd2VzdC0yOjcwOTU4NzgzNTI0MzprZXkvM2M0YjQzMzctYTQzOS00ZmNhLWEwZDItNDcyYzE2ZWRhZmRjALgBAgIAePadDOCfSw%2BMRVmOIDQhHhGooaxQ%2FiwGaLB334n1X9RCASmpGU%2B7vtHJbeeco2x7FEUAAAB%2BMHwGCSqGSIb3DQEHBqBvMG0CAQAwaAYJKoZIhvcNAQcBMB4GCWCGSAFlAwQBLjARBAw1h3uJDuBGtqLLbvACARCAOybcNIHBUxCX%2FoGEu6nVE4YMBsuvB0n1TAXapTEYi61cu35QYwjmxAvX6qUh4xkFpCI3u%2BhSHEEzxlYrAgAAAAAMAAAQAAAAAAAAAAAAAAAAAAWbvH3i3HaC4JdAwH%2BWIyT%2F%2F%2F%2F%2FAAAAAQAAAAAAAAAAAAAAAQAAADKs8FTs96uTUJlRuHXANIkO6ou7UUjMEQ7Am9MYR9WWJnMngtFKFr%2BB2a2j0%2BzRP6%2B4z5hqxuR7P8jFFixGPz%2BUPbw%3D&product=confluence' class="">Click here to install
             </a>
            </button>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="/"
                    class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Go
                    back home</a>
            </div>
        </div>
    </main>

</body>

</html>
