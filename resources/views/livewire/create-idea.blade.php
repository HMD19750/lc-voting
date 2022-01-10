<div x-cloak x-data="{isOpen:false,markDown:false }" x-show="isOpen" @keydown.escape.window="isOpen=false"
    @custom-show-create-modal.window="
        isOpen=true
        $nextTick(()=>$refs.title.focus())
        " x-init="
        window.livewire.on('ideaWasCreated',()=>{
            isOpen=false
        })
        " class="fixed inset-0 z-10 overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen ">

        <div x-show="isOpen" x-transition.opacity.duration.1000ms
            class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true">
        </div>

        <div x-show="isOpen" x-transition.origin.bottom.duration.500ms
            class="py-4 overflow-hidden transition-all transform bg-white rounded-tl-xl rounded-tr-xl modal sm:max-w-4xl sm:w-full">

            {{-- Close button --}}
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button @click="isOpen=false" class="text-gray-400 hover:text-gray-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">

                <h3 class="text-lg font-bold text-center text-gray-900">Create idea</h3>

                <p class="px-6 mt-4 text-xs leading-5 text-center text-gray-500">
                    Let your ideas flow!!
                </p>

                <form wire:submit.prevent='createIdea' action="#" method="POST" class="px-4 py-6 space-y-4">
                    <div>
                        <input wire:model.defer="title" x-ref="title" type="text" required
                            class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl"
                            placeholder="Your Idea">
                        @error('title')
                        <p class="mt-1 text-xs text-red">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div>
                        <select wire:model.defer="category" name="category_add" id="category_add"
                            class="w-full px-4 py-2 text-sm bg-gray-100 border-none rounded-xl">

                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div>
                        <div x-show="!markDown">
                            <textarea wire:model="description" name="idea" id="idea" cols="30" rows="6" required
                                class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl">
                            </textarea>
                            @error('description')
                            <p class="mt-1 text-xs text-red">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div x-show="markDown"
                            class="w-full px-4 py-2 overflow-auto text-sm bg-gray-100 border-none rounded-xl"
                            style="height:153.5px;">
                            <article class="prose-sm prose">
                                {!! Str::markdown($description) !!}
                            </article>
                        </div>


                    </div>
                    <div class="flex items-center justify-between space-x-3">

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

                        <x-button
                            class="flex items-center justify-center w-1/4 "
                            type="submit"
                        >
                            Create
                        </x-button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
