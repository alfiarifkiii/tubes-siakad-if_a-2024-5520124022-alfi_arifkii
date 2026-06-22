@extends('layouts.main')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-amalfi-tile">Tambah Mata Kuliah</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-amalfi-tile p-6 max-w-2xl">
        <form action="{{ route('matakuliah.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Kode Mata Kuliah (Maks 8 Karakter)</label>
                <input type="text" name="kode_matakuliah" value="{{ old('kode_matakuliah') }}" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile focus:border-amalfi-tile @error('kode_matakuliah') border-red-500 @enderror" placeholder="Contoh: IF53413">
                @error('kode_matakuliah') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nama Mata Kuliah</label>
                <input type="text" name="nama_matakuliah" value="{{ old('nama_matakuliah') }}" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile focus:border-amalfi-tile @error('nama_matakuliah') border-red-500 @enderror" placeholder="Contoh: Pemrograman Web II">
                @error('nama_matakuliah') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Jumlah SKS</label>
                <input type="number" name="sks" value="{{ old('sks') }}" min="1" max="6" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile focus:border-amalfi-tile @error('sks') border-red-500 @enderror">
                @error('sks') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('matakuliah.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-5 py-2 bg-amalfi-tile text-white rounded-lg hover:opacity-90 transition shadow-md">Simpan Data</button>
            </div>
        </form>
    </div>
@endsection