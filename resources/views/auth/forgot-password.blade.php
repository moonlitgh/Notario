<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Notario</title>
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

    <!-- Forgot Password Form Section -->
    <div class="flex-grow flex items-center justify-center py-10">
        <div class="bg-[#0a2c37] p-8 rounded-3xl shadow-2xl border border-gray-700/30 backdrop-blur-sm w-full max-w-md relative overflow-hidden">
            <div class="absolute -z-10 w-72 h-72 bg-accent/10 rounded-full blur-3xl top-20 -right-20"></div>
            <div class="absolute -z-10 w-72 h-72 bg-secondary/10 rounded-full blur-3xl -bottom-20 -left-20"></div>
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold mb-2">Forgot Password</h2>
                <p class="text-gray-300">Enter your email to receive a password reset link</p>
            </div>
            
            @if (session('status'))
                <div class="bg-accent/20 text-accent p-4 rounded-lg mb-6">
                    {{ session('status') }}
                </div>
            @endif
            
            <!-- Form Forgot Password -->
            <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
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
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 bg-gray-100 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-accent" required autofocus>
                </div>
                
                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-accent rounded-lg text-white font-medium hover:bg-accent/80 transition-all shadow-lg shadow-accent/20">
                        Send Password Reset Link
                    </button>
                </div>
                
                <div class="text-center text-sm text-gray-400">
                    <a href="{{ route('login') }}" class="text-accent hover:underline">Back to login</a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="border-t border-gray-700/50 py-4">
        <div class="container mx-auto px-4">
            <div class="flex justify-center space-x-4 text-xs text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span>|</span>
                <a href="{{ route('login') }}" class="hover:text-white">Login</a>
                <span>|</span>
                <a href="{{ route('register') }}" class="hover:text-white">Register</a>
            </div>
        </div>
    </footer>
</body>
</html>
