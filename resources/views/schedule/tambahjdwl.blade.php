@extends('layouts.app')

@section('content')
<div class="max-w-lg w-100 p-6 bg-white shadow-md rounded-lg border border-gray-300">
    <h2 class="text-2xl font-bold text-white-600 mb-4 text-center">Tambah Jadwal</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jadwal.store') }}" method="POST">
        @csrf

        {{-- Nama Jadwal --}}
        <div class="mb-4 vh-100 d-flex flex-column justify-content-center align-items-center text-center">
            <label class="block text-gray-700 font-bold">Nama Jadwal:</label>
            <input type="text" name="nama_jadwal" required class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 text-black">
        </div>

        {{-- Waktu --}}
        <div class="mb-4 vh-100 d-flex flex-column justify-content-center align-items-center text-center">
            <label class="block text-gray-700 font-bold">Waktu:</label>
            <input type="date" name="waktu" required class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 text-black bg-white">
        </div>

        {{-- Kategori --}}
        <div class="mb-4 vh-100 d-flex flex-column justify-content-center align-items-center text-center">
            <label class="block text-gray-700 font-bold">Kategori:</label>
            <select id="kategori" name="kategori" class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 text-black bg-white">
               <option value="">Pilih Kategori</option>
               <option value="Acara">Acara</option>
               <option value="Pekerjaan">Pekerjaan</option>
               <option value="Istirahat">Istirahat/Healing</option>
               <option value="Tugas">Tugas</option>
            </select>
        </div>

        {{-- Deadline (Muncul Jika Kategori "Tugas") --}}
        <div class="mb-4 hidden vh-100 d-flex flex-column justify-content-center align-items-center text-center" id="deadlineField">
            <label class="block text-gray-700 font-bold">Deadline:</label>
            <input type="date" name="deadline" class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 text-black bg-white">
        </div>

        {{-- Prioritas --}}
        <div class="mb-4 vh-100 d-flex flex-column justify-content-center align-items-center text-center">
            <label class="block text-gray-700 font-bold">Prioritas:</label>
            <select name="prioritas" class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 text-black bg-white">
               <option value="Tinggi">Tinggi</option>
               <option value="Sedang">Sedang</option>
               <option value="Rendah">Rendah</option>
            </select>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4 vh-100 d-flex flex-column justify-content-center align-items-center text-center">
            <label class="block text-gray-700 font-bold">Deskripsi:</label>
            <input type="text" name="nama_jadwal" required class="w-full p-2 border border-gray-350 rounded focus:ring-3 focus:ring-blue-600 text-black">
        </div>

        {{-- Tombol Simpan --}}
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded transition duration-300">
            Simpan Jadwal
        </button>
       </form>
</div>

{{-- Script untuk Menampilkan Deadline Jika "Tugas" Dipilih --}}
<script>
    document.getElementById('kategori').addEventListener('change', function () {
        var deadlineField = document.getElementById('deadlineField');
        if (this.value === 'Tugas') {
            deadlineField.classList.remove('hidden');
        } else {
            deadlineField.classList.add('hidden');
        }
    });
</script>
@endsection
