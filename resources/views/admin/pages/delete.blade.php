@extends('layout.layout')

@section('content')
<div class="lg:pt-10 lg:z-50 lg:flex lg:flex-row">
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                <div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Are you sure you want to delete the {{ $page->getName() }} page?</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Please ensure you want to delete this page before continuing. This delete cannot be undone.</p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <form method='POST' action="/dashboard/page/{{ $page->getId() }}/delete">
                        @csrf
                        <button type='submit'
                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-red-600 shadow-sm hover:bg-red-500 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Delete</button>
                    </form>
                    
                    <a href="{{ url('/dashboard/theme') }}"
                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>