@extends('layouts.main')

@section('content')
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-amalfi-tile">Data Master Dosen</h2>
            <p class="text-gray-600">Kelola data dosen pengajar di sini.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 w-full md:w-auto">
            <form action="{{ route('dosen.index') }}" method="GET" class="flex w-full sm:w-auto shadow-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIDN / Nama..." class="border-gray-300 rounded-l-lg focus:ring-amalfi-tile focus:border-amalfi-tile px-4 py-2 w-full sm:w-56 text-sm">
                <button type="submit" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-r-lg hover:bg-gray-300 transition text-sm font-medium border border-gray-300 border-l-0">Cari</button>
            </form>

            <a href="{{ route('dosen.create') }}" class="bg-amalfi-tile hover:bg-sea-breeze hover:text-amalfi-tile text-white px-4 py-2 rounded-lg font-medium transition shadow-sm text-sm whitespace-nowrap flex items-center justify-center">
                + Tambah Dosen
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-cream-gelato border-l-4 border-citrus-zest text-amalfi-tile p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-amalfi-tile overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="p-4 font-semibold text-gray-700">NO</th>
                    <th class="p-4 font-semibold text-gray-700">NIDN</th>
                    <th class="p-4 font-semibold text-gray-700">NAMA DOSEN</th>
                    <th class="p-4 font-semibold text-gray-700 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosens as $index => $dosen)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="p-4 text-gray-600">{{ $index + 1 }}</td>
                    <td class="p-4 font-medium text-amalfi-tile">{{ $dosen->nidn }}</td>
                    <td class="p-4 text-gray-700">{{ $dosen->nama }}</td>
                    <td class="p-4 flex justify-center space-x-2">
                        <a href="{{ route('dosen.edit', $dosen->nidn) }}" class="px-3 py-1 bg-sea-breeze/30 text-amalfi-tile rounded hover:bg-sea-breeze transition text-sm">
                            Edit
                        </a>
                        
                        <form action="{{ route('dosen.destroy', $dosen->nidn) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dosen ini? Data jadwal dan mahasiswa wali yang terkait akan ikut terhapus!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition text-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">Belum ada data dosen.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection