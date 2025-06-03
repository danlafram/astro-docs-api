@extends('layout.layout')

@section('content')
<div class="lg:pt-10 lg:z-50 lg:flex lg:flex-row">
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                <div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-base text-lg font-semibold leading-6 text-gray-900" id="modal-title">Are you sure you want to update your subdomain?</h3>
                        <div class="mt-2">
                            <p class="text-md text-gray-900">There is some setup required with your DNS provider to enable custom subdomains. 
                                Please ensure you have access to your company's DNS settings to ensure the custom subdomain works. 
                                Setup instructions will be provided on the following page.</p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <form method='POST' action="/dashboard/domain/update">
                        @csrf 
                        <input type='hidden' name='subdomain' value='{{ $subdomain }}' />
                        <button type='submit'
                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                    </form>
                    
                    <a href="{{ url('/dashboard/domain') }}"
                        class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>