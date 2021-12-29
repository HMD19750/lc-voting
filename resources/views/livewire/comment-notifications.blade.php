<div x-data="{isOpen:false}" class="relative">
    <button @click=
        "isOpen=!isOpen
        if(isOpen) {
            Livewire.emit('getNotifications')
            }
        ">
        <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
            </path>
        </svg>
        <div
            class="absolute flex items-center justify-center w-6 h-6 text-white border-2 rounded-full bg-red text-xxs -top-1 -right-1">
            2
        </div>
    </button>

    <ul class="absolute z-10 overflow-y-auto text-sm text-left text-gray-700 bg-white -right-28 md:-right-12 w-76 shadow-dialog rounded-xl top-8 md:w-96 max-h-128"
        x-show.transition.origin.top="isOpen" x-cloak @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false">

        @foreach ($notifications as $notification )


        <li><a href="{{ route('idea.show',$notification->data['idea_slug']) }}"
            {{-- @click.prevent="isOpen=false"  --}}
                class="flex px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">
                <img src="{{ $notification->data['user_avatar'] }}" class="w-10 h-10 rounded-xl">
                <div class="ml-4">
                    <div class="line-clamp-6">
                        <span class="font-semibold">{{ $notification->data['user_name'] }}</span>
                        commented on
                        <span class="font-semibold">{{ $notification->data['idea_title'] }}</span>
                        :
                        <span>"{{ $notification->data['comment_body'] }}"</span>
                    </div>
                    <div class="mt-2 text-xs text-gray-500 ">
                        {{ $notification->created_at->diffForHumans()  }}
                    </div>
                </div>
            </a>
        </li>
        @endforeach

        <li class="text-center border-t border-gray-300 ">
            <button
                class="block w-full px-5 py-4 font-semibold transition duration-150 ease-in focus:font-semibold hover:bg-gray-100">
                Mark all as read
            </button>
        </li>




    </ul>

</div>
