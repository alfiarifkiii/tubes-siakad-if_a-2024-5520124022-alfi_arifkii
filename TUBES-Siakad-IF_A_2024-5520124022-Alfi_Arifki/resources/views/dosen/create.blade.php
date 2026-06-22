@extends('layouts.main')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-amalfi-tile">Tambah Data Dosen</h2>
        <p class="text-gray-600">Masukkan NIDN dan Nama Dosen baru.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-amalfi-tile p-6 max-w-2xl">
        <form action="{{ route('dosen.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nidn" class="block text-gray-700 font-medium mb-2">NIDN (10 Digit)</label>
                <input type="text" name="nidn" id="nidn" value="{{ old('nidn') }}" 
                       class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile focus:border-amalfi-tile @error('nidn') border-red-500 ring-1 ring-red-500 @enderror" 
                       placeholder="Contoh: 0123456789">
                
                @error('nidn')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Dosen (beserta gelar)</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" 
                       class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile focus:border-amalfi-tile @error('nama') border-red-500 ring-1 ring-red-500 @enderror" 
                       placeholder="Contoh: Dr. Budi Santoso, M.Kom">
                
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('dosen.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-5 py-2 bg-amalfi-tile text-white rounded-lg hover:opacity-90 transition shadow-md">Simpan Data</button>
            </div>
        </form>
    </div>
@endsection