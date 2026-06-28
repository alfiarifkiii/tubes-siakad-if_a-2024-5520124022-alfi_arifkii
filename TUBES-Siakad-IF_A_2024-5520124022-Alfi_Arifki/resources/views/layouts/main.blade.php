<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD Sederhana</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden font-sans">

    <aside class="w-72 bg-gradient-to-b from-amalfi-tile to-blue-900 text-white flex flex-col hidden md:flex shadow-xl z-20">
        
        <div class="h-20 flex items-center justify-center border-b border-sea-breeze/20 px-6">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm border border-white/20 shadow-sm">
                    <svg class="w-7 h-7 text-cream-gelato" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                </div>
                <h1 class="text-3xl font-extrabold tracking-wider text-cream-gelato drop-shadow-md">SIAKAD</h1>
            </div>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-cream-gelato text-amalfi-tile font-bold shadow-md' : 'text-gray-100 hover:bg-sea-breeze/20 hover:text-white hover:translate-x-1' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            @if(Auth::user()->role === 'admin')
                <div class="pt-6 pb-2 px-4 text-xs uppercase text-sea-breeze font-bold tracking-widest opacity-80">Data Master</div>
                
                <a href="{{ route('dosen.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('dosen.*') ? 'bg-cream-gelato text-amalfi-tile font-bold shadow-md' : 'text-gray-100 hover:bg-sea-breeze/20 hover:text-white hover:translate-x-1' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Data Dosen
                </a>

                <a href="{{ route('mahasiswa.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('mahasiswa.*') ? 'bg-cream-gelato text-amalfi-tile font-bold shadow-md' : 'text-gray-100 hover:bg-sea-breeze/20 hover:text-white hover:translate-x-1' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Data Mahasiswa
                </a>

                <a href="{{ route('matakuliah.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('matakuliah.*') ? 'bg-cream-gelato text-amalfi-tile font-bold shadow-md' : 'text-gray-100 hover:bg-sea-breeze/20 hover:text-white hover:translate-x-1' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Data Matakuliah
                </a>

                <a href="{{ route('jadwal.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('jadwal.*') ? 'bg-cream-gelato text-amalfi-tile font-bold shadow-md' : 'text-gray-100 hover:bg-sea-breeze/20 hover:text-white hover:translate-x-1' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Kelola Jadwal
                </a>
            @endif

            @if(Auth::user()->role === 'mahasiswa')
                <div class="pt-6 pb-2 px-4 text-xs uppercase text-sea-breeze font-bold tracking-widest opacity-80">Akademik</div>
                
                <a href="{{ route('jadwal.mahasiswa') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('jadwal.*') ? 'bg-cream-gelato text-amalfi-tile font-bold shadow-md' : 'text-gray-100 hover:bg-sea-breeze/20 hover:text-white hover:translate-x-1' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Jadwal Kuliah
                </a>
                
                <a href="{{ route('krs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('krs.*') ? 'bg-cream-gelato text-amalfi-tile font-bold shadow-md' : 'text-gray-100 hover:bg-sea-breeze/20 hover:text-white hover:translate-x-1' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Kartu Rencana Studi
                </a>
            @endif
        </nav>
    </aside>
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10">
            <div class="font-semibold text-gray-700">
                Halo, {{ Auth::user()->name }} 
                <span class="ml-2 px-2 py-1 text-xs rounded-full bg-cream-gelato text-amalfi-tile border border-citrus-zest">{{ strtoupper(Auth::user()->role) }}</span>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-citrus-zest hover:opacity-80 text-white px-4 py-2 rounded-lg font-medium transition text-sm shadow-sm">
                    Logout
                </button>
            </form>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>