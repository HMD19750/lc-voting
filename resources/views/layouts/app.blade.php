<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laracasts Voting</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans text-sm text-gray-900 bg-gray-background">
    <header class="flex items-center justify-between px-8 py-4">
        <a href="#">
            <img src={{ asset('img/logo.svg') }} alt="logo">
        </a>
        <div class="flex items-center">

            @if (Route::has('login'))
                <div class="px-6 py-4 ">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>

                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline dark:text-gray-500">Log
                            in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 underline dark:text-gray-500">Register</a>
                        @endif @endauth
                    </div>
                @endif

                <a href="#">
                    <img src="https://www.gravatar.com/avatar/00000000000000000000000000000?d=mp" alt="avatar"
                        class="w-10 h-10 rounded-full"> </a>
            </div>
        </header>

        <main class="container flex mx-auto max-w-custom">
            <div class="mr-5 w-70">
                Qui enim tempor sit veniam veniam in aliqua ullamco elit mollit incididunt id. Non voluptate ut tempor
                adipisicing dolore anim quis consectetur elit. Dolore ipsum aute qui eu ipsum irure pariatur aliquip. Mollit
                laboris duis adipisicing fugiat est nulla sit proident. Ad culpa et occaecat dolor esse nulla elit enim
                reprehenderit dolore. Dolor laboris commodo excepteur quis.
            </div>
            <div class="w-175">
                <nav class="flex items-center justify-between text-xs">
                    <ul class="flex pb-3 space-x-10 font-semibold uppercase border-b-4">
                        <li><a href="#" class="pb-3 border-b-4 border-blue">All Ideas(87)</a></li>
                        <li><a href="#"
                                class="pb-3 text-gray-400 transition duration-150 ease-in border-b-4 hover:border-blue">Considering(6)</a>
                        </li>
                        <li><a href="#"
                                class="pb-3 text-gray-400 transition duration-150 ease-in border-b-4 hover:border-blue">In
                                Progress(1)</a></li>
                    </ul>

                    <ul class="flex pb-3 space-x-10 font-semibold uppercase border-b-4">
                        <li><a href="#"
                                class="pb-3 text-gray-400 transition duration-150 ease-in border-b-4 hover:border-blue">Implemented(10)</a>
                        </li>
                        <li><a href="#"
                                class="pb-3 text-gray-400 transition duration-150 ease-in border-b-4 hover:border-blue">Closed(55)</a>
                        </li>
                    </ul>
                </nav>
                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>

    </html>
