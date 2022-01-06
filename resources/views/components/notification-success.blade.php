@props([
    'type'=>'success',
    'redirect'=>false,
    'messageToDisplay'=>''
])

<div x-cloak
    x-data="{
        isOpen:false,
        isError:@if($type=='success') false @elseif ($type='error') true @endif,
        messageToDisplay:'{{ $messageToDisplay }}',
        showNotification(message) {
            this.isOpen=true
            this.messageToDisplay=message
            setTimeout(()=>{
                this.isOpen=false
            },3000)
        }
    }"
    x-init="
        @if($redirect)
            $nextTick(()=>showNotification(messageToDisplay))
        @else
            Livewire.on('ideaWasUpdated',message=>{
                isError=false
                showNotification(message)
            })

            Livewire.on('ideaWasCreated',message=>{
                isError=false
                showNotification(message)
            })

            Livewire.on('ideaWasMarkedAsSpam',message=>{
                isError=false
                showNotification(message)
            })

            Livewire.on('ideaWasMarkedAsNotSpam',message=>{
                isError=false
                showNotification(message)
            })

            Livewire.on('statusWasUpdated',message=>{
                isError=false
                showNotification(message)
            })

            Livewire.on('statusWasUpdatedError',message=>{
                isError=true
                showNotification(message)
            })

            Livewire.on('commentWasAdded',message=>{
                isError=false
                showNotification(message)
            })

            Livewire.on('commentWasUpdated',message=>{
                isError=false
                showNotification(message)
            })

            Livewire.on('commentWasDeleted',message=>{
                isError=false
                showNotification(message)
            })

            Livewire.on('commentWasMarkedAsSpam',message=>{
                isError=false
                showNotification(message)
            })

            Livewire.on('commentWasMarkedAsNotSpam',message=>{
                isError=false
                showNotification(message)
            })
        @endif
        "
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-x-8"
    x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform translate-x-8" x-show="isOpen" @keydown.escape.window="isOpen=false"
    class="fixed bottom-0 right-0 z-20 flex justify-between w-full px-4 py-5 mx-4 my-8 bg-white border shadow-lg max-w-cs sm:max-w-sm rounded-xl">

    <div class="flex items-center ">
        <svg
            x-show="isError"
            class="w-6 h-6 text-red"
            fill="currentColor"
            viewBox="0 0 20 20"
        >
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>

        <svg
            x-show="!isError"
            class="w-6 h-6 text-green"
            fill="none" stroke="currentColor"
            viewBox="0 0 24 24"
        >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>

        <div class="ml-2 font-semibold text-gray-500 texxt-sm sm:text-base" x-text="messageToDisplay"> </div>
    </div>

    <button @click="isOpen=false" class="ml-5 text-gray-400 hover:text-gray-500">
            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>

    </button>

</div>
