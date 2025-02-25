<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <x-app-layout>
        <div class="relative isolate bg-[#0F2C33] min-h-screen">
            <!-- Enhanced Gradient Background -->
            <div class="fixed inset-0 -z-10 overflow-hidden">
                <!-- Larger gradient circles with higher opacity -->
                <div
                    class="absolute -top-20 left-1/4 w-[500px] h-[500px] bg-[#21616A] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob">
                </div>
                <div
                    class="absolute top-1/3 -right-20 w-[600px] h-[600px] bg-[#2E9CA0] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000">
                </div>
                <div
                    class="absolute -bottom-20 left-1/3 w-[550px] h-[550px] bg-[#EFA00F] rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob animation-delay-4000">
                </div>

                <!-- Adjusted gradient overlay for better visibility -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#0F2C33]/90 via-transparent to-[#21616A]/30"></div>
            </div>

            <!-- Main Content -->
            <div class="relative z-10 container mx-auto px-6 py-16">
                <!-- Hero Section -->
                <div class="flex flex-col md:flex-row items-center justify-between gap-12 mb-24">
                    <div class="max-w-xl space-y-6">
                        <h1 class="text-5xl md:text-7xl font-bold text-[#E6D1B4] leading-tight">
                            Manage Tasks<br>
                            <span class="text-[#2E9CA0]">Smarter</span> &
                            <span class="text-[#EFA00F]">Faster</span>
                        </h1>

                        <p class="text-xl text-[#E6D1B4]/80 leading-relaxed">
                            Tingkatkan produktivitas Anda dengan platform manajemen tugas yang intuitif. Dirancang untuk
                            individu dan tim yang ingin mencapai lebih banyak hal dengan lebih efisien.
                        </p>

                        <div class="flex items-center gap-4">
                            @auth
                                <a href="{{ route('tasks.index') }}"
                                    class="px-8 py-4 rounded-xl bg-[#2E9CA0] text-[#E6D1B4] font-medium hover:bg-[#21616A] transform hover:scale-105 transition-all duration-200">
                                    View Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                    class="px-8 py-4 rounded-xl bg-[#2E9CA0] text-[#E6D1B4] font-medium hover:bg-[#21616A] transform hover:scale-105 transition-all duration-200">
                                    Get Started Free
                                </a>
                                <a href="{{ route('login') }}"
                                    class="px-8 py-4 rounded-xl border-2 border-[#EFA00F]/50 text-[#EFA00F] font-medium hover:bg-[#EFA00F]/10 transition-all duration-200">
                                    Sign In
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Stats Cards dengan layout yang lebih menarik -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl mx-auto">
                        <div class="bg-[#21616A]/50 p-8