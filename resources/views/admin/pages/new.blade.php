@extends('layout.layout')

{{-- TODO - Render the languages instead of hardcoding at some point --}}
@section('content')
<form method="POST" action="/dashboard/page/create" class="content-center">
  @csrf
  <div class="space-y-12 w-screen">
    <div class="pb-12 w-1/3">
      <h2 class="text-base font-semibold leading-7 text-gray-900">Page Information</h2>

      <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 ">
        <div class="sm:col-span-3">
          <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Page name</label>
          <div class="mt-2">
            <input required type="text" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
      </div>

      <div class="mt-5 grid grid-cols-1">
        <label for="layout" class="block text-sm font-medium leading-6 text-gray-900">Layout</label>
        <select id="layout" name="layout" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
            @foreach ($layouts as $layout)
              <option value="{{ $layout }}">{{ $layout }}</option>
            @endforeach
        </select>
      </div>

      <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 ">
        <div class="sm:col-span-3">
          <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Page menu title</label>
          <div class="mt-2">
            <input required type="text" name="title[en]" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
      </div>

      <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 ">
        <div class="sm:col-span-3">
          <label for="meta_title" class="block text-sm font-medium leading-6 text-gray-900">Page meta title</label>
          <div class="mt-2">
            <input type="text" name="meta_title[en]" id="meta_title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
      </div>

      <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 ">
        <div class="sm:col-span-3">
          <label for="meta_description" class="block text-sm font-medium leading-6 text-gray-900">Page meta description</label>
          <div class="mt-2">
            <input type="text" name="meta_description[en]" id="meta_description" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
      </div>

      <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 ">
        <div class="sm:col-span-3">
          <label for="route" class="block text-sm font-medium leading-6 text-gray-900">URL</label>
          <div class="mt-2">
            <input required type="text" name="route[en]" id="route" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <div class="mt-6 flex items-center justify-start gap-x-6">
    <a href="{{ url('dashboard/theme') }}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
    <button type="submit" class="rounded-md border-black border-2 hover:border-indigo-600 bg-indigo-600 px-3 py-2 text-sm text-black hover:text-white font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create</button>
  </div>
</form>

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