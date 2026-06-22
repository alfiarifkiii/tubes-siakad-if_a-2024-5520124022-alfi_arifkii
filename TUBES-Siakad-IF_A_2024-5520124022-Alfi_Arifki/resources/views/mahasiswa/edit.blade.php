@extends('layouts.main')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-amalfi-tile">Edit Data Mahasiswa</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-citrus-zest p-6 max-w-2xl">
        <form action="{{ route('mahasiswa.update', $mahasiswa->npm) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">NPM</label>
                <input type="text" value="{{ $mahasiswa->npm }}" disabled class="w-full border-gray-200 bg-gray-100 text-gray-500 rounded-lg cursor-not-allowed">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nama Mahasiswa</label>
                <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile focus:border-amalfi-tile @error('nama') border-red-500 @enderror">
                @error('nama') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Pilih Dosen Wali</label>
                <select name="nidn" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile focus:border-amalfi-tile @error('nidn') border-red-500 @enderror">
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->nidn }}" {{ old('nidn', $mahasiswa->nidn) == $dosen->nidn ? 'selected' : '' }}>
                            {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
                @error('nidn') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('mahasiswa.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-5 py-2 bg-citrus-zest text-white rounded-lg hover:opacity-90 transition shadow-md">Update Data</button>
            </div>
        </form>
    </div>
@endsection