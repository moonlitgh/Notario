<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notario - Task Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Remove the font comment and link -->
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
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2V6h4V4h-6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-primary hero-pattern text-white font-poppins">
    <!-- Navigation Bar with updated font for Notario -->
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

    <!-- Hero Section -->
    <div class="container mx-auto px-4 py-20">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                <div class="inline-block px-3 py-1 bg-accent/20 text-accent rounded-full mb-4">
                    <span class="text-sm font-medium">Task Management Reimagined</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-4 leading-tight">
                    Manage Tasks
                </h1>
                <div class="text-3xl md:text-4xl font-bold mb-6">
                    <span class="text-accent">Smarter</span> & 
                    <span class="text-secondary">Faster</span>
                </div>
                <p class="text-gray-300 mb-8 text-lg leading-relaxed">
                    Tingkatkan produktivitas Anda dengan platform manajemen tugas yang intuitif. Dirancang untuk individu dan tim yang ingin mencapai lebih banyak hal dengan lebih efisien.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#" class="px-8 py-4 bg-accent rounded-full text-white hover:bg-accent/80 transition-all shadow-lg shadow-accent/20 text-center flex items-center justify-center">
                        <i class="fas fa-rocket mr-2"></i> Get Started Free
                    </a>
                    <a href="#" class="px-8 py-4 border-2 border-secondary text-secondary rounded-full hover:bg-secondary hover:text-white transition-all text-center flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="grid grid-cols-1 gap-6 relative">
                    <div class="absolute -z-10 w-72 h-72 bg-accent/20 rounded-full blur-3xl top-20 -right-10"></div>
                    <div class="absolute -z-10 w-72 h-72 bg-secondary/20 rounded-full blur-3xl -top-10 -left-10"></div>
                    
                    <div class="flex space-x-4 items-center transform hover:scale-105 transition-transform">
                        <div class="bg-accent text-white text-3xl font-bold rounded-2xl p-6 w-28 h-28 flex items-center justify-center shadow-lg shadow-accent/30">
                            15k+
                        </div>
                        <div class="bg-primary/40 backdrop-blur-sm p-4 rounded-xl border border-accent/20">
                            <p class="text-lg font-semibold">Active Users</p>
                            <p class="text-sm text-gray-300">Growing community</p>
                        </div>
                    </div>
                    
                    <div class="flex space-x-4 items-center transform hover:scale-105 transition-transform">
                        <div class="bg-secondary text-white text-3xl font-bold rounded-2xl p-6 w-28 h-28 flex items-center justify-center shadow-lg shadow-secondary/30">
                            250k+
                        </div>
                        <div class="bg-primary/40 backdrop-blur-sm p-4 rounded-xl border border-secondary/20">
                            <p class="text-lg font-semibold">Tasks Done</p>
                            <p class="text-sm text-gray-300">Productivity achieved</p>
                        </div>
                    </div>
                    
                    <div class="flex space-x-4 items-center transform hover:scale-105 transition-transform">
                        <div class="bg-[#1e5a6e] text-white text-3xl font-bold rounded-2xl p-6 w-28 h-28 flex items-center justify-center shadow-lg shadow-[#1e5a6e]/30">
                            4.9/5
                        </div>
                        <div class="bg-primary/40 backdrop-blur-sm p-4 rounded-xl border border-[#1e5a6e]/20">
                            <p class="text-lg font-semibold">User Rating</p>
                            <p class="text-sm text-gray-300">Highly recommended</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mx-auto px-4 py-20">
        <div class="text-center mb-16">
            <div class="inline-block px-3 py-1 bg-accent/20 text-accent rounded-full mb-4">
                <span class="text-sm font-medium">Why Choose Us</span>
            </div>
            <h2 class="text-4xl font-bold mb-4">Kenapa Harus Notario?</h2>
            <p class="text-gray-300 max-w-2xl mx-auto">Platform manajemen tugas terbaik untuk meningkatkan produktivitas dan efisiensi kerja Anda</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[#0a2c37] p-8 rounded-2xl shadow-xl card-hover transition-all duration-300 border border-accent/20 backdrop-blur-sm">
                <div class="bg-accent w-16 h-16 rounded-2xl mb-6 flex items-center justify-center shadow-lg shadow-accent/30">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-3">Mudah Digunakan</h3>
                <p class="text-gray-300 leading-relaxed">Antarmuka yang simpel dan intuitif membuat pencatatan tugas/aktivitas cepat dan efisien tanpa kebingungan.</p>
            </div>
            
            <div class="bg-[#0a2c37] p-8 rounded-2xl shadow-xl card-hover transition-all duration-300 border border-secondary/20 backdrop-blur-sm">
                <div class="bg-secondary w-16 h-16 rounded-2xl mb-6 flex items-center justify-center shadow-lg shadow-secondary/30">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-3">Hemat Waktu</h3>
                <p class="text-gray-300 leading-relaxed">Fitur otomatisasi dan pengingat membantu Anda tetap tepat waktu dan fokus pada hal yang penting.</p>
            </div>
            
            <div class="bg-[#0a2c37] p-8 rounded-2xl shadow-xl card-hover transition-all duration-300 border border-[#1e5a6e]/20 backdrop-blur-sm">
                <div class="bg-[#1e5a6e] w-16 h-16 rounded-2xl mb-6 flex items-center justify-center shadow-lg shadow-[#1e5a6e]/30">
                    <i class="fas fa-bolt text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold mb-3">Performa Tinggi</h3>
                <p class="text-gray-300 leading-relaxed">Aplikasi yang cepat dan responsif untuk memastikan pengalaman pengguna yang optimal setiap saat.</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="container mx-auto px-4 py-20">
        <div class="bg-[#0a2c37] p-12 rounded-3xl text-center shadow-2xl border border-gray-700/30 backdrop-blur-sm relative overflow-hidden">
            <div class="absolute -z-10 w-96 h-96 bg-accent/10 rounded-full blur-3xl top-20 -right-20"></div>
            <div class="absolute -z-10 w-96 h-96 bg-secondary/10 rounded-full blur-3xl -bottom-20 -left-20"></div>
            
            <div class="inline-block px-3 py-1 bg-accent/20 text-accent rounded-full mb-4">
                <span class="text-sm font-medium">Get Started Today</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Meningkatkan Produktivitas Anda?</h2>
            <p class="text-gray-300 mb-10 max-w-2xl mx-auto text-lg">Bergabunglah dengan ribuan pengguna yang telah mengoptimalkan hari kerja mereka dan mencapai lebih banyak hal dengan Notario.</p>
            <a href="#" class="px-10 py-4 bg-secondary text-white rounded-full hover:shadow-lg hover:shadow-secondary/30 transition-all inline-block text-lg font-medium">
                <i class="fas fa-paper-plane mr-2"></i> Mulai Sekarang
            </a>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="border-t border-gray-700/50 py-10">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center">
                        <img src="{{ asset('images/notario-logo.png') }}" alt="Notario" class="h-8">
                    </div>
                    <p class="text-gray-400 mt-2">Manage tasks smarter & faster</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-accent transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-accent transition-colors">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-accent transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-accent transition-colors">
                        <i class="fab fa-github text-xl"></i>
                    </a>
                </div>
            </div>
            <div class="mt-8 text-center text-gray-400 text-sm">
                &copy; 2023 Notario. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>