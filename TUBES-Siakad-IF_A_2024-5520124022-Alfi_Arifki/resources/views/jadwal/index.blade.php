@extends('layouts.main')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-amalfi-tile">Kelola Jadwal Perkuliahan</h2>
            <p class="text-gray-600">Atur jadwal, dosen pengajar, dan kelas.</p>
        </div>
        <a href="{{ route('jadwal.create') }}" class="bg-amalfi-tile hover:bg-sea-breeze hover:text-amalfi-tile text-white px-4 py-2 rounded-lg font-medium transition shadow-sm">
            + Tambah Jadwal
        </a>
    </div>

    @if(session('success'))
        <div class="bg-cream-gelato border-l-4 border-citrus-zest text-amalfi-tile p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-amalfi-tile overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                    <th class="p-4 font-semibold text-gray-700">MATA KULIAH</th>
                    <th class="p-4 font-semibold text-gray-700">DOSEN PENGAJAR</th>
                    <th class="p-4 font-semibold text-gray-700 text-center">KELAS</th>
                    <th class="p-4 font-semibold text-gray-700">WAKTU</th>
                    <th class="p-4 font-semibold text-gray-700 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $jadwal)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                    <td class="p-4 text-gray-700 font-medium">
                        {{ $jadwal->matakuliah->nama_matakuliah }}<br>
                        <span class="text-xs text-gray-500">{{ $jadwal->kode_matakuliah }} | {{ $jadwal->matakuliah->sks }} SKS</span>
                    </td>
                    <td class="p-4 text-gray-700">{{ $jadwal->dosen->nama ?? '-' }}</td>
                    <td class="p-4 text-center font-bold text-amalfi-tile">{{ $jadwal->kelas }}</td>
                    <td class="p-4 text-gray-700">
                        <span class="bg-sea-breeze/30 px-2 py-1 rounded text-amalfi-tile text-sm">{{ $jadwal->hari }}</span>
                        <span class="ml-1">{{ date('H:i', strtotime($jadwal->jam)) }}</span>
                    </td>
                    <td class="p-4 flex justify-center space-x-2">
                        <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="px-3 py-1 bg-sea-breeze/30 text-amalfi-tile rounded hover:bg-sea-breeze transition text-sm">Edit</a>
                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition text-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">Belum ada jadwal yang diatur.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection