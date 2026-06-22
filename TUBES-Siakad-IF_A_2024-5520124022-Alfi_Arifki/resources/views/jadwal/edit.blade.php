@extends('layouts.main')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-amalfi-tile">Edit Jadwal</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm border-t-4 border-citrus-zest p-6 max-w-2xl">
        <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Mata Kuliah</label>
                <select name="kode_matakuliah" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile">
                    @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->kode_matakuliah }}" {{ old('kode_matakuliah', $jadwal->kode_matakuliah) == $mk->kode_matakuliah ? 'selected' : '' }}>{{ $mk->nama_matakuliah }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Dosen Pengajar</label>
                <select name="nidn" class="w-full border-gray-300 rounded-lg focus:ring-amalfi-tile">
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->nidn }}" {{ old('nidn', $jadwal->nidn) == $dosen->nidn ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-3 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas', $jadwal->kelas) }}" class="w-full border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Hari</label>
                    <select name="hari" class="w-full border-gray-300 rounded-lg">
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                            <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Jam</label>
                    <input type="time" name="jam" value="{{ old('jam', $jadwal->jam) }}" class="w-full border-gray-300 rounded-lg">
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('jadwal.index') }}" class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
                <button type="submit" class="px-5 py-2 bg-citrus-zest text-white rounded-lg hover:opacity-90 transition">Update Jadwal</button>
            </div>
        </form>
    </div>
@endsection