<div x-data>
    @auth
    <div class="flex justify-center px-4 py-6 space-y-4">
            <button
                @click.prevent="$dispatch('custom-show-create-modal')"
                type="submit"
                class="px-6 py-3 text-xs font-semibold text-white transition duration-150 ease-in border h-11 bg-blue rounded-xl border-blue hover:bg-blue-hover"
            >
                <span class="ml-1">Start Creation</span>
            </button>
        </div>
    </div>
    @else
    <div class="my-6 text-center">
        <a
            wire:click.prevent='redirectToLogin'
            href="{{ route('login') }}"
            class="justify-center inline-block w-1/2 px-6 py-3 text-xs font-semibold text-white transition duration-150 ease-in border bg-blue rounded-xl border-blue hover:bg-blue-hover"
        >
            <span class="ml-1">Login</span>
        </a>
        <a
            wire:click.prevent='redirectToRegister'
            href="{{ route('register') }}"
            class="justify-center inline-block w-1/2 px-6 py-3 mt-4 text-xs font-semibold transition duration-150 ease-in bg-gray-200 border border-gray-200 h-11 rounded-xl hover:border-gray-400"
        >
            <span class="ml-1">Register</span>
        </a>
    </div>
    @endauth
</div>
