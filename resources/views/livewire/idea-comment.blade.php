<div class="
        @if($comment->is_status_update)
        is-status-update
        {{ 'status-'.Str::kebab($comment->status->name) }}
        @endif
        relative flex mt-4 bg-white comment-container rounded-xl"
        id="comment-{{ $comment->id }}"
>
    <div class="flex flex-col flex-1 px-4 py-6 md:flex-row">
        <div class="flex-none">
            <a href="#">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
            @if($comment->user->isadmin())
                <div class="mt-1 font-bold text-center uppercase text-blue text-xxs">Admin</div>
            @endif

            @if(!$comment->is_status_update)  {{-- Like button is not shown for status updates --}}

            {{-- Liking is only possible if you have not liked the comment yet --}}
                @if($hasLiked)
                    <button
                        wire:click.prevent='like'
                        class="ml-3 "
                    >
                        <div class="relative flex items-center justify-center w-8 h-8">
                            <svg class="absolute z-0 text-gray-200 w-7 h-7" fill="currentColor" viewBox="0 0 20 20" >
                                <path fillRule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clipRule="evenodd" />
                            </svg>
                            <div class="z-10 text-black text-xxs">{{ $likesCount }}</div>
                        </div>
                    </button>
                @else
                    <button
                        wire:click.prevent='like'
                        class="ml-3"
                    >
                        <div class="relative flex items-center justify-center w-8 h-8">
                            <svg class="absolute z-0 w-7 h-7 text-blue" fill="currentColor" viewBox="0 0 20 20" >
                                <path fillRule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clipRule="evenodd" />
                            </svg>
                            <div class="z-10 text-white text-xxs">{{ $likesCount }}</div>
                        </div>
                    </button>
                @endif
            @endif


        </div>
        <div class="w-full md:mx-4">
            @if($comment->is_status_update)
                <h4 class="mb-3 text-xl font-semibold">
                    Status Changed to "{{ $comment->status->name }}"
                </h4>
            @endif

            @admin
            @if($comment->spam_reports>0)
                <div class="mb-2 text-red">Spam reports: {{ $comment->spam_reports }}</div>
            @endif
            @endadmin
            <div class="text-gray-600 ">
                <article class="leading-snug prose-sm prose">
                    {!! Str::markdown($comment->body) !!}
                </article>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">

                    <div class="font-bold text-gray-900
                    @if($comment->is_status_update) text-blue @endif
                    ">
                        {{ $comment->user->name }}
                    </div>

                    <div>&bull;</div>
                    @if($comment->user->id==$ideaUserId)
                    <div class="px-3 py-1 bg-gray-100 border rounded-full">
                        OP
                    </div>
                    <div>&bull;</div>
                    @endif
                    <div>{{ $comment->created_at->diffForHumans() }}</div>


                </div>

                @auth

                <div class="flex items-center space-x-2" x-data="{ isOpen: false }">
                    <div class="relative">

                        <button
                            class="relative px-3 py-2 transition duration-150 ease-in bg-gray-100 border rounded-full hover:bg-gray-200 h-7"
                            @click="isOpen = !isOpen">
                            <svg fill="currentColor" width="24" height="6">
                                <path
                                    d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                    style="color: rgba(163, 163, 163, .5)">
                            </svg>
                        </button>

                        <ul class="absolute right-0 z-10 py-3 font-semibold text-left bg-white w-44 shadow-dialog rounded-xl md:ml-8 top-8 md:top-6 md:left-0"
                            x-cloak x-show.transition.origin.top.left="isOpen" @click.away="isOpen = false"
                            @keydown.escape.window="isOpen = false">

                            @can('update',$comment)
                            <li><a href="#" @click.prevent="
                                    {{-- $dispatch('custom-show-edit-modal') --}}
                                    Livewire.emit('setEditComment',{{ $comment->id }})
                                    isOpen=false
                                    " class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">
                                    Edit Comment
                                </a>
                            </li>
                            @endcan

                            @if(!$comment->is_status_update)      {{-- Status updates mogen niet als spam worden gerapporteeerd --}}
                                <li><a href="#" @click.prevent="
                                    Livewire.emit('setMarkAsSpamComment',{{ $comment->id }})
                                    isOpen=false
                                    " class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">
                                        Mark as Spam
                                    </a>
                                </li>
                            @endif


                            @admin
                                @if($comment->spam_reports>0)
                                    <li><a href="#" @click.prevent="
                                        Livewire.emit('setMarkAsNotSpamComment',{{ $comment->id }})
                                        isOpen=false
                                        " class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">
                                            Reset spam counter
                                        </a>
                                    </li>
                                @endif
                            @endadmin

                            @can('delete',$comment)
                            <li><a href="#" @click.prevent="
                                Livewire.emit('setDeleteComment',{{ $comment->id }})
                                isOpen=false
                                " class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">
                                    Delete Comment
                                </a>
                            </li>
                            @endcan
                        </ul>

                    </div>
                </div>

                @endauth

            </div>
        </div>
    </div>
</div> <!-- end comment-container -->
