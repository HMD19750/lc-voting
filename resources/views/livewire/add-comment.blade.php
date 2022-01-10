<div
    x-cloak
    x-data="{isOpen:false,markDown:false }"
    x-init="
        Livewire.on('commentWasAdded', () => {
            isOpen = false
        })
        Livewire.hook('message.processed', (message, component) => {
            {{-- Pagination --}}
            if (['gotoPage', 'previousPage', 'nextPage'].includes(message.updateQueue[0].method)) {
                const firstComment = document.querySelector('.comment-container:first-child')
                firstComment.scrollIntoView({ behavior: 'smooth'})
            }
            {{-- Adding Comment --}}
            if ((message.updateQueue[0].payload.event === 'commentWasAdded'||
            message.updateQueue[0].payload.event === 'statusWasUpdated')
             && message.component.fingerprint.name === 'idea-comments') {
                const lastComment = document.querySelector('.comment-container:last-child')
                lastComment.scrollIntoView({ behavior: 'smooth'})
                lastComment.classList.add('bg-green-50')
                setTimeout(() => {
                    lastComment.classList.remove('bg-green-50')
                }, 5000)
            }
        })

        @if(session('scrollToComment'))
            const commentToScrollTo = document.querySelector('#comment-{{ session('scrollToComment') }}')
                commentToScrollTo.scrollIntoView({ behavior: 'smooth'})
                commentToScrollTo.classList.add('bg-green-50')
                setTimeout(() => {
                    commentToScrollTo.classList.remove('bg-green-50')
                }, 5000)
        @endif
    "
    class="relative z-10"
>

<x-button
    type="button"
    class="w-32 h-11"
    @click.prevent="isOpen = !isOpen
        if (isOpen) {
        $nextTick(() => $refs.comment.focus())
        }"
>
    Reply
</x-button>


    <div class="absolute z-10 w-64 mt-2 text-sm font-semibold text-left bg-white md:w-104 shadow-dialog rounded-xl"
        x-cloak x-show.transition.origin.top.left="isOpen" @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false">

        @auth
        <form wire:submit.prevent="addComment" action="#" class="px-4 py-6 space-y-4">
            <div>
                <div>
                    <div x-show="!markDown">
                        <textarea wire:model="comment" name="idea" id="idea" cols="30" rows="6" required
                            class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl">
                        </textarea>
                        @error('comment')
                        <p class="mt-1 text-xs text-red">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div x-show="markDown"
                        class="w-full px-4 py-2 overflow-auto text-sm bg-gray-100 border-none rounded-xl"
                        style="height:153.5px;">
                        <article class="prose-sm prose">
                            {!! Str::markdown($comment) !!}
                        </article>
                    </div>


                </div>
                <div class="flex items-center justify-between mt-2 space-x-3">

                    <div class="flex items-center justify-between w-60">
                        <span class="hidden text-xs text-gray-700 md:block dark:text-gray-300 "
                            :class="markDown ? 'font-medium' : 'font-bold'">Edit mode</span>
                        <label for="mdToggle" class="relative flex items-center cursor-pointer">
                            <input type="checkbox" id="mdToggle" class="sr-only " x-model="markDown">
                            <div
                                class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600">
                            </div>

                        </label>
                        <span class="text-xs text-gray-700 dark:text-gray-300 "
                            :class="!markDown ? 'font-medium' : 'font-bold'">Markdown preview</span>
                    </div>

                </div>

            </div>

            <div class="flex flex-col items-center md:flex-row md:space-x-3">

                <x-button color="blue" type="submit" class="w-1/2 h-11 md:w-1/2">Post Comment </x-button>

            </div>

        </form>
        @else
        <div class="px-4 py-6">
            <p class="font-normal">
                Please log in or register to post a comment.
            <div class="flex items-center mt-8 space-x-3">
                <a
                    wire:click.prevent='redirectToLogin'
                    href="{{ route('login') }}"
                    class="flex items-center justify-center w-full px-6 py-3 text-sm font-semibold text-white transition duration-150 ease-in border h-11 md:w-1/2 bg-blue rounded-xl border-blue hover:bg-blue-hover">Login</a>
                <a
                    wire:click.prevent='redirectToRegister'
                    href="{{ route('register') }}"
                    class="flex items-center justify-center w-full px-6 py-3 mt-2 text-xs font-semibold transition duration-150 ease-in bg-gray-200 border border-gray-200 md:w-32 h-11 rounded-xl hover:border-gray-400 md:mt-0">Register</a>
            </div>
            </p>
        </div>
        @endauth
    </div>
</div>
