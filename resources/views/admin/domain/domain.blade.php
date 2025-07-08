@extends('layout.layout')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="space-y-8">
                <!-- Domain Configuration Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                    Custom Domain
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    You can forward your company's subdomain to your content. 
                                    {{-- TODO: Add a setup guide and link to it here --}}
                                    {{-- <a class='text-blue-600 hover:text-blue-800 hover:underline font-medium' href="#">
                                        Follow our setup guide →
                                    </a> --}}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <form method="POST" action="/dashboard/domain/confirm" class="space-y-6">
                            @csrf
                            
                            <div class="max-w-md">
                                <label for="subdomain" class="block text-sm font-medium text-gray-700 mb-2">
                                    Your Custom Subdomain
                                    <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="flex items-center rounded-lg border border-gray-300 bg-white shadow-sm focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                                        <div class="flex items-center pl-3 pr-2 text-gray-500 text-sm font-medium">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                            https://
                                        </div>
                                        <input 
                                            type="text" 
                                            name="subdomain" 
                                            id="subdomain" 
                                            class="block w-full border-0 bg-transparent py-2.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm" 
                                            value="{{ $domain->domain }}" 
                                            placeholder="docs.yourcompany.com"
                                        />
                                    </div>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">Enter the full subdomain where you want your documentation to be accessible</p>
                            </div>

                            <div class="flex items-center">
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transform hover:scale-105">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Update Domain
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- DNS Configuration Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    DNS Configuration
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">Add these DNS records to your domain provider to complete the setup</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Setup Instructions -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">Setup Instructions</h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <p>Please add the following DNS records to your domain provider. Both records are required for proper SSL certificate provisioning and domain verification.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CNAME Record -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-900 flex items-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                                        CNAME
                                    </span>
                                    Domain Alias Record
                                </h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-gray-200">
                                <div class="px-4 py-4">
                                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Type</dt>
                                    <dd class="mt-1 text-sm font-semibold text-gray-900">CNAME</dd>
                                </div>
                                <div class="px-4 py-4">
                                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</dt>
                                    <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $domain->domain }}</dd>
                                </div>
                                <div class="px-4 py-4">
                                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Value</dt>
                                    <dd class="mt-1 flex items-center justify-between">
                                        <span class="text-sm font-semibold text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">domains.astro-docs.com</span>
                                        <button id='copy_cname' 
                                                class='inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded transition-colors duration-200'>
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                            Copy
                                        </button>
                                    </dd>
                                </div>
                            </div>
                        </div>

                        <!-- TXT Record -->
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                <h3 class="text-sm font-semibold text-gray-900 flex items-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 mr-2">
                                        TXT
                                    </span>
                                    SSL Verification Record
                                </h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-gray-200">
                                <div class="px-4 py-4">
                                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Type</dt>
                                    <dd class="mt-1 text-sm font-semibold text-gray-900">TXT</dd>
                                </div>
                                <div class="px-4 py-4">
                                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Name</dt>
                                    <dd class="mt-1 flex items-center justify-between">
                                        <span class="text-sm font-semibold text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded">_cf-custom-hostname.help</span>
                                        <button id='copy_txt_name' 
                                                class='inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded transition-colors duration-200'>
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                            Copy
                                        </button>
                                    </dd>
                                </div>
                                <div class="px-4 py-4">
                                    <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Value</dt>
                                    <dd class="mt-1 flex items-center justify-between">
                                        <span class="text-sm font-semibold text-gray-900 font-mono bg-gray-100 px-2 py-1 rounded text-xs">e3888829-c69f-4588-b285-9395f9864e0e</span>
                                        <button id='copy_txt_value' 
                                                class='inline-flex items-center px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200 rounded transition-colors duration-200'>
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                            Copy
                                        </button>
                                    </dd>
                                </div>
                            </div>
                        </div>

                        <!-- Verification Status -->
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-amber-800">Verification Pending</h3>
                                    <div class="mt-2 text-sm text-amber-700">
                                        <p>After adding these DNS records, it may take up to 24 hours for the changes to propagate and your domain to become active. We'll automatically verify the setup once the records are detected.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $("#copy_cname").on("click", function() {
        navigator.clipboard.writeText('domains.astro-docs.com');
        showCopySuccess(this);
    });

    $("#copy_txt_name").on("click", function() {
        navigator.clipboard.writeText('_cf-custom-hostname.help');
        showCopySuccess(this);
    });

    $("#copy_txt_value").on("click", function() {
        navigator.clipboard.writeText('e3888829-c69f-4588-b285-9395f9864e0e');
        showCopySuccess(this);
    });

    function showCopySuccess(button) {
        const originalText = button.innerHTML;
        button.innerHTML = '<svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Copied!';
        button.classList.remove('bg-indigo-100', 'text-indigo-700');
        button.classList.add('bg-green-100', 'text-green-700');
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-100', 'text-green-700');
            button.classList.add('bg-indigo-100', 'text-indigo-700');
        }, 2000);
    }
</script>
@endsection