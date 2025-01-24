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
    <div class="bg-white">
        <!-- Header -->
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="/" class="-m-1.5 p-1.5">
                        <span class="sr-only">AstroDocs</span>
                        <img class="h-20 w-20" src="{{ asset('img/Astro-logo.png') }}" alt="">
                    </a>
                </div>
                <div class="flex lg:hidden">
                    <button type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
                        <span class="sr-only">Open main menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    {{-- <a href="product" class="text-sm/6 font-semibold text-white">Product</a> --}}
                    <a href="#product" class="text-sm/6 font-semibold text-white">Features</a>
                    {{-- <a href="#" class="text-sm/6 font-semibold text-white">Marketplace</a> TODO: Send this URL to atlassian marketplace --}}
                    <a href="#contact" class="text-sm/6 font-semibold text-white">Contact</a>
                    <a href="#faq" class="text-sm/6 font-semibold text-white">FAQ</a>
                    <a href="/install" class="text-sm/6 font-semibold text-white">Install</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">

                </div>
            </nav>
            <!-- Mobile menu, show/hide based on menu open state. -->
            <div class="lg:hidden hidden" role="dialog" aria-modal="true">
                <!-- Background backdrop, show/hide based on slide-over state. -->
                <div class="fixed inset-0 z-50"></div>
                <div
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-white/10">
                    <div class="flex items-center justify-between">
                        <a href="#" class="-m-1.5 p-1.5">
                            <span class="sr-only">Your Company</span>
                            <img class="h-8 w-auto"
                                src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500"
                                alt="">
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-400">
                            <span class="sr-only">Close menu</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/25">
                            <div class="space-y-2 py-6">
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Product</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Features</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Marketplace</a>
                                <a href="#"
                                    class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-white hover:bg-gray-800">Company</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main>
            {{-- Feedback --}}
            @if(session()->has('message'))
                <div class="rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="shrink-0">
                            <svg class="size-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                                data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">Order completed</h3>
                            <div class="mt-2 text-sm text-green-700">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid pariatur, ipsum
                                    similique veniam.</p>
                            </div>
                            <div class="mt-4">
                                <div class="-mx-2 -my-1.5 flex">
                                    <button type="button"
                                        class="rounded-md bg-green-50 px-2 py-1.5 text-sm font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">View
                                        status</button>
                                    <button type="button"
                                        class="ml-3 rounded-md bg-green-50 px-2 py-1.5 text-sm font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">Dismiss</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- Hero section --}}
            <div class="relative isolate overflow-hidden bg-gray-900 pb-16 pt-14 sm:pb-20">
                {{-- TODO: Update this image --}}
                {{-- <img src={{ asset('img/Background.avif')}}
                    alt="" class="absolute inset-0 -z-10 size-full object-cover"> --}}
                <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                        <div class="text-center">
                            <h1 class="text-balance text-5xl font-semibold tracking-tight text-white sm:text-7xl">Astro
                                Docs</h1>
                            <p class="mt-8 text-pretty text-2xl font-medium text-white sm:text-xl/8">Transform your
                                Confluence spaces into a public searchable knowledge base</p>
                            <div class="mt-10 flex items-center justify-center gap-x-6">
                                <a href="#"{{-- TODO: Send this URL to the marketplace --}}
                                    class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-400">Get
                                    started</a>
                                {{-- Send it down to another content page --}}
                                <a href="#product" class="text-sm/6 font-semibold text-white">Learn more <span
                                        aria-hidden="true">→</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                    aria-hidden="true">
                    <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                        style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                    </div>
                </div>
            </div>

            {{-- Feature section --}}
            <div id="product" class="mt-32 sm:mt-56">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl sm:text-center">
                        <h2 class="text-base/7 font-semibold text-indigo-600">Everything you need</h2>
                        <p
                            class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-balance sm:text-5xl">
                            No code required. Live in seconds</p>
                        <p class="mt-6 text-lg/8 text-gray-600">Astro Docs allows you to turn your existing Confluence
                            space into a live knowledge base your users can browse.</p>
                    </div>
                </div>
                <div class="relative overflow-hidden pt-16">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        {{-- TODO: Record a screen of using astro docs in Confluence and then go to a site, search something, then click a page. Turn that into a GIF and add it here. --}}
                        <img src="{{ asset('/img/search-screen.png') }}"
                            alt="App screenshot" class="mb-[-12%] rounded-xl shadow-2xl ring-1 ring-gray-900/10"
                            width="2432" height="1442">
                        <div class="relative" aria-hidden="true">
                            <div class="absolute -inset-x-20 bottom-0 bg-gradient-to-t from-white pt-[7%]"></div>
                        </div>
                    </div>
                </div>
                <div class="mx-auto mt-16 max-w-7xl px-6 sm:mt-20 md:mt-24 lg:px-8">
                    <dl
                        class="mx-auto grid max-w-2xl grid-cols-1 gap-x-6 gap-y-10 text-base/7 text-gray-600 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-x-8 lg:gap-y-16">
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <svg class="absolute left-1 top-1 size-5 text-indigo-600" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M5.5 17a4.5 4.5 0 0 1-1.44-8.765 4.5 4.5 0 0 1 8.302-3.046 3.5 3.5 0 0 1 4.504 4.272A4 4 0 0 1 15 17H5.5Zm3.75-2.75a.75.75 0 0 0 1.5 0V9.66l1.95 2.1a.75.75 0 1 0 1.1-1.02l-3.25-3.5a.75.75 0 0 0-1.1 0l-3.25 3.5a.75.75 0 1 0 1.1 1.02l1.95-2.1v4.59Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Click to index.
                            </dt>
                            <dd class="inline">Publish your knowledge base with a click of a button.
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <svg class="absolute left-1 top-1 size-5 text-indigo-600" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z"
                                        clip-rule="evenodd" />
                                </svg>
                                SSL certificates.
                            </dt>
                            <dd class="inline">Secured sites with free SSL certificates pre-installed.</dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <svg class="absolute left-1 top-1 size-5 text-indigo-600" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Fast loads.
                            </dt>
                            <dd class="inline">Powerful cache system that provides a fast experience for your users.
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <svg class="absolute left-1 top-1 size-5 text-indigo-600" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path fill-rule="evenodd"
                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
                                        clip-rule="evenodd" />
                                </svg>

                                Powerful search.
                            </dt>
                            <dd class="inline">Astro Doc's search engine ensures your users find what they are looking
                                for.
                            </dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <svg class="absolute left-1 top-1 size-5 text-indigo-600" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd"
                                        d="M7.84 1.804A1 1 0 0 1 8.82 1h2.36a1 1 0 0 1 .98.804l.331 1.652a6.993 6.993 0 0 1 1.929 1.115l1.598-.54a1 1 0 0 1 1.186.447l1.18 2.044a1 1 0 0 1-.205 1.251l-1.267 1.113a7.047 7.047 0 0 1 0 2.228l1.267 1.113a1 1 0 0 1 .206 1.25l-1.18 2.045a1 1 0 0 1-1.187.447l-1.598-.54a6.993 6.993 0 0 1-1.929 1.115l-.33 1.652a1 1 0 0 1-.98.804H8.82a1 1 0 0 1-.98-.804l-.331-1.652a6.993 6.993 0 0 1-1.929-1.115l-1.598.54a1 1 0 0 1-1.186-.447l-1.18-2.044a1 1 0 0 1 .205-1.251l1.267-1.114a7.05 7.05 0 0 1 0-2.227L1.821 7.773a1 1 0 0 1-.206-1.25l1.18-2.045a1 1 0 0 1 1.187-.447l1.598.54A6.992 6.992 0 0 1 7.51 3.456l.33-1.652ZM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Configurable.
                            </dt>
                            <dd class="inline">Hide and show pages based on your needs.</dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <svg class="absolute left-1 top-1 size-5 text-indigo-600" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                                </svg>
                                Page and Search analytics.
                            </dt>
                            <dd class="inline">Find out what your users are searching for and dig into page analytics.
                            </dd>
                        </div>
                    </dl>
                </div>
                <div class="mx-auto max-w-7xl px-6 lg:px-8 pt-10">
                    <div class="mx-auto max-w-2xl sm:text-center">
                        <h3
                            class="mt-2 text-pretty text-2xl font-semibold tracking-tight text-gray-900 sm:text-balance sm:text-5xl">
                            Search results</h3>
                        <p class="mt-6 text-lg/8 text-gray-600">Display search results and preview content that appeared in the search</p>
                    </div>
                </div>
                <div class="relative overflow-hidden">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        {{-- TODO: Record a screen of using astro docs in Confluence and then go to a site, search something, then click a page. Turn that into a GIF and add it here. --}}
                        <img src="{{ asset('/img/search-results.png') }}"
                            alt="App screenshot" class="mb-[-12%] rounded-xl shadow-2xl ring-1 ring-gray-900/10"
                            width="2432" height="1442">
                        <div class="relative" aria-hidden="true">
                            <div class="absolute -inset-x-20 bottom-0 bg-gradient-to-t from-white pt-[7%]"></div>
                        </div>
                    </div>
                </div>
                <div class="mx-auto max-w-7xl px-6 lg:px-8 pt-10">
                    <div class="mx-auto max-w-2xl sm:text-center">
                        <h3
                            class="mt-2 text-pretty text-2xl font-semibold tracking-tight text-gray-900 sm:text-balance sm:text-5xl">
                            Give your customers the information they need</h3>
                        <p class="mt-6 text-lg/8 text-gray-600">Render pages just as they look in Confluence</p>
                    </div>
                </div>
                <div class="relative overflow-hidden">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        {{-- TODO: Record a screen of using astro docs in Confluence and then go to a site, search something, then click a page. Turn that into a GIF and add it here. --}}
                        <img src="{{ asset('/img/page.png') }}"
                            alt="App screenshot" class="mb-[-12%] rounded-xl shadow-2xl ring-1 ring-gray-900/10"
                            width="2432" height="1442">
                        <div class="relative" aria-hidden="true">
                            <div class="absolute -inset-x-20 bottom-0 bg-gradient-to-t from-white pt-[7%]"></div>
                        </div>
                    </div>
                </div>
                <div class="mx-auto max-w-7xl px-6 lg:px-8 pt-10">
                    <div class="mx-auto max-w-2xl sm:text-center">
                        <h3
                            class="mt-2 text-pretty text-2xl font-semibold tracking-tight text-gray-900 sm:text-balance sm:text-5xl">
                            Manage your pages</h3>
                        <p class="mt-6 text-lg/8 text-gray-600">Hide and show pages at the individual level.</p>
                    </div>
                </div>
                <div class="relative overflow-hidden">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        {{-- TODO: Record a screen of using astro docs in Confluence and then go to a site, search something, then click a page. Turn that into a GIF and add it here. --}}
                        <img src="{{ asset('/img/manage.png') }}"
                            alt="App screenshot" class="mb-[-12%] rounded-xl shadow-2xl ring-1 ring-gray-900/10"
                            width="2432" height="1442">
                        <div class="relative" aria-hidden="true">
                            <div class="absolute -inset-x-20"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact us section --}}
            <div id="contact" class="relative isolate bg-white">
                <div class="mx-auto grid max-w-7xl grid-cols-1 lg:grid-cols-2">
                    <div class="relative px-6 pb-20 pt-24 sm:pt-32 lg:static lg:px-8 lg:py-48">
                        <div class="mx-auto max-w-xl lg:mx-0 lg:max-w-lg">
                            <h2 class="text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Get
                                in touch</h2>
                            <p class="mt-6 text-lg/8 text-gray-600">If you had any questions, we'd love to connect. Fill out the contact form with your message or reach out to the email below to get in touch.</p>
                            <dl class="mt-10 space-y-4 text-base/7 text-gray-600">
                                <div class="flex gap-x-4">
                                    <dt class="flex-none">
                                        <span class="sr-only">Email</span>
                                        <svg class="h-7 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                                            data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
                                    </dt>
                                    <dd><a class="hover:text-gray-900"
                                            href="mailto:hello@example.com">dan@spoke.dev</a></dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    <form action="/api/email" method="POST" class="px-6 pb-24 pt-20 sm:pb-32 lg:px-8 lg:py-48">
                        @csrf
                        <div class="mx-auto max-w-xl lg:mr-0 lg:max-w-lg">
                            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <label for="first-name" class="block text-sm/6 font-semibold text-gray-900">First
                                        name</label>
                                    <div class="mt-2.5">
                                        <input type="text" name="first-name" id="first-name"
                                            autocomplete="given-name"
                                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div>
                                    <label for="last-name" class="block text-sm/6 font-semibold text-gray-900">Last
                                        name</label>
                                    <div class="mt-2.5">
                                        <input type="text" name="last-name" id="last-name"
                                            autocomplete="family-name"
                                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="email"
                                        class="block text-sm/6 font-semibold text-gray-900">Email</label>
                                    <div class="mt-2.5">
                                        <input type="email" name="email" id="email" autocomplete="email"
                                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                                    </div>
                                </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="message"
                                        class="block text-sm/6 font-semibold text-gray-900">Message</label>
                                    <div class="mt-2.5">
                                        <textarea name="message" id="message" rows="4"
                                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8 flex justify-end">
                                <button type="submit"
                                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Send
                                    message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- TODO: Fill out the FAQ section --}}
            <div id="faq" class="mx-auto mt-32 max-w-7xl px-6 sm:mt-56 lg:px-8">
                <div class="mx-auto max-w-4xl divide-y divide-gray-900/10">
                    <h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Frequently asked
                        questions</h2>
                    <dl class="mt-10 space-y-6 divide-y divide-gray-900/10">
                        <div class="pt-6">
                            <dt>
                                <!-- Expand/collapse question button -->
                                <div class="flex w-full items-start justify-between text-left text-gray-900"
                                    aria-controls="faq-0" aria-expanded="false">
                                    <span class="text-base/7 font-semibold">What happens when I update one of my Confluence pages?</span>
                                </div>
                            </dt>
                            <dd class="mt-2 pr-12" id="faq-0">
                                <p class="text-base/7 text-gray-600">Astro Docs will automatically update the page data when you click save so that your customers will always see the most up to date version of any page.</p>
                            </dd>
                        </div>
                    </dl>
                    <dl class="mt-10 space-y-6 divide-y divide-gray-900/10">
                        <div class="pt-6">
                            <dt>
                                <!-- Expand/collapse question button -->
                                <div class="flex w-full items-start justify-between text-left text-gray-900"
                                    aria-controls="faq-0" aria-expanded="false">
                                    <span class="text-base/7 font-semibold">How easy is it to set up my Confluence space as a public website?</span>
                                </div>
                            </dt>
                            <dd class="mt-2 pr-12" id="faq-0">
                                <p class="text-base/7 text-gray-600">No technical background is required to launch a public knowledge base with Astro Docs. It takes two clicks to deploy a fully searchable knowledge site based on a Confluence space.</p>
                            </dd>
                        </div>
                    </dl>
                    <dl class="mt-10 space-y-6 divide-y divide-gray-900/10">
                        <div class="pt-6">
                            <dt>
                                <!-- Expand/collapse question button -->
                                <div class="flex w-full items-start justify-between text-left text-gray-900"
                                    aria-controls="faq-0" aria-expanded="false">
                                    <span class="text-base/7 font-semibold">Can I control which pages are visible on my public site?</span>
                                </div>
                            </dt>
                            <dd class="mt-2 pr-12" id="faq-0">
                                <p class="text-base/7 text-gray-600">Yes. You can toggle the visibility of each page individually to manage which pages your customers can see and which to keep private.</p>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </main>
    </div>
    {{-- Footer --}}
    {{-- <footer class="mt-32 bg-gray-900 sm:mt-56">
        <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24 lg:px-8 lg:py-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <img class="h-9" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500"
                    alt="Company name">
                <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm/6 font-semibold text-white">Solutions</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Marketing</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Analytics</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Automation</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Commerce</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Insights</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm/6 font-semibold text-white">Support</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Submit
                                        ticket</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm/6 text-gray-400 hover:text-white">Documentation</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Guides</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm/6 font-semibold text-white">Company</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">About</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Blog</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Jobs</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Press</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm/6 font-semibold text-white">Legal</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Terms of
                                        service</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">Privacy
                                        policy</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm/6 text-gray-400 hover:text-white">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}
</body>

</html>
