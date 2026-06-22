<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIAKAD Sederhana</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden font-sans">

    <aside class="w-64 bg-amalfi-tile text-white flex flex-col hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-sea-breeze/30">
            <h1 class="text-2xl font-bold tracking-wider text-cream-gelato">SIAKAD</h1>
        </div>
        
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-sea-breeze text-amalfi-tile font-bold' : 'hover:bg-sea-breeze/50 transition' }}">Dashboard</a>
            
            @if(Auth::user()->role === 'admin')
                <div class="pt-4 pb-2 text-xs uppercase text-cream-gelato font-bold">Data Master</div>
                <a href="{{ route('dosen.index') }}" class="block px-4 py-2 rounded-lg hover:bg-sea-breeze/50 transition">Data Dosen</a>
                <a href="{{ route('mahasiswa.index') }}" class="block px-4 py-2 rounded-lg hover:bg-sea-breeze/50 transition">Data Mahasiswa</a>
                <a href="{{ route('matakuliah.index') }}" class="block px-4 py-2 rounded-lg hover:bg-sea-breeze/50 transition">Data Matakuliah</a>
                <a href="{{ route('jadwal.index') }}" class="block px-4 py-2 rounded-lg hover:bg-sea-breeze/50 transition">Kelola Jadwal</a>
            @endif

            @if(Auth::user()->role === 'mahasiswa')
                <div class="pt-4 pb-2 text-xs uppercase text-cream-gelato font-bold">Akademik</div>
                <a href="{{ route('jadwal.mahasiswa') }}" class="block px-4 py-2 rounded-lg hover:bg-sea-breeze/50 transition">Jadwal Kuliah</a>
                <a href="{{ route('krs.index') }}" class="block px-4 py-2 rounded-lg hover:bg-sea-breeze/50 transition">Kartu Rencana Studi (KRS)</a>
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