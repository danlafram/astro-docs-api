@extends('layout.layout')

{{-- TODO - Render the languages instead of hardcoding at some point --}}
@section('content')
<div class="min-h-screen bg-gray-50 py-8">
  <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <form method="POST" action="/dashboard/page/create">
        @csrf
        
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 px-6 py-4 border-b border-gray-200">
          <h2 class="text-xl font-semibold text-gray-900 flex items-center">
            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Page Information
          </h2>
          <p class="mt-1 text-sm text-gray-600">Configure the basic settings and metadata for your new page</p>
        </div>

        <!-- Form Content -->
        <div class="p-6 space-y-6">
          <!-- Page Name -->
          <div class="group">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
              Page Name
              <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <input 
                required 
                type="text" 
                name="name" 
                id="name" 
                class="block w-full rounded-lg border-gray-300 shadow-sm transition-all duration-200 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-opacity-20 sm:text-sm"
                placeholder="Enter a descriptive name for your page">
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
              </div>
            </div>
          </div>

          <!-- Layout Selection -->
          <div class="group">
            <label for="layout" class="block text-sm font-medium text-gray-700 mb-2">
              Layout Template
              <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <select 
                id="layout" 
                name="layout" 
                class="block w-full rounded-lg border-gray-300 shadow-sm transition-all duration-200 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-opacity-20 sm:text-sm">
                @foreach ($layouts as $layout)
                  <option value="{{ $layout }}">{{ $layout }}</option>
                @endforeach
              </select>
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </div>
            </div>
            <p class="mt-1 text-xs text-gray-500">Choose the layout template for your page structure</p>
          </div>

          <!-- Page Menu Title -->
          <div class="group">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
              Page Menu Title
              <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <input 
                required 
                type="text" 
                name="title[en]" 
                id="title" 
                class="block w-full rounded-lg border-gray-300 shadow-sm transition-all duration-200 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-opacity-20 sm:text-sm"
                placeholder="Title that appears in navigation menus">
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
              </div>
            </div>
            <p class="mt-1 text-xs text-gray-500">This title will appear in your site's navigation menu</p>
          </div>

          <!-- Meta Information Section -->
          <div class="bg-gray-50 rounded-lg p-4 space-y-4">
            <h3 class="text-sm font-medium text-gray-900 flex items-center">
              <svg class="w-4 h-4 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
              </svg>
              SEO & Meta Information
            </h3>
            <p class="text-xs text-gray-600">Optional settings to improve search engine optimization</p>
            
            <!-- Page Meta Title -->
            <div class="group">
              <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                Meta Title
              </label>
              <div class="relative">
                <input 
                  type="text" 
                  name="meta_title[en]" 
                  id="meta_title" 
                  class="block w-full rounded-lg border-gray-300 shadow-sm transition-all duration-200 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-opacity-20 sm:text-sm"
                  placeholder="SEO-optimized title for search engines">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                  <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                  </svg>
                </div>
              </div>
              <p class="mt-1 text-xs text-gray-500">Appears in search engine results and browser tabs</p>
            </div>

            <!-- Page Meta Description -->
            <div class="group">
              <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                Meta Description
              </label>
              <div class="relative">
                <textarea 
                  name="meta_description[en]" 
                  id="meta_description" 
                  rows="3"
                  class="block w-full rounded-lg border-gray-300 shadow-sm transition-all duration-200 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-opacity-20 sm:text-sm resize-none"
                  placeholder="Brief description of the page content for search engines"></textarea>
                <div class="absolute top-3 right-3 pointer-events-none">
                  <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                  </svg>
                </div>
              </div>
              <p class="mt-1 text-xs text-gray-500">Appears in search engine results below the title (160 characters max recommended)</p>
            </div>
          </div>

          <!-- URL Configuration -->
          <div class="group">
            <label for="route" class="block text-sm font-medium text-gray-700 mb-2">
              URL Path
              <span class="text-red-500">*</span>
            </label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <span class="text-gray-500 text-sm">/</span>
              </div>
              <input 
                required 
                type="text" 
                name="route[en]" 
                id="route" 
                class="block w-full pl-6 rounded-lg border-gray-300 shadow-sm transition-all duration-200 focus:border-indigo-500 focus:ring-indigo-500 focus:ring-2 focus:ring-opacity-20 sm:text-sm"
                placeholder="page-url-path">
              <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                </svg>
              </div>
            </div>
            <p class="mt-1 text-xs text-gray-500">The URL path where this page will be accessible (use lowercase and hyphens)</p>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex items-center justify-between">
          <a href="{{ url('dashboard/theme') }}" 
             class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Cancel
          </a>
          
          <button type="submit" 
                  class="inline-flex items-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transform hover:scale-105">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Page
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(function() {
    $("#layout").on("change", function(event) {
      if(event.target.value === 'listing'){
        $("#configuration-input").removeClass('hidden');
      } else {
        $("#configuration-input").addClass('hidden');
      }
    });
  });
</script>

@endsection