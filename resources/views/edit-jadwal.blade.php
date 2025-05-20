@extends('layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
    <div class="flex-grow flex items-center justify-center py-6 sm:py-12 px-4">
        <div class="w-full max-w-md sm:max-w-lg bg-white rounded-2xl shadow-lg p-4 sm:p-6 fade-in">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-white bg-blue-900 rounded-t-xl py-3 sm:py-4 mb-4 sm:mb-6">Edit Jadwal</h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-3 sm:mb-4 bg-red-100 text-red-700 rounded-lg p-2 sm:p-3 text-center">
                    <ul class="list-disc list-inside text-sm sm:text-base">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form to Edit Jadwal -->
            <form id="schedule-form" action="{{ route('jadwal.update', $jadwal->_id) }}" method="POST" class="space-y-4 sm:space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Jadwal -->
                <div>
                    <label for="name" class="block text-xs sm:text-sm font-medium text-gray-700">Nama Jadwal <i class="fas fa-pen text-gray-400"></i></label>
                    <input type="text" class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('nama_jadwal') border-red-500 @enderror" id="name" name="nama_jadwal" value="{{ old('nama_jadwal', $jadwal->nama_jadwal) }}" required>
                    @error('nama_jadwal')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="date" class="block text-xs sm:text-sm font-medium text-gray-700">Tanggal <i class="fas fa-calendar-alt text-gray-400"></i></label>
                    <input type="date" class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('tanggal') border-red-500 @enderror" id="date" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal) }}" required>
                    @error('tanggal')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-xs sm:text-sm font-medium text-gray-700">Kategori <i class="fas fa-list text-gray-400"></i></label>
                    <select class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('kategori') border-red-500 @enderror" id="category" name="kategori" onchange="toggleDeadline()">
                        <option value="Acara" {{ old('kategori', $jadwal->kategori) == 'Acara' ? 'selected' : '' }}>Acara</option>
                        <option value="Pekerjaan" {{ old('kategori', $jadwal->kategori) == 'Pekerjaan' ? 'selected' : '' }}>Pekerjaan</option>
                        <option value="Istirahat" {{ old('kategori', $jadwal->kategori) == 'Istirahat' ? 'selected' : '' }}>Istirahat/Healing</option>
                        <option value="Tugas" {{ old('kategori', $jadwal->kategori) == 'Tugas' ? 'selected' : '' }}>Tugas</option>
                    </select>
                    @error('kategori')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Deadline (Tugas) -->
                <div id="deadline-field" class="{{ old('kategori', $jadwal->kategori) == 'Tugas' ? '' : 'hidden' }}">
                    <label for="deadline" class="block text-xs sm:text-sm font-medium text-gray-700">Deadline <i class="fas fa-calendar-check text-gray-400"></i></label>
                    <input type="date" class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('deadline') border-red-500 @enderror" id="deadline" name="deadline" value="{{ old('deadline', $jadwal->deadline) }}">
                    @error('deadline')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Jam -->
                <div>
                    <label for="jam" class="block text-xs sm:text-sm font-medium text-gray-700">Jam <i class="fas fa-clock text-gray-400"></i></label>
                    <input type="time" class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('jam') border-red-500 @enderror" id="jam" name="jam" value="{{ old('jam', $jadwal->jam) }}" required>
                    @error('jam')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Prioritas -->
                <div>
                    <label for="priority" class="block text-xs sm:text-sm font-medium text-gray-700">Prioritas <i class="fas fa-exclamation-circle text-gray-400"></i></label>
                    <select class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('prioritas') border-red-500 @enderror" id="priority" name="prioritas">
                        <option value="Tinggi" {{ old('prioritas', $jadwal->prioritas) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                        <option value="Sedang" {{ old('prioritas', $jadwal->prioritas) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Rendah" {{ old('prioritas', $jadwal->prioritas) == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                    </select>
                    @error('prioritas')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-xs sm:text-sm font-medium text-gray-700">Deskripsi <i class="fas fa-align-left text-gray-400"></i></label>
                    <textarea class="w-full px-3 sm:px-4 py-2 sm:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-900 text-sm sm:text-base @error('deskripsi') border-red-500 @enderror" id="description" name="deskripsi" rows="3">{{ old('deskripsi', $jadwal->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @endif
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('jadwal.index') }}" class="w-full sm:w-1/2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg text-center transition-colors duration-200 btn-pulse text-sm sm:text-base">
                        Kembali
                    </a>
                    <button type="submit" class="w-full sm:w-1/2 bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200 btn-pulse disabled:bg-gray-400 text-sm sm:text-base" onclick="this.disabled=true; this.form.submit();">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-900 via-indigo-900 to-blue-700 text-white py-4 sm:py-6">
        <div class="container mx-auto px-4 text-center">
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-8 mb-2 sm:mb-4">
                <a href="#" class="text-white hover:text-cyan-300 transition-colors duration-200 icon-hover">
                    <i class="fab fa-twitter fa-lg sm:fa-2x"></i>
                </a>
                <a href="#" class="text-white hover:text-cyan-300 transition-colors duration-200 icon-hover">
                    <i class="fab fa-instagram fa-lg sm:fa-2x"></i>
                </a>
                <a href="#" class="text-white hover:text-cyan-300 transition-colors duration-200 icon-hover">
                    <i class="fab fa-linkedin fa-lg sm:fa-2x"></i>
                </a>
            </div>
            <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-6 mb-1 sm:mb-2">
                <a href="{{ route('home') }}" class="text-white hover:text-cyan-300 transition-colors duration-200 text-xs sm:text-sm">Beranda</a>
                <a href="{{ route('jadwal.index') }}" class="text-white hover:text-cyan-300 transition-colors duration-200 text-xs sm:text-sm">Daftar Jadwal</a>
                <a href="#" class="text-white hover:text-cyan-300 transition-colors duration-200 text-xs sm:text-sm">Tentang Kami</a>
            </div>
            <p class="text-xs sm:text-sm mb-1">© 2025 TimeTune. All rights reserved.</p>
            <p class="text-xs">Dibuat dengan <i class="fas fa-heart text-amber-400"></i> untuk efisiensi waktu Anda</p>
        </div>
    </footer>

    <!-- JavaScript for handling visibility of deadline input based on category selection -->
    <script>
        function toggleDeadline() {
            let category = document.getElementById('category').value;
            let deadlineField = document.getElementById('deadline-field');
            deadlineField.classList.toggle('hidden', category !== 'Tugas');
        }

        // Trigger toggle on page load to match initial category
        document.addEventListener('DOMContentLoaded', toggleDeadline);
    </script>
@endsection