<div x-data="{isOpen:false }"

    >
        <button
            @click="
                isOpen=true
                setTimeout(()=>{
                    isOpen=false
                },5000)
        ">
            Toggel
        </button>
    <div
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-8"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-8"
        x-show="isOpen"
        @keydown.escape.window="isOpen=false"
        x-init="
            window.livewire.on('ideaWasUpdated',()=>{
            isOpen=false
        })
        "
        class="fixed bottom-0 right-0 z-20 flex justify-between w-full px-6 py-5 mx-6 my-8 bg-white border shadow-lg max-w-cs sm:max-w-sm rounded-xl"
    >
        <div class="flex items-center ">
            <svg class="w-6 h-6 text-green" fill="none" stroke="currentColor" viewBox="0 0 24 24" ><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="ml-2 font-semibold text-gray-500 texxt-sm sm:text-base">Test with a success message</div>
        </div>
        <button @click="isOpen=false" class="ml-5 text-gray-400 hover:text-gray-500">
            <svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </button>
    </div>
    </div>
