<div x-data>
    @auth
    <div class="flex justify-center px-4 py-6 space-y-4">
            <x-button  color="blue" type="submit" class="h11" @click.prevent="$dispatch('custom-show-create-modal')">Start creation</x-button>
        </div>
    </div>
    @else
    <div class="my-6 text-center">

        <x-button
        wire:click.prevent='redirectToLogin'
        href="{{ route('login') }}"
        class="justify-center inline-block w-1/2 "
        color="blue">
        Login
        </x-button>

        <x-button
        wire:click.prevent='redirectToRegister'
        href="{{ route('register') }}"
        class="justify-center inline-block w-1/2 mt-4"
        color="gray">
        Register
        </x-button>


    </div>
    @endauth
</div>
