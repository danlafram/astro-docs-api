<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Astro Docs Admin</title>

    <link rel="icon" href="{{ global_asset('img/Astro-logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    {{-- TODO: Remove this from all the files, only required for one --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased bg-gray-50">
    <div class="min-h-screen">
        @livewire('navigation-menu')
        
        {{-- Off-canvas menu for mobile --}}
        <div class="relative z-50 lg:hidden hidden" id="mobile-menu" aria-modal="true">
            <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity"></div>
            <div class="fixed inset-0 flex">
                <div class="relative mr-16 flex w-full max-w-xs flex-1">
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" class="-m-2.5 p-2.5" onclick="toggleMobileMenu()">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4 shadow-xl">
                        <div class="flex h-16 shrink-0 items-center border-b border-gray-200">
                            <img class="h-8 w-auto" src="{{ global_asset('img/Astro-logo.png') }}" alt="Astro Docs">
                            <span class="ml-2 text-xl font-bold text-gray-900">Astro Docs</span>
                        </div>
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                <li>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        <li>
                                            <a href="/dashboard"
                                                class="{{ Request::is('dashboard') ? 'bg-indigo-50 border-r-2 border-indigo-600 text-indigo-700' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-semibold transition-all duration-200">
                                                <svg class="h-5 w-5 shrink-0 {{ Request::is('dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 13h1v7c0 1.1.9 2 2 2h2V11h8v11h2c1.1 0 2-.9 2-2v-7h1c.6 0 1.1-.4 1.4-.9.3-.5.2-1.1-.1-1.5l-8.5-9c-.7-.8-1.9-.8-2.6 0l-8.5 9c-.3.4-.4 1-.1 1.5.3.5.8.9 1.4.9z" />
                                                </svg>
                                                Admin
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/dashboard/theme') }}"
                                                class="{{ Request::is('dashboard/theme*') ? 'bg-indigo-50 border-r-2 border-indigo-600 text-indigo-700' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-semibold transition-all duration-200">
                                                <svg class="h-5 w-5 shrink-0 {{ Request::is('dashboard/theme*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                                </svg>
                                                Pages & Themes
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/dashboard/domains') }}"
                                                class="{{ Request::is('dashboard/domains*') ? 'bg-indigo-50 border-r-2 border-indigo-600 text-indigo-700' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-semibold transition-all duration-200">
                                                <svg class="h-5 w-5 shrink-0 {{ Request::is('dashboard/domains*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
                                                </svg>
                                                Domain Settings
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class='flex flex-row min-h-screen'>
            <!-- Static sidebar for desktop -->
            <div class="hidden lg:flex lg:w-72 lg:flex-col lg:fixed lg:inset-y-0 lg:z-10">
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white border-r border-gray-200 shadow-sm">
                    <!-- Logo section -->
                    <div class="flex h-16 shrink-0 items-center px-6 border-b border-gray-200 bg-white">
                        <img class="h-8 w-auto" src="{{ global_asset('img/Astro-logo.png') }}" alt="Astro Docs">
                        <span class="ml-2 text-xl font-bold text-gray-900">Astro Docs</span>
                    </div>
                    
                    <nav class="flex flex-1 flex-col px-6 pb-4">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <a href="/dashboard"
                                            class="{{ Request::is('dashboard') ? 'bg-indigo-50 border-r-2 border-indigo-600 text-indigo-700' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-semibold transition-all duration-200">
                                            <svg class="h-5 w-5 shrink-0 {{ Request::is('dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 13h1v7c0 1.1.9 2 2 2h2V11h8v11h2c1.1 0 2-.9 2-2v-7h1c.6 0 1.1-.4 1.4-.9.3-.5.2-1.1-.1-1.5l-8.5-9c-.7-.8-1.9-.8-2.6 0l-8.5 9c-.3.4-.4 1-.1 1.5.3.5.8.9 1.4.9z" />
                                            </svg>
                                            <span>Admin</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/dashboard/theme') }}"
                                            class="{{ Request::is('dashboard/theme*') ? 'bg-indigo-50 border-r-2 border-indigo-600 text-indigo-700' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-semibold transition-all duration-200">
                                            <svg class="h-5 w-5 shrink-0 {{ Request::is('dashboard/theme*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                            </svg>
                                            <span>Pages & Themes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/dashboard/domains') }}"
                                            class="{{ Request::is('dashboard/domains*') ? 'bg-indigo-50 border-r-2 border-indigo-600 text-indigo-700' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }} group flex gap-x-3 rounded-l-md p-3 text-sm leading-6 font-semibold transition-all duration-200">
                                            <svg class="h-5 w-5 shrink-0 {{ Request::is('dashboard/domains*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-indigo-600' }}"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
                                            </svg>
                                            <span>Domain Settings</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- User section at bottom -->
                            <li class="mt-auto">
                                <div class="flex items-center gap-x-4 px-2 py-3 text-sm font-semibold leading-6 text-gray-900 bg-gray-50 rounded-lg">
                                    <div class="h-8 w-8 rounded-full bg-indigo-600 flex items-center justify-center">
                                        <span class="text-xs font-medium text-white">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                                    </div>
                                    <span class="sr-only">Your profile</span>
                                    <div class="flex-1">
                                        <span aria-hidden="true">{{ auth()->user()->name ?? 'User' }}</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="lg:hidden fixed top-4 left-4 z-40">
                <button type="button" 
                        class="inline-flex items-center justify-center rounded-md bg-white p-2.5 text-gray-700 shadow-sm border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        onclick="toggleMobileMenu()">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>

            <!-- Main content -->
            <div class="flex-1 lg:pl-72">
                <main class="min-h-screen">
                    <div class="mx-auto">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </div>

    @livewireScripts

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobile-menu');
            const menuButton = event.target.closest('button');
            
            if (!menu.contains(event.target) && !menuButton && !menu.classList.contains('hidden')) {
                menu.classList.add('hidden');
            }
        });

        // Add smooth scrolling and improved mobile experience
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading state for navigation links
            const navLinks = document.querySelectorAll('nav a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (this.href !== window.location.href) {
                        this.style.opacity = '0.6';
                        this.style.pointerEvents = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>