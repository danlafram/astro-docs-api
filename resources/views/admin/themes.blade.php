@extends('layout.layout')

@section('content')
    <div class="lg:pt-10 lg:z-50 lg:flex lg:flex-row">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    {{-- Themes section --}}
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
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
                                            {{ $theme }}</td>
                                        <td
                                            class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 grid grid-cols-5 gap-5">
                                            {{-- TODO: Update this to be theme id when we have themes in DB --}}

                                            <a href="{{ url('dashboard/theme/' . $theme . '/publish') }}"
                                                class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                Publish
                                            </a>
                                            {{-- <a href='{{ url($theme) }}' target="_blank"
                                                class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                View
                                            </a>
                                            <a href="{{ url('dashboard/page/' . $theme . '/edit') }}"
                                                class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                Settings
                                            </a>
                                            <a href="{{ url('dashboard/page/' . $theme . '/duplicate') }}"
                                                class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-gray-700 hover:bg-gray-50 hover:text-indigo-600">
                                                Duplicate
                                            </a>
                                            <a href="{{ url('dashboard/page/' . $theme . '/delete') }}"
                                                class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-black bg-red hover:bg-gray-50 hover:text-indigo-600">
                                                Delete
                                            </a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br />
                        {{-- Pages section --}}
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
                                            <a href="{{ url('dashboard/page/' . $page->getId() . '/delete') }}"
                                                class="group hover:cursor-pointer -mx-2 flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 text-black bg-red hover:bg-gray-50 hover:text-indigo-600">
                                                Delete
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
@endsection
