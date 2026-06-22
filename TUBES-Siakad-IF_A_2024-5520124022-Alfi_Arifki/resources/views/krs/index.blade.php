@extends('layouts.main')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-amalfi-tile">Kartu Rencana Studi (KRS)</h2>
        <p class="text-gray-600">Pilih mata kuliah yang akan Anda ambil pada semester ini.</p>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="bg-cream-gelato border-l-4 border-citrus-zest text-amalfi-tile p-4 mb-6 rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Kolom Kiri: Form Ambil Mata Kuliah -->
        <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border-t-4 border-amalfi-tile p-6 h-fit">
            <h3 class="font-bold text-gray-800 mb-4 text-lg">Ambil Mata Kuliah</h3>
            <form action="{{ route('krs.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Pilih Mata Kuliah</label>
                    <select name="kode_matakuliah" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile @error('kode_matakuliah') border-red-500 @enderror" required>
                        <option value="">-- Silakan Pilih --</option>
                        @foreach($matakuliahs as $mk)
                            <option value="{{ $mk->kode_matakuliah }}">{{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</option>
                        @endforeach
                    </select>
                    @error('kode_matakuliah') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit" class="w-full py-2 bg-amalfi-tile text-white rounded-lg hover:opacity-90 transition font-medium shadow-md">Tambah ke KRS</button>
            </form>
        </div>

        <!-- Kolom Kanan: Tabel KRS Saya -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border-t-4 border-sea-breeze p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-800 text-lg">Daftar Mata Kuliah Diambil</h3>
                
                <!-- Tombol Export PDF -->
                @if($krs->count() > 0)
                <a href="{{ route('krs.pdf') }}" class="bg-citrus-zest text-white px-4 py-2 rounded text-sm font-medium hover:opacity-90 transition shadow-sm flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export PDF
                </a>
                @endif
            </div>

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-sm">
                        <th class="p-3 font-semibold text-gray-700">NO</th>
                        <th class="p-3 font-semibold text-gray-700">KODE</th>
                        <th class="p-3 font-semibold text-gray-700">MATA KULIAH</th>
                        <th class="p-3 font-semibold text-gray-700 text-center">SKS</th>
                        <th class="p-3 font-semibold text-gray-700 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($krs as $index => $item)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="p-3 text-gray-600">{{ $index + 1 }}</td>
                        <td class="p-3 font-medium text-amalfi-tile">{{ $item->kode_matakuliah }}</td>
                        <td class="p-3 text-gray-700">{{ $item->matakuliah->nama_matakuliah }}</td>
                        <td class="p-3 text-gray-700 text-center font-semibold">{{ $item->matakuliah->sks }}</td>
                        <td class="p-3 flex justify-center">
                            <!-- Tombol Drop KRS -->
                            <form action="{{ route('krs.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin men-drop (menghapus) mata kuliah ini dari KRS Anda?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 transition text-sm">Drop</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-500">KRS Anda masih kosong. Silakan ambil mata kuliah di samping.</td>
                    </tr>
                    @endforelse
                </tbody>
                <!-- Footer Tabel untuk Total SKS -->
                @if($krs->count() > 0)
                <tfoot>
                    <tr class="bg-gray-50 border-t-2 border-gray-200">
                        <td colspan="3" class="p-3 text-right font-bold text-gray-700">TOTAL SKS :</td>
                        <td class="p-3 text-center font-bold text-amalfi-tile text-lg">{{ $totalSks }}</td>
                        <td></td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
@endsection