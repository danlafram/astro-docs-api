@extends('layout.layout')

@section('content')
        <div class="max-w-7xl sm:px-6 lg:grid md:grid lg:grid-rows-2 md:grid-rows-2">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="mt-8 flow-root border border border-2 py-2 px-10">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold text-gray-900">Domain</h1>
                            <p class="mt-2"><span class='text-gray-700'>You can forward your company's subdomain to your Astro docs app. Follow the instructions outlined in </span><a class='text-blue-500 hover:underline' href="#">this document</a></p>
                        </div>
                    </div>

                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <form method="POST" action="/dashboard/domain/confirm" class="content-center">
                                @csrf
                                <div class="space-y-12">
                                  <div class="pb-12 w-1/3">                              
                                    <div class="sm:col-span-4">
                                        <label for="subdomain" class="block text-sm/6 font-medium text-gray-900">Your custom subdomain</label>
                                        <div class="mt-2">
                                          <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300">
                                            <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6 mr-2">https://</div>
                                            <input type="text" name="subdomain" id="subdomain" class="border-0 block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6" value={{ $domain->domain }} />
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="mt-6 flex items-center justify-start gap-x-6">
                                  <button type="submit" class="rounded-md border-black hover:border-indigo-600 bg-indigo-600 px-3 py-2 text-sm text-white hover:text-white font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                                </div>
                              </form>
                        </div>
                    </div>
                </div>
                
                {{-- TODO: Check if the domain is our default. If it isn't, display instructions on setting up subdomain --}}
                <div class="mt-8 flow-root border border border-2 py-2 px-10">
                  <div class="sm:flex sm:items-center">
                      <div class="sm:flex-auto">
                          <h1 class="text-base font-semibold text-gray-900">DNS settings</h1>
                          <p class="mt-2"><span class='text-gray-700'>Please ensure to follow these instructions with your DNS settings in order to ensure Astro Docs can serve your documentation on your subdomain.</a></p>
                      </div>
                  </div>
                  {{-- CNAME instructions --}}
                  <div class='mt-5 divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 shadow sm:grid sm:grid-cols-3 sm:gap-px sm:divide-y-0'>
                    <div class="group relative rounded-bl-lg bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 sm:rounded-bl-none">
                        <h3 class="text-base font-semibold text-gray-900">Type: CNAME</h3>
                    </div>
                    <div class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 sm:rounded-bl-none">
                        <h3 class="text-base font-semibold text-gray-900">Name: { your subdomain }</h3>
                    </div>
                    <div class="group relative rounded-br-lg bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 sm:rounded-bl-none">
                        <h3 class="text-base font-semibold text-gray-900">Value: domains.astro-docs.com <span id='copy_cname' class='hover:cursor-pointer text-indigo-500 text-sm ml-1 '>Copy value</span></h3>
                    </div>
                  </div>

                  {{-- TXT Instructions TODO: Update these to get them form the CF Hostnames API response and store them in our DB with the domains --}}
                  <div class='mt-5 divide-y divide-gray-200 overflow-hidden rounded-lg bg-gray-200 shadow sm:grid sm:grid-cols-3 sm:gap-px sm:divide-y-0'>
                    <div class="group relative rounded-bl-lg bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 sm:rounded-bl-none">
                        <h3 class="text-base font-semibold text-gray-900">Type: TXT</h3>
                    </div>
                    <div class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 sm:rounded-bl-none">
                        {{-- Add copy function here --}}
                        <h3 class="text-base font-semibold text-gray-900">Name: _cf-custom-hostname.help</h3>
                    </div>
                    <div class="group relative rounded-br-lg bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500 sm:rounded-bl-none">
                        {{-- Add copy function here --}}
                        <h3 class="text-base font-semibold text-gray-900">Value: e3888829-c69f-4588-b285-9395f9864e0e <span id='copy_cname' class='hover:cursor-pointer text-indigo-500 text-sm ml-1 '>Copy value</span></h3>
                    </div>
                  </div>

                </div>
              </div>
            </div>
        </div>
<script>
    $("#copy_cname").on( "click", function() {
      navigator.clipboard.writeText('domains.astro-docs.com');
    });
</script>
@endsection
