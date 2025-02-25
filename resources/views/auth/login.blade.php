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
        <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <!-- Background Gradients -->
            <div class="fixed inset-0 -z-10 overflow-hidden">
                <div
                    class="absolute -top-20 left-1/4 w-[500px] h-[500px] bg-[#21616A] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob">
                </div>
                <div
                    class="absolute top-1/3 -right-20 w-[600px] h-[600px] bg-[#2E9CA0] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000">
                </div>
                <div
                    class="absolute -bottom-20 left-1/3 w-[550px] h-[550px] bg-[#EFA00F] rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob animation-delay-4000">
                </div>
            </div>

            <!-- Login Container -->
            <div class="max-w-md w-full">
                <!-- Login Card -->
                <div class="relative">
                    <!-- Card Glow Effect -->
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-[#2E9CA0] to-[#EFA00F] rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-1000">
                    </div>

                    <!-- Card Content -->
                    <div
                        class="relative bg-[#0F2C33]/80 backdrop-blur-xl p-8 rounded-2xl border border-[#2E9CA0]/30 shadow-2xl">
                        <!-- Logo/Brand -->
                        <div class="mb-8 text-center">
                            <h2
                                class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#2E9CA0] to-[#EFA00F] mb-2">
                                Welcome Back</h2>
                            <p class="text-[#E6D1B4]/70">Continue your productivity journey</p>
                        </div>

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-[#E6D1B4]">Email</label>
                                <div class="relative">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        required autofocus
                                        class="w-full bg-[#21616A]/20 border border-[#2E9CA0]/30 rounded-xl px-4 py-3 text-[#E6D1B4]
                                        focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F] transition-all duration-200
                                        placeholder-[#E6D1B4]/30"
                                        placeholder="Enter your email">
                                </div>
                                @error('email')
                                    <p class="text-sm text-[#EFA00F]">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-medium text-[#E6D1B4]">Password</label>
                                <div class="relative">
                                    <input type="password" id="password" name="password" required
                                        class="w-full bg-[#21616A]/20 border border-[#2E9CA0]/30 rounded-xl px-4 py-3 text-[#E6D1B4]
                                        focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F] transition-all duration-200
                                        placeholder-[#E6D1B4]/30"
                                        placeholder="••••••••">
                                </div>
                                @error('password')
                                    <p class="text-sm text-[#EFA00F]">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input type="checkbox" id="remember_me" name="remember"
                                        class="rounded border-[#2E9CA0]/30 bg-[#21616A]/20 text-[#EFA00F]
                                        focus:ring-[#EFA00F] focus:ring-offset-0">
                                    <label for="remember_me" class="ml-2 text-sm text-[#E6D1B4]/70">Remember me</label>
                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-sm text-[#2E9CA0] hover:text-[#EFA00F] transition-colors duration-200">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full px-4 py-3 bg-gradient-to-r from-[#2E9CA0] to-[#21616A] hover:from-[#EFA00F] hover:to-[#2E9CA0]
                                rounded-xl text-[#E6D1B4] font-semibold transition-all duration-500 hover:scale-[1.02]">
                                Sign In
                            </button>

                            <!-- Register Link -->
                            <div class="text-center mt-6">
                                <span class="text-[#E6D1B4]/70">New to TaskMaster?</span>
                                <a href="{{ route('register') }}"
                                    class="ml-1 text-[#2E9CA0] hover:text-[#EFA00F] transition-colors duration-200">
                                    Create account
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

</body>

</html>
