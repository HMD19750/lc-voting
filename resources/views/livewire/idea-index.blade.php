<div x-data @click="
                target=$event.target.tagName.toLowerCase()
                const ignores=['button','svg','path','a','img']
                if(!ignores.includes(target)){
                    $event.target.closest('.idea-container').querySelector('.idea-link').click()
                }

        "
    class="flex transition duration-150 ease-in bg-white cursor-pointer idea-container hover:shadow-card rounded-xl">
    <div class="hidden px-5 py-8 border-r border-gray-100 md:block">
        <div class="text-center">
            <div class="text-2xl font-semibold @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
            <div class="text-gray-500">
                {{ $votesCount==1 ? 'Vote' : 'Votes' }}
            </div>
        </div>

        <div class="mt-8 ">
            @if($hasVoted)
                <button
                    wire:click.prevent='vote'
                    class="w-20 px-4 py-3 font-bold text-white uppercase transition duration-150 ease-in border bg-blue border-blue hover:bg-blue-hover text-xxs rounded-xl">
                    Voted
                </button>
            @else
                <button
                    wire:click.prevent='vote'
                    class="w-20 px-4 py-3 font-bold uppercase transition duration-150 ease-in bg-gray-200 border border-gray-200 hover:border-gray-400 text-xxs rounded-xl">
                    Vote
                </button>
            @endif

        </div>
    </div>
    <div class="flex flex-col flex-1 px-2 py-6 md:flex-row">

        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>

        <div class="flex flex-col justify-between w-full mx-2 md:mx-4">

            <h4 class="mt-2 text-xl font-semibold md:mt-0">
                <a href="{{ route('idea.show',$idea) }}" class="idea-link xl:hover:underline">{{ $idea->title }}</a>
            </h4>

            <div class="mt-3 text-gray-600 line-clamp-3">
                @admin
                    @if($idea->spam_reports>0)
                <div class="mb-2 text-red">Spam reports: {{ $idea->spam_reports }}</div>
                    @endif
                @endadmin
                <article class="leading-snug prose-sm prose">
                    {!! Str::markdown($idea->description) !!}
                </article>
            </div>

            <div class="flex flex-col justify-between mt-6 md:flex-row md:items-center">
                <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                    <div>{{ $idea->created_at->diffForHumans() }}</div>
                    <div>&bull;</div>
                    <div>{{ $idea->category->name }}</div>
                    <div>&bull;</div>
                    <div wire:ignore class="text-gray-900">
                        {{ $idea->comments_count }} Comments
                    </div>
                </div>

                <div x-data="{ isOpen: false }" class="flex items-center mt-4 space-x-2 md:mt-0">
                    <div
                        class="{{ $idea->getStatusClasses() }} px-4 py-2 font-bold leading-none text-center uppercase  rounded-full text-xxs w-28 h-7">
                        {{ $idea->status->name }}
                    </div>

                </div>

                {{-- Vote section on mobile --}}
                <div class="flex items-center mt-4 md:hidden md:mt-0">
                    <div class="h-10 px-4 py-2 pr-8 text-center bg-gray-100 rounded-xl">
                        <div class="text-sm font-bold leading-none @if($hasVoted) text-blue @endif">{{ $votesCount }}
                        </div>
                        <div class="font-semibold leading-none text-gray-400 text-xxs">Votes</div>
                    </div>

                    @if($hasVoted)
                    <button
                        wire:click.prevent='vote'
                        class="w-20 px-4 py-3 mx-5 font-bold text-white uppercase transition duration-150 ease-in border bg-blue border-blue text-xxs rounded-xl hover:bg-blue-hover">
                        Voted
                    </button>
                    @else
                    <button
                        wire:click.prevent='vote'
                        class="w-20 px-4 py-3 mx-5 font-bold uppercase transition duration-150 ease-in bg-gray-200 border border-gray-200 text-xxs rounded-xl hover:border-gray-400">
                        Vote
                    </button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div> <!-- end idea-container -->
