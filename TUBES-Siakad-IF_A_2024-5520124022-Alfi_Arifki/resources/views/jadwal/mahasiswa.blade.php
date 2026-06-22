@extends('layouts.main')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-amalfi-tile">Jadwal Perkuliahan Tersedia</h2>
        <p class="text-gray-600">Daftar jadwal mata kuliah yang dapat Anda pilih saat mengisi KRS.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-sea-breeze overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                    <th class="p-4 font-semibold text-gray-700">MATA KULIAH</th>
                    <th class="p-4 font-semibold text-gray-700">DOSEN PENGAJAR</th>
                    <th class="p-4 font-semibold text-gray-700 text-center">KELAS</th>
                    <th class="p-4 font-semibold text-gray-700">WAKTU</th>
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
                        <span class="bg-cream-gelato px-2 py-1 rounded text-citrus-zest text-sm font-semibold">{{ $jadwal->hari }}</span>
                        <span class="ml-1 font-medium">{{ date('H:i', strtotime($jadwal->jam)) }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-500">Belum ada jadwal yang tersedia saat ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection