@extends('layouts.main')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-amalfi-tile">Tambah Jadwal Baru</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-amalfi-tile p-6 max-w-2xl">
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Mata Kuliah</label>
                <select name="kode_matakuliah" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile @error('kode_matakuliah') border-red-500 @enderror">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)</option>
                    @endforeach
                </select>
                @error('kode_matakuliah') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Dosen Pengajar</label>
                <select name="nidn" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile @error('nidn') border-red-500 @enderror">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->nidn }}" {{ old('nidn') == $dosen->nidn ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                    @endforeach
                </select>
                @error('nidn') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: A" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile @error('kelas') border-red-500 @enderror">
                    @error('kelas') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Hari</label>
                    <select name="hari" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile @error('hari') border-red-500 @enderror">
                        <option value="">-- Pilih --</option>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                            <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                        @endforeach
                    </select>
                    @error('hari') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Jam</label>
                    <input type="time" name="jam" value="{{ old('jam') }}" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile @error('jam') border-red-500 @enderror">
                    @error('jam') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('jadwal.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-5 py-2 bg-amalfi-tile text-white rounded-lg hover:opacity-90 transition shadow-md">Simpan Jadwal</button>
            </div>
        </form>
    </div>
@endsection