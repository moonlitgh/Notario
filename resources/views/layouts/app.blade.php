<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Notario') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen bg-[#0F2C33] text-[#E6D1B4] antialiased">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="relative z-10 border-b border-[#2E9CA0]/20 bg-[#0F2C33]/80 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <a href="{{ route('home') }}"
                            class="text-2xl font-bold text-[#2E9CA0] hover:text-[#EFA00F] transition-colors duration-200">
                            Notario
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <!-- User Dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="inline-flex items-center px-4 py-2 border border-[#2E9CA0]/30 rounded-xl text-sm font-medium text-[#E6D1B4] hover:border-[#EFA00F] hover:text-[#EFA00F] transition-all duration-200">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 z-50 mt-2 w-48 rounded-xl shadow-lg bg-[#21616A] border border-[#2E9CA0]/30 backdrop-blur-lg"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">

                                    <!-- Dashboard -->
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-3 text-sm text-[#E6D1B4] hover:bg-[#2E9CA0]/20 transition-colors duration-200 rounded-t-xl">
                                        Dashboard
                                    </a>

                                    <!-- Tasks -->
                                    <a href="{{ route('tasks.index') }}"
                                        class="block px-4 py-3 text-sm text-[#E6D1B4] hover:bg-[#2E9CA0]/20 transition-colors duration-200">
                                        Tasks
                                    </a>

                                    <!-- Divider -->
                                    <div class="border-t border-[#2E9CA0]/20"></div>

                                    <!-- Logout Form -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-3 text-sm text-[#E6D1B4] hover:bg-[#2E9CA0]/20 transition-colors duration-200 rounded-b-xl">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="relative z-50 flex items-center space-x-4">
                                <a href="{{ route('login') }}"
                                    class="text-[#E6D1B4] hover:text-[#EFA00F] transition-colors duration-200">
                                    Log in
                                </a>
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center px-4 py-2 rounded-xl bg-[#2E9CA0] hover:bg-[#21616A] text-[#E6D1B4] font-medium transition-colors duration-200">
                                    Sign In
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="relative z-0">
            {{ $slot }}
        </main>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
