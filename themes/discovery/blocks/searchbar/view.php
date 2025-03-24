<div>
    <form class="pt-5 w-4/5 xl:w-2/5 lg:w-1/2 mx-auto" action="/search" method="GET">
        <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
        <div class="flex flex-col items-center md:relative lg:relative">
            <div class="hidden md:flex lg:absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none ">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
                <?php
                    if(isset($response)){
                        echo "<input type='search' id='search' name='query' value='" . $response['query'] . "
                    class='block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500'
                    placeholder='Search for anything in our documentation...' required />";
                    } else {
                        echo "<input type='search' id='search' name='query'
                    class='block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500'
                    placeholder='Search for anything in our documentation...' required />";
                    }
                ?>
                
            
            <button type="submit"
                class="mt-1 w-1/2 lg:w-min text-white lg:absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
        </div>

        
        <div>
            <div id='results-list' 
                class="block hidden px-0 w-full text-sm text-gray-500 bg-transparent border rounded-lg appearance-none focus:ring-0 peer">
            </div>
        </div>
    </form>
</div>
