@extends('layouts.default')
@section('content')
    <x-header />
    <main class='flex flex-col lg:min-w-md h-screen pt-28'>

        <div class='mx-auto m-5 text-center'>
            {{-- TODO: Swap this out with company name --}}
            <p>{{$site_name}}'s knowledge base</p>
            <h1 class=' text-4xl my-5'>Search for anything in our documentation</h1>
        </div>
        {{-- Search form --}}
        <x-searchbar />
        {{-- Search form end --}}

        {{-- Random content --}}
        <div class='grid grid-cols-2 mx-auto gap-4 mt-10 text-center'>
            @foreach ($pages as $page)
                <div class='rounded-full bg-gray-200 py-1 px-5 flex flex-col'><a class='my-auto text-centre hover:underline'
                        href="{{ url($page->slug) }}">{{ $page->title }}</a></div>
            @endforeach
        </div>
        {{-- Random content end --}}

        {{-- TODO: Consider adding categories here based on Confluence folders or tags? --}}
    </main>
    {{-- <x-contact />
    <x-footer /> --}}
@stop
