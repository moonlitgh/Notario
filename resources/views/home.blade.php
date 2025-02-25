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

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-2 gap-4 w-full max-w-sm">
                        <div class="bg-[#21616A]/50 p-6 rounded-2xl border border-[#2E9CA0]/30 backdrop-blur-sm">
                            <div class="text-3xl font-bold text-[#EFA00F] mb-1">15k+</div>
                            <div class="text-[#E6D1B4]/80">Active Users</div>
                        </div>
                        <div class="bg-[#21616A]/50 p-6 rounded-2xl border border-[#2E9CA0]/30 backdrop-blur-sm">
                            <div class="text-3xl font-bold text-[#2E9CA0] mb-1">250k+</div>
                            <div class="text-[#E6D1B4]/80">Tasks Done</div>
                        </div>
                        <div
                            class="bg-[#21616A]/50 p-6 rounded-2xl border border-[#2E9CA0]/30 backdrop-blur-sm col-span-2">
                            <div class="text-3xl font-bold text-[#EFA00F] mb-1">4.9/5</div>
                            <div class="text-[#E6D1B4]/80">User Rating</div>
                        </div>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="max-w-7xl mx-auto mb-24">
                    <h2 class="text-3xl font-bold text-[#E6D1B4] text-center mb-12">Kenapa Harus Notario?</h2>
                    <div class="grid md:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div
                            class="group bg-[#21616A]/30 p-8 rounded-2xl border border-[#2E9CA0]/30 hover:bg-[#21616A]/50 transition-all duration-300">
                            <div
                                class="w-14 h-14 bg-[#2E9CA0]/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-[#2E9CA0]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-[#E6D1B4] mb-3">Mudah Digunakan</h3>
                            <p class="text-[#E6D1B4]/70">Antarmuka yang simpel dan intuitif membuat pencatatan tugas
                                menjadi
                                cepat dan efisien tanpa kebingungan.</p>
                        </div>

                        <!-- Feature 2 -->
                        <div
                            class="group bg-[#21616A]/30 p-8 rounded-2xl border border-[#2E9CA0]/30 hover:bg-[#21616A]/50 transition-all duration-300">
                            <div
                                class="w-14 h-14 bg-[#EFA00F]/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-[#EFA00F]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-[#E6D1B4] mb-3">Fitur Lengkap</h3>
                            <p class="text-[#E6D1B4]/70">Notario menyediakan fitur seperti pengingat, kategori tugas,
                                dan
                                status penyelesaian untuk membantu manajemen waktu yang lebih baik.</p>
                        </div>

                        <!-- Feature 3 -->
                        <div
                            class="group bg-[#21616A]/30 p-8 rounded-2xl border border-[#2E9CA0]/30 hover:bg-[#21616A]/50 transition-all duration-300">
                            <div
                                class="w-14 h-14 bg-[#ff0000]/10 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-[#ff0000]" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-[#E6D1B4] mb-3">Aksesibilitas Tinggi</h3>
                            <p class="text-[#E6D1B4]/70">Dapat diakses dari berbagai perangkat sehingga Anda bisa
                                mengelola
                                tugas kapan saja dan di mana saja.</p>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="max-w-3xl mx-auto text-center">
                    <div class="bg-[#21616A]/30 p-12 rounded-2xl border border-[#2E9CA0]/30">
                        <h2 class="text-3xl font-bold text-[#E6D1B4] mb-6">Siap Meningkatkan Produktivitas Anda?</h2>
                        <p class="text-[#E6D1B4]/80 mb-8 text-lg">Bergabunglah dengan ribuan profesional yang telah
                            mengoptimalkan alur kerja mereka.</p>
                        <a href="{{ route('register') }}"
                            class="inline-flex px-8 py-4 rounded-xl bg-[#EFA00F] text-[#0F2C33] font-medium hover:bg-[#EFA00F]/90 transform hover:scale-105 transition-all duration-200">
                            Mulai Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

</body>

</html>
