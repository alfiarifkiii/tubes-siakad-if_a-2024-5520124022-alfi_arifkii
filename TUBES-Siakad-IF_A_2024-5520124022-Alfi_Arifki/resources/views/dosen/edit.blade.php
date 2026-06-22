@extends('layouts.main')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-amalfi-tile">Edit Data Dosen</h2>
        <p class="text-gray-600">Ubah informasi nama dosen.</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-citrus-zest p-6 max-w-2xl">
        <form action="{{ route('dosen.update', $dosen->nidn) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">NIDN</label>
                <input type="text" value="{{ $dosen->nidn }}" disabled 
                       class="w-full border-gray-200 bg-gray-100 text-gray-500 rounded-lg cursor-not-allowed">
                <p class="text-xs text-gray-400 mt-1">*NIDN tidak dapat diubah karena merupakan data pengenal utama (Primary Key).</p>
            </div>

            <div class="mb-6">
                <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Dosen (beserta gelar)</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $dosen->nama) }}" 
                       class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile focus:border-amalfi-tile @error('nama') border-red-500 ring-1 ring-red-500 @enderror">
                
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('dosen.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-5 py-2 bg-citrus-zest text-white rounded-lg hover:opacity-90 transition shadow-md">Update Data</button>
            </div>
        </form>
    </div>
@endsection