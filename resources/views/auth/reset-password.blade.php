<x-app-layout>
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <!-- Background Gradients -->
        <div class="fixed inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-20 left-1/4 w-[500px] h-[500px] bg-[#21616A] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob"></div>
            <div class="absolute top-1/3 -right-20 w-[600px] h-[600px] bg-[#2E9CA0] rounded-full mix-blend-multiply filter blur-2xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-20 left-1/3 w-[550px] h-[550px] bg-[#EFA00F] rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <!-- Reset Password Container -->
        <div class="max-w-md w-full">
            <!-- Card -->
            <div class="relative">
                <!-- Card Glow Effect -->
                <div class="absolute -inset-1 bg-gradient-to-r from-[#2E9CA0] to-[#EFA00F] rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-1000"></div>
                
                <!-- Card Content -->
                <div class="relative bg-[#0F2C33]/80 backdrop-blur-xl p-8 rounded-2xl border border-[#2E9CA0]/30 shadow-2xl">
                    <!-- Header -->
                    <div class="mb-8 text-center">
                        <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#2E9CA0] to-[#EFA00F] mb-3">Set New Password</h2>
                        <p class="text-[#E6D1B4]/70 text-sm">
                            Create a strong password for your account
                        </p>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-[#E6D1B4]">Email</label>
                            <div class="relative">
                                <input type="email" id="email" name="email" 
                                    value="{{ old('email', $request->email) }}" required autofocus
                                    class="w-full bg-[#21616A]/20 border border-[#2E9CA0]/30 rounded-xl px-4 py-3 text-[#E6D1B4] 
                                    focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F] transition-all duration-200
                                    placeholder-[#E6D1B4]/30">
                            </div>
                            @error('email')
                                <p class="text-sm text-[#EFA00F]">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium text-[#E6D1B4]">New Password</label>
                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                    class="w-full bg-[#21616A]/20 border border-[#2E9CA0]/30 rounded-xl px-4 py-3 text-[#E6D1B4] 
                                    focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F] transition-all duration-200
                                    placeholder-[#E6D1B4]/30"
                                    placeholder="Enter your new password">
                            </div>
                            @error('password')
                                <p class="text-sm text-[#EFA00F]">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-medium text-[#E6D1B4]">
                                Confirm New Password
                            </label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    class="w-full bg-[#21616A]/20 border border-[#2E9CA0]/30 rounded-xl px-4 py-3 text-[#E6D1B4] 
                                    focus:border-[#EFA00F] focus:ring-1 focus:ring-[#EFA00F] transition-all duration-200
                                    placeholder-[#E6D1B4]/30"
                                    placeholder="Confirm your new password">
                            </div>
                        </div>

                        <!-- Password Requirements -->
                        <div class="text-sm text-[#E6D1B4]/60 space-y-1">
                            <p>Password must contain:</p>
                            <ul class="list-disc list-inside pl-2 space-y-1">
                                <li>At least 8 characters</li>
                                <li>At least one uppercase letter</li>
                                <li>At least one number</li>
                                <li>At least one special character</li>
                            </ul>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full px-4 py-3 bg-gradient-to-r from-[#2E9CA0] to-[#21616A] hover:from-[#EFA00F] hover:to-[#2E9CA0] 
                            rounded-xl text-[#E6D1B4] font-semibold transition-all duration-500 hover:scale-[1.02]">
                            Reset Password
                        </button>

                        <!-- Back to Login -->
                        <div class="text-center mt-6">
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center text-[#2E9CA0] hover:text-[#EFA00F] transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
