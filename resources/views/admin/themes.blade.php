@extends('layout.layout')

@section('content')
    <div class="lg:pt-10 lg:z-50 lg:flex lg:flex-row">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        {{-- Pages section --}}
                        <div class='border border-2 py-2 px-10'>
                            <div class="sm:flex sm:items-center">
                                <div class="sm:flex-auto">
                                    <h1 class="text-base font-semibold leading-6 text-gray-900">Pages</h1>
                                    <p class="mt-2 text-sm text-gray-700">Create and edit new pages that will be displayed on
                                        your site.</p>
                                </div>
                                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                    <a href="{{ url('/dashboard/page/create') }}"
                                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white hover:text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                                        new page</a>
                                </div>
                            </div>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">URL
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                {{ $page->getName() }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ $page->getRoute() }}</td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 grid grid-cols-5 gap-5">
                                                <a href="{{ url('dashboard/pages/' . $page->getId() . '/build') }}"
                                                    class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    Edit
                                                </a>
                                                <a href='{{ url($page->getRoute()) }}' target="_blank"
                                                    class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    View
                                                </a>
                                                <a href="{{ url('dashboard/page/' . $page->getId() . '/edit') }}"
                                                    class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    Settings
                                                </a>
                                                <a href="{{ url('dashboard/page/' . $page->getId() . '/duplicate') }}"
                                                    class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    Duplicate
                                                </a>
                                                @if($page->is_default)
                                                    <button disabled
                                                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:bg-gray-300">
                                                        Delete
                                                    </button>
                                                @else
                                                    <a href="{{ url('dashboard/page/' . $page->getId() . '/delete') }}"
                                                        class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-black bg-red hover:bg-gray-50 hover:text-indigo-600">
                                                        Delete
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br />
                        {{-- Themes section --}}
                        <div class='border border-2 py-2 px-10'>
                            <div class="sm:flex sm:items-center">
                                <div class="sm:flex-auto">
                                    <h1 class="text-base font-semibold leading-6 text-gray-900">Themes</h1>
                                    <p class="mt-2 text-sm text-gray-700">Manage your themes by publishing existing themes or
                                        importing new ones</p>
                                </div>
                                {{-- Not ready for theme importing yet --}}
                                {{-- <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                    <a href="{{ url('/dashboard/page/create') }}"
                                        class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white hover:text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Import new theme</a>
                                </div> --}}
                            </div>
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Theme
                                            name
                                        </th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($themes as $theme)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                                {{ $theme->name }}</td>
                                            <td
                                                class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 grid grid-cols-5 gap-5">
                                                {{-- TODO: Update this to be theme id when we have themes in DB --}}

                                                <a href="{{ url('dashboard/theme/' . $theme->id . '/publish') }}"
                                                    class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                    Publish
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
