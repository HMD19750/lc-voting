<x-app-layout>

    {{-- Header part with menus and filters --}}

    <div class="flex space-x-6 filters">
        <div class="w-1/3">
            <select name="category" id="category" class="w-full px-4 py-2 border-none rounded-xl">
                <option value="Category One">Category One</option>
                <option value="Category Two">Category Two</option>
            </select>
        </div>

        <div class="w-1/3">
            <select name="other filters" id="other filters" class="w-full px-4 py-2 border-none rounded-xl">
                <option value="Filter One">Filter One</option>
                <option value="Filter Two">Filter Two</option>
            </select>
        </div>
        <div class="relative w-2/3">

            <input type="search" placeholder="Find an idea"
                class="w-full px-4 py-2 pl-8 placeholder-gray-900 bg-white border-none rounded-xl">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="w-4 h-4" text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- An idea card --}}
    <div class="my-6 space-y-6 ideas-container">

        <div class="flex transition ease-in bg-white cursor-pointer idea-container rounded-xl hover:shadow-card duration:150">

            <div class="px-5 py-8 border-r border-gray-100">

                <div class="text-center">
                    <div class="text-2xl font-semibold">
                        12
                    </div>
                    <div class="text-gray-500">Votes</div>
                </div>

                <div class="mt-8">
                    <button
                        class="px-4 py-3 font-bold uppercase transition ease-in bg-gray-200 border border-gray-200 text-xxs duration:150 hover:border-gray-400 xl:w-20 rounded-xl">Vote</button>
                </div>
            </div>


            <div class="flex flex-1 px-2 py-6">
                <div class="flex-none">
                <a href="#" >
                    <img src="https://source.unsplash.com/random/200x200/?face&crop=face&v=3" alt="avatar"
                        class="w-14 h-14 rounded-xl">
                </a>
                </div>
                <div class="w-full mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">
                            A random title can go here
                        </a>
                    </h4>
                    <div class="mt-3 text-gray-600 line-clamp-3">
                        Eiusmod id Lorem laboris magna fugiat ad officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt. Eiusmod id Lorem laboris magna fugiat ad officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                            <div class="">10 hours ago</div>
                            <div>&bull;</div>
                            <div class="">Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>

                        <div x-data="{isOpen:false}" class="flex items-center space-x-2">
                            <div
                                class="px-4 py-2 font-bold leading-none text-center uppercase bg-gray-200 border rounded-full h-7 text-xxs w-28">
                                Open
                            </div>
                            <button @click="isOpen=!isOpen"
                                class="relative px-3 py-2 transition ease-in bg-gray-100 rounded-full hover:bg-gray-200 h-7 duration:150">
                                <svg class="w-6 h-4 " fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                    </path>
                                </svg>

                                <ul
                                x-show="isOpen" x-transition.origin.top.left.duration.500ms
                                @click.away="isOpen=false" x-cloak @keydown.escape.window="isOpen=false"
                                    class="absolute py-3 ml-8 font-semibold text-left bg-white shadow-dialog w-44 rounded-xl">
                                    <li><a href="#" class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark as spam</a></li>
                                    <li><a href="#" class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- A second idea card --}}
    <div class="my-6 space-y-6 ideas-container">

        <div class="flex transition ease-in bg-white cursor-pointer idea-container rounded-xl hover:shadow-card duration:150">

            <div class="px-5 py-8 border-r border-gray-100">

                <div class="text-center">
                    <div class="text-2xl font-semibold text-blue">
                        66
                    </div>
                    <div class="text-gray-500">Votes</div>
                </div>

                <div class="mt-8">
                    <button
                        class="px-4 py-3 font-bold text-white uppercase transition ease-in bg-gray-200 border border-gray-200 bg-blue text-xxs duration:150 hover:border-gray-400 xl:w-20 rounded-xl">Vote</button>
                </div>
            </div>


            <div class="flex flex-1 px-2 py-6">
                <div class="flex-none">
                <a href="#" >
                    <img src="https://source.unsplash.com/random/200x200/?face&crop=face&v=2" alt="avatar"
                        class="w-14 h-14 rounded-xl">
                </a>
                </div>

                <div class="w-full mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">
                            This is another random title
                        </a>
                    </h4>
                    <div class="mt-3 text-gray-600 line-clamp-3">
                        Eiusmod id Lorem laboris magna fugiat ad officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt. Eiusmod id Lorem laboris magna fugiat ad officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                            <div class="">10 hours ago</div>
                            <div>&bull;</div>
                            <div class="">Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>

                        <div x-data="{isOpen:false}" class="flex items-center space-x-2">
                            <div
                                class="px-4 py-2 font-bold leading-none text-center text-white uppercase border rounded-full bg-yellow h-7 text-xxs w-28">
                                In Progress
                            </div>
                            <button @click="isOpen=!isOpen"
                                class="relative px-3 py-2 transition ease-in bg-gray-100 rounded-full hover:bg-gray-200 h-7 duration:150">
                                <svg class="w-6 h-4 " fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                    </path>
                                </svg>

                                <ul x-show="isOpen" x-transition.origin.top.left.duration.500ms
                                @click.away="isOpen=false" x-cloak @keydown.escape.window="isOpen=false"
                                    class="absolute py-3 ml-8 font-semibold text-left bg-white shadow-dialog w-44 rounded-xl">
                                    <li><a href="#" class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark as spam</a></li>
                                    <li><a href="#" class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
