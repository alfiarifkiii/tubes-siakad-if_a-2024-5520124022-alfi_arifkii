<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SIAKAD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex lg:w-1/2 bg-amalfi-tile flex-col justify-center items-center relative overflow-hidden">
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-sea-breeze rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-citrus-zest rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>

            <div class="relative z-10 text-center px-10">
                <div class="mb-6 inline-block p-4 bg-white/10 rounded-full backdrop-blur-sm border border-white/20">
                    <svg class="w-16 h-16 text-cream-gelato" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl font-extrabold text-white mb-4 tracking-tight">SIAKAD</h1>
                <p class="text-xl text-cream-gelato font-medium">Sistem Informasi Akademik Terpadu</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gray-50">
            <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 relative">
                
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-sea-breeze via-amalfi-tile to-citrus-zest rounded-t-3xl"></div>

                <div class="mb-8 text-center lg:text-left">
                    <h2 class="text-3xl font-extrabold text-amalfi-tile mb-2">Selamat Datang! 👋</h2>
                    <p class="text-gray-500">Silakan masuk menggunakan akun Anda.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Email Akun</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                                   class="block w-full pl-11 pr-4 py-3 border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-sea-breeze focus:border-amalfi-tile transition-all duration-200 bg-gray-50 focus:bg-white" 
                                   placeholder="contoh@siakad.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password" 
                                   class="block w-full pl-11 pr-4 py-3 border-gray-200 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-sea-breeze focus:border-amalfi-tile transition-all duration-200 bg-gray-50 focus:bg-white" 
                                   placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-amalfi-tile focus:ring-amalfi-tile w-4 h-4 transition duration-150 ease-in-out">
                            <span class="ml-2 text-sm text-gray-600 font-medium">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-amalfi-tile hover:text-citrus-zest font-bold transition-colors duration-200">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-amalfi-tile hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amalfi-tile transition-all duration-200 transform hover:-translate-y-0.5">
                            Masuk ke Sistem
                        </button>
                    </div>
                </form>
                
                <div class="mt-8 text-center text-sm text-gray-500">
                    Mengalami kendala login? <br>
                    <span class="text-amalfi-tile font-bold">Hubungi Bagian Akademik (Admin)</span>
                </div>
            </div>
        </div>

    </div>
</body>
</html>