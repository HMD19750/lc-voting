<x-app-layout>
    <a href="/" class="flex items-center font-semibold hover:underline">
        <span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </span>
        <span class="ml-2">All Ideas</span>
    </a>

    <div class="my-6 space-y-6 ideas-container">

        <div class="flex mt-4 bg-white idea-container rounded-xl ">


            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
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
                    <div class="mt-3 text-gray-600">
                        Eiusmod id Lorem laboris magna fugiat ad officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt. Eiusmod id Lorem laboris magna fugiat ad
                        officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt. Tempor nisi quis Lorem fugiat aute fugiat
                        cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt. Eiusmod id Lorem laboris magna fugiat ad
                        officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div class="">10 hours ago</div>
                            <div>&bull;</div>
                            <div class="">Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 Comments</div>
                        </div>

                        <div x-data='{isOpen:false}' class="flex items-center space-x-2">
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

                                <ul x-show="isOpen" x-transition.origin.top.left.duration.500ms
                                    @click.away="isOpen=false" x-cloak @keydown.escape.window="isOpen=false"
                                    class="absolute py-3 ml-8 font-semibold text-left bg-white shadow-dialog w-44 rounded-xl">
                                    <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark
                                            as spam</a></li>
                                    <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete
                                            Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> {{-- End of idea container --}}

    <div class="flex items-center justify-between mt-6 buttons-container">

        <div class="flex items-center ml-6 space-x-4">
            <div class="relative" x-data="{replyOpen:false}">
                <button type="button" @click="replyOpen=!replyOpen"
                    class="flex items-center justify-center w-32 h-8 px-6 py-3 font-semibold text-white transition ease-in border text-s border-blue bg-blue rounded-xl hover:bg-blue-hover duration:150">
                    <span class="ml-1">Reply</span>
                </button>

                {{-- Reply submenu --}}
                <div x-show="replyOpen" x-transition.origin.top.left.duration.500ms @click.away="replyOpen=false"
                    x-cloak @keydown.escape.window="replyOpen=false"
                    class="absolute z-10 mt-2 text-sm font-semibold text-left bg-white w-104 rounded-xl shadow-dialog">
                    <form action="#" class="px-4 py-6 space-y-4">
                        <div>
                            <textarea name="post_comment" id="post_comment" cols="30" rows="4"
                                class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl"
                                placeholder="Don't be shy. Share your thoughts."></textarea>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="submit"
                                class="flex items-center justify-center w-1/2 h-8 px-6 py-3 font-semibold text-white transition ease-in border text-s border-blue bg-blue rounded-xl hover:bg-blue-hover duration:150">
                                Post Comment
                            </button>
                            <button type="button"
                                class="flex items-center justify-center w-32 h-8 px-6 py-3 text-xs font-semibold transition ease-in bg-gray-200 border border-gray-200 rounded-xl hover:border-gray-400 duration:150">
                                <span clas="ml-2 ">
                                    <svg class="w-4 text-gray-600 transform -rotate-45" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                </span>
                                <span>Attach</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="relative" x-data="{statusOpen:false}">

                <button type="button" @click="statusOpen=!statusOpen"
                    class="flex items-center justify-center h-8 px-6 py-3 font-semibold transition ease-in bg-gray-200 border border-gray-200 text-s w-36 rounded-xl hover:border-gray-400 duration:150">

                    <span>Set Status</span>
                    <span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </span>
                </button>

                {{-- Set Status submenu --}}
                <div x-show="statusOpen" x-transition.origin.top.left.duration.500ms @click.away="statusOpen=false"
                    x-cloak @keydown.escape.window="statusOpen=false"
                    class="absolute z-20 mt-2 text-sm font-semibold text-left bg-white w-76 rounded-xl shadow-dialog">
                    <form action="#" class="px-4 py-6 space-y-4">
                        <div class="space-y-2">
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="bg-gray-200 border-none form-radio text-green" type="radio" checked=""
                                        name="radio-direct" value="1" class="bg-green">
                                    <span class="ml-2">Open</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="bg-gray-200 border-none form-radio text-purple" type="radio"
                                        name="radio-direct" value="2">
                                    <span class="ml-2">Considering</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="bg-gray-200 border-none form-radio text-yellow" type="radio"
                                        name="radio-direct" value="2">
                                    <span class="ml-2">In progress</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="bg-gray-200 border-none form-radio text-green" type="radio"
                                        name="radio-direct" value="2">
                                    <span class="ml-2">Implemented</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input class="bg-gray-200 border-none form-radio text-red" type="radio"
                                        name="radio-direct" value="2">
                                    <span class="ml-2">Closed</span>
                                </label>
                            </div>
                        </div>

                        <textarea name="update_comment" id="update_comment" cols="30" rows="3"
                            class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl"
                            placeholder="Add an updated comment (Optional)."></textarea>

                        <div class="flex items-center space-x-3">
                            <button type="button"
                                class="flex items-center justify-center w-32 h-8 px-6 py-3 text-xs font-semibold transition ease-in bg-gray-200 border border-gray-200 rounded-xl hover:border-gray-400 duration:150">
                                <span clas="ml-2 ">
                                    <svg class="w-4 text-gray-600 transform -rotate-45" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                </span>
                                <span>Attach</span>
                            </button>

                            <button type="submit"
                                class="flex items-center justify-center w-1/2 h-8 px-6 py-3 font-semibold text-white transition ease-in border text-s border-blue bg-blue rounded-xl hover:bg-blue-hover duration:150">
                                Update
                            </button>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input class="bg-gray-200 border-none disabled:rounded form-checkbox"
                                    name="notify_voters" type="checkbox" checked="">
                                <span class="ml-2">Notify all voters</span>
                            </label>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="flex items-center justify-center space-x-3">
            <div class="px-3 py-2 font-semibold text-center bg-white rounded-xl">
                <div class="text-xl leading-snug">
                    12
                </div>
                <div class="text-xs leading-none text-gray-400">
                    Votes
                </div>
            </div>

            <button type="button"
                class="w-32 h-8 px-6 py-2 text-xs font-semibold uppercase transition duration-150 ease-in bg-gray-200 border border-gray-200 rounded-xl hover:border-gray-400">
                vote
            </button>
        </div>

    </div> {{-- End of buttons container --}}

    {{-- Comments container --}}
    <div class="relative pt-4 my-8 mt-1 space-y-6 comments-container ml-22">

        <div id="comment" class="relative flex mt-4 bg-white comment-container rounded-xl ">


            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/random/200x200/?face&crop=face&v=3" alt="avatar"
                            class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full mx-4">

                    <div class="mt-3 text-gray-600 line-clamp-3">
                        Eiusmod id Lorem laboris magna fugiat ad officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt. Eiusmod id Lorem laboris magna fugiat ad
                        officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div class="">10 hours ago</div>
                        </div>

                        <div x-data="{isOpen:false}" class="flex items-center space-x-2">

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
                                    <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark
                                            as spam</a></li>
                                    <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete
                                            Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- End of comment container --}}

        {{-- Admin comment section --}}
        <div class="relative flex mt-4 bg-white is-admin comment-container rounded-xl ">

            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/random/200x200/?face&crop=face&v=7" alt="avatar"
                            class="w-14 h-14 rounded-xl">
                    </a>
                    <div class="font-bold text-center uppercase text-xxs text-blue nt-1">Admin</div>
                </div>
                <div class="w-full mx-4">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline">
                            Status changed to "under consideration"!
                        </a>
                    </h4>
                    <div class="mt-3 text-gray-600 line-clamp-3">
                        Eiusmod id Lorem laboris magna fugiat ad officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt. Eiusmod id Lorem laboris magna fugiat ad
                        officia commodo occaecat. Consequat nulla sint do
                        consectetur.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                            <div class="font-bold text-blue">Andrea</div>
                            <div>&bull;</div>
                            <div class="">10 hours ago</div>
                        </div>

                        <div x-data="{isOpen:false}" class="flex items-center space-x-2" >

                            <button @click="isOpen=!isOpen"
                                class="relative px-3 py-2 transition ease-in bg-gray-100 rounded-full hover:bg-gray-200 h-7 duration:150">
                                <svg class="w-6 h-4 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                    </path>
                                </svg>

                                <ul x-show="isOpen" x-transition.origin.top.left.duration.500ms
                                    @click.away="isOpen=false" x-cloak @keydown.escape.window="isOpen=false"
                                    class="absolute invisible py-3 ml-8 font-semibold text-left bg-white shadow-dialog w-44 rounded-xl">
                                    <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark
                                            as spam</a></li>
                                    <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete
                                            Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- End of admin container --}}

        {{-- Comment container --}}
        <div class="relative flex mt-4 bg-white comment-container rounded-xl ">


            <div class="flex flex-1 px-4 py-6">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/random/200x200/?face&crop=face&v=3" alt="avatar"
                            class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full mx-4">

                    <div class="mt-3 text-gray-600 line-clamp-3">
                        Eiusmod id Lorem laboris magna fugiat ad officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt. Eiusmod id Lorem laboris magna fugiat ad
                        officia commodo occaecat. Consequat nulla sint do
                        consectetur. Tempor nisi quis Lorem fugiat aute fugiat cupidatat cillum ipsum duis. Elit aliquip
                        nulla veniam Lorem nostrud minim aliquip et sunt.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div class="">10 hours ago</div>

                        </div>

                        <div x-data='{istOpen:false}' class="flex items-center space-x-2">

                            <button @click="istOpen=!istOpen"
                                class="relative px-3 py-2 transition ease-in bg-gray-100 rounded-full hover:bg-gray-200 h-7 duration:150">
                                <svg class="w-6 h-4 " fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                    </path>
                                </svg>

                                <ul x-show="istOpen" x-transition.origin.top.left.duration.500ms
                                    @click.away="istOpen=false" x-cloak @keydown.escape.window="istOpen=false"
                                    class="absolute invisible py-3 ml-8 font-semibold text-left bg-white shadow-dialog w-44 rounded-xl">
                                    <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark
                                            as spam</a></li>
                                    <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete
                                            Post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- End of comment container --}}
    </div>{{-- End of comments container --}}
</x-app-layout>
