<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Notario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0d3b49',
                        secondary: '#ff9f1c',
                        accent: '#17b897'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    animation: {
                        'bounce-slow': 'bounce 3s infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-primary hero-pattern text-white font-poppins min-h-screen flex flex-col">
    <!-- Navigation Bar -->
    <nav class="flex justify-between items-center p-5 border-b border-gray-700/50 backdrop-blur-sm bg-primary/70 sticky top-0 z-50">
        <div class="text-2xl font-bold flex items-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/notario-logo.png') }}" alt="Notario" class="h-8 mr-2">
            </a>
        </div>
        <div class="space-x-3">
            <a href="{{ route('login') }}" class="px-4 py-2 text-white hover:text-accent transition-colors">Log In</a>
            <a href="{{ route('register') }}" class="px-5 py-2 bg-accent rounded-full text-white hover:bg-accent/80 transition-all shadow-lg shadow-accent/20">Sign In</a>
        </div>
    </nav>

    <!-- Login Form Section -->
    <div class="flex-grow flex items-center justify-center py-10">
        <div class="bg-[#0a2c37] p-8 rounded-3xl shadow-2xl border border-gray-700/30 backdrop-blur-sm w-full max-w-md relative overflow-hidden">
            <div class="absolute -z-10 w-72 h-72 bg-accent/10 rounded-full blur-3xl top-20 -right-20"></div>
            <div class="absolute -z-10 w-72 h-72 bg-secondary/10 rounded-full blur-3xl -bottom-20 -left-20"></div>
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold mb-2">Welcome Back</h2>
                <p class="text-gray-300">Continue your productivity journey</p>
            </div>
            
            <!-- Form Login -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-500/20 text-red-500 p-3 rounded-lg mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="space-y-2">
                    <label for="email" class="block text-gray-300">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 bg-gray-100 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-accent" required>
                </div>
                
                <div class="space-y-2">
                    <label for="password" class="block text-gray-300">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-3 bg-gray-100 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-accent" required>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-accent focus:ring-accent border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-300">Remember me</label>
                    </div>
                    <!-- Add this somewhere in your login form, typically below the password field -->
                    <div class="text-right">
                        <a href="{{ route('password.request') }}" class="text-sm text-accent hover:underline">
                            Forgot your password?
                        </a>
                    </div>
                </div>
                
                <button type="submit" class="w-full py-3 bg-accent text-white rounded-lg hover:bg-accent/80 transition-all shadow-lg shadow-accent/20 font-medium">
                    Sign In
                </button>
            </form>
            
            <!-- Social Login Options -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-600"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-[#0a2c37] text-gray-400">Or continue with</span>
                    </div>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('auth.google') }}" class="w-full flex items-center justify-center gap-3 py-3 border border-gray-600 rounded-lg hover:bg-white/5 transition-all text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="24px" height="24px">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                        </svg>
                        Sign in with Google
                    </a>
                </div>
            </div>
            
            <div class="text-center text-sm text-gray-300 mt-4">
                <span>New To Notario?</span>
                <a href="{{ route('register') }}" class="text-accent hover:underline ml-1">create account</a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="border-t border-gray-700/50 py-6">
        <div class="container mx-auto px-4">
            <div class="text-center text-gray-400 text-sm">
                &copy; 2023 Notario. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>