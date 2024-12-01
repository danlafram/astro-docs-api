@extends('layouts.default')
@section('content')
    <x-header />
    <main class='flex flex-col lg:min-w-md h-screen pt-28'>

        <div class='mx-auto m-5 text-center'>
            {{-- TODO: Swap this out with company name --}}
            <p>Whoops, 404 page not found</p>
            <h1 class=' text-4xl my-5'>We couldn't find the page you were looking for</h1>
            <br />
            {{-- Random content --}}
            @if(isset($pages))
                <h2 class=' text-xl my-5'>Try one of these pages instead</h2>
                <div class='grid grid-cols-2 mx-auto gap-4 mt-10 text-center'> 
                    @foreach ($pages as $page)
                        <div class='rounded-full bg-gray-200 py-1 px-5 flex flex-col'><a class='my-auto text-centre hover:underline'
                                href="{{ url($page->slug) }}">{{ $page->title }}</a></div>
                    @endforeach
                </div>
            @endif
        {{-- Random content end --}}
        </div>
    </main>
    {{-- <x-contact /> --}}
    {{-- <x-footer /> --}}
@stop
