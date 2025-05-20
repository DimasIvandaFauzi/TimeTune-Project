<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimeTune</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3 {
            font-family: 'Poppins', sans-serif;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .gradient-bg {
            background: linear-gradient(-45deg, #1e40af, #3b82f6, #06b6d4, #1e3a8a);
            background-size: 400%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .table-row-hover:hover {
            background-color: #e0f2fe;
            transform: scale(1.01);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            border-color: #3b82f6;
            transition: all 0.2s ease;
        }
        .btn-pulse:hover {
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .icon-hover:hover {
            transform: rotate(360deg);
            transition: transform 0.5s ease;
        }
        .tooltip {
            position: relative;
        }
        .tooltip:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            top: 100%;
            right: 0;
            background: #1e3a8a;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.875rem;
            z-index: 10;
            white-space: nowrap;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col text-gray-800">
<!-- Navbar -->
    <nav class="bg-blue-900 shadow-lg p-4 sticky top-0 z-50">
        <div class="container mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logo.png') }}" alt="TimeTune Logo" class="h-12 w-auto transition-transform hover:scale-105">
                <span class="text-2xl font-bold text-white">TimeTune</span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="tooltip bg-blue-600 text-white font-medium px-4 py-2 rounded-full text-sm shadow-md" data-tooltip="Email: {{ Auth::user()->email }}">
                    Login sebagai: {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition-colors duration-200 btn-pulse">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
<!-- Navbar -->

<!-- Landing Page -->
    <section id="landing" class="min-h-screen flex flex-col justify-center items-center text-center relative gradient-bg">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 bg-white bg-opacity-90 p-10 md:p-16 rounded-2xl shadow-2xl w-11/12 md:w-3/4 lg:w-1/2 fade-in">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6 text-blue-900 tracking-tight">Selamat Datang di TimeTune</h1>
            <p class="text-lg md:text-xl mb-8 text-gray-700 leading-relaxed">Atur jadwal Anda dengan mudah dan efisien bersama TimeTune!</p>
            <div class="flex justify-center space-x-6">
                <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-3 px-8 rounded-full text-lg transition-transform hover:scale-105 btn-pulse" onclick="scrollToForm()">
                    Tambah Jadwal
                </button>
                <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full text-lg transition-transform hover:scale-105 btn-pulse" onclick="scrollToList()">
                    List Jadwal
                </button>
            </div>
        </div>
    </section>
<!-- Landing Page -->

<!-- List Jadwal -->
<section id="list-section" class="py-12 min-h-screen flex items-center bg-gradient-to-r from-blue-800 to-cyan-500">
    <div class="container mx-auto px-4 flex flex-col items-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-8 text-center text-white fade-in">Daftar Jadwal</h2>
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-lg overflow-hidden">
            @if ($jadwal->count())
                <table class="w-full text-center">
                    <thead class="bg-blue-900 text-white">
                        <tr>
                            <th class="py-4 px-6">No</th>
                            <th class="py-4 px-6">Nama Jadwal</th>
                            <th class="py-4 px-6">Tanggal</th>
                            <th class="py-4 px-6">Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($jadwal as $date)
                            <tr class="table-row-hover border-b border-gray-200">
                                <td class="py-4 px-6">{{ $no++ }}</td>
                                <td class="py-4 px-6 text-capitalize">{{ $date->nama_jadwal }}</td>
                                <td class="py-4 px-6">{{ $date->tanggal }}</td>
                                <td class="py-4 px-6">{{ $date->jam }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center text-gray-800 py-8 text-lg">Belum ada jadwal yang tersedia.</p>
            @endif
        </div>
        <div class="flex justify-center space-x-4 mt-6">
            <button id="view-all-btn" class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-6 rounded-full transition-colors duration-200 btn-pulse">
                Lihat Semua
            </button>
            <a href="{{ route('jadwal.index') }}" id="detail-btn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-full transition-colors duration-200 btn-pulse hidden">
                Detail Jadwal
            </a>
        </div>
    </div>
</section>
<!-- List Jadwal -->

<!-- Tambah Jadwal -->
<section id="form-section" class="py-12 min-h-screen flex flex-col justify-center items-center bg-gradient-to-r from-blue-700 to-blue-400">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-8 text-white fade-in">Tambah Jadwal</h2>
        @if ($errors->any())
            <div class="mb-6 p-4 bg-amber-100 text-amber-800 rounded-lg shadow-md w-full max-w-lg mx-auto">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="schedule-form" class="w-full max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-lg" action="{{ route('jadwal.store') }}" method="POST">
            @csrf
            <!-- Nama Jadwal -->
            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Jadwal</label>
                <input type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200" id="name" name="nama_jadwal" required>
            </div>
            <!-- Kategori -->
            <div class="mb-5">
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200" id="category" name="kategori" onchange="toggleDeadline()">
                    <option value="Acara">Acara</option>
                    <option value="Pekerjaan">Pekerjaan</option>
                    <option value="Istirahat">Istirahat/Healing</option>
                    <option value="Tugas">Tugas</option>
                </select>
            </div>
            <!-- Tanggal -->
            <div class="mb-5">
                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                <input type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200" id="date" name="tanggal" required>
            </div>
            <!-- Deadline (Tugas) -->
            <div class="mb-5 hidden" id="deadline-field">
                <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">Deadline</label>
                <input type="date" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200" id="deadline" name="deadline">
            </div>
            <!-- Jam -->
            <div class="mb-5">
                <label for="jam" class="block text-sm font-medium text-gray-700 mb-2">Jam</label>
                <input type="time" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200" id="jam" name="jam" required>
            </div>
            <!-- Prioritas -->
            <div class="mb-5">
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Prioritas</label>
                <select class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200" id="priority" name="prioritas">
                    <option value="Tinggi">Tinggi</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Rendah">Rendah</option>
                </select>
            </div>
            <!-- Deskripsi -->
            <div class="mb-5">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition-all duration-200" id="description" name="deskripsi" rows="4"></textarea>
            </div>
            <!-- Button -->
            <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-bold py-3 px-4 rounded-full transition-colors duration-200 btn-pulse">
                Simpan
            </button>
        </form>
    </div>
</section>
<!-- Tambah Jadwal -->

<!-- Footer -->
<footer class="bg-gradient-to-r from-blue-900 via-indigo-900 to-blue-700 text-white py-10">
    <div class="container mx-auto px-4 text-center">
        <div class="flex justify-center space-x-8 mb-6">
            <a href="#" class="text-white hover:text-cyan-300 transition-colors duration-200 icon-hover">
                <i class="fab fa-twitter fa-2x"></i>
            </a>
            <a href="#" class="text-white hover:text-cyan-300 transition-colors duration-200 icon-hover">
                <i class="fab fa-instagram fa-2x"></i>
            </a>
            <a href="#" class="text-white hover:text-cyan-300 transition-colors duration-200 icon-hover">
                <i class="fab fa-linkedin fa-2x"></i>
            </a>
        </div>
        <div class="flex justify-center space-x-6 mb-4">
            <a href="{{ route('home') }}" class="text-white hover:text-cyan-300 transition-colors duration-200">Beranda</a>
            <a href="{{ route('jadwal.index') }}" class="text-white hover:text-cyan-300 transition-colors duration-200">Daftar Jadwal</a>
            <a href="#" class="text-white hover:text-cyan-300 transition-colors duration-200">Tentang Kami</a>
        </div>
        <p class="text-sm mb-2">© 2025 TimeTune. All rights reserved.</p>
        <p class="text-xs">Dibuat dengan <i class="fas fa-heart text-amber-400"></i> untuk efisiensi waktu Anda</p>
    </div>
</footer>
<!-- Footer -->

<!-- Skrip -->
<script>
    // Scroll smooth ke bagian tertentu
    function scrollToForm() {
        document.getElementById('form-section').scrollIntoView({ behavior: 'smooth' });
    }
    function scrollToList() {
        document.getElementById('list-section').scrollIntoView({ behavior: 'smooth' });
    }

    // Tampilkan atau sembunyikan field deadline berdasarkan kategori
    function toggleDeadline() {
        const category = document.getElementById('category').value;
        const deadlineField = document.getElementById('deadline-field');
        if (category === 'Tugas') {
            deadlineField.classList.remove('hidden');
            document.getElementById('deadline').setAttribute('required', 'true');
        } else {
            deadlineField.classList.add('hidden');
            document.getElementById('deadline').removeAttribute('required');
        }
    }

    // Kosongkan form setelah submit sukses
    document.getElementById('schedule-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = this;
        fetch(form.action, {
            method: form.method,
            body: new FormData(form),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
            }
        }).then(response => {
            if (response.ok) {
                alert('Jadwal berhasil ditambahkan!');
                form.reset();
                toggleDeadline();
                window.location.reload();
            } else {
                response.json().then(data => {
                    alert('Gagal menambahkan jadwal: ' + (data.message || 'Terjadi kesalahan'));
                });
            }
        }).catch(error => console.error('Error:', error));
    });

    // Tampilkan 5 jadwal pertama dan sembunyikan sisanya
    document.addEventListener("DOMContentLoaded", function() {
        const tableBody = document.querySelector("#list-section tbody");
        const rows = tableBody ? tableBody.querySelectorAll("tr") : [];
        const viewAllBtn = document.getElementById("view-all-btn");
        const detailBtn = document.getElementById("detail-btn");

        // Tampilkan hanya 5 jadwal awal
        for (let i = 5; i < rows.length; i++) {
            rows[i].style.display = "none";
        }

        let isExpanded = false;

        viewAllBtn.addEventListener("click", function() {
            if (!isExpanded) {
                // Tampilkan maksimal 9 jadwal
                for (let i = 0; i < rows.length; i++) {
                    if (i < 9) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
                viewAllBtn.textContent = "Sembunyikan";
                detailBtn.classList.remove("hidden");
            } else {
                // Kembali ke 5 jadwal awal
                for (let i = 0; i < rows.length; i++) {
                    if (i < 5) {
                        rows[i].style.display = "";
                    } else {
                        rows[i].style.display = "none";
                    }
                }
                viewAllBtn.textContent = "Lihat Semua";
                detailBtn.classList.add("hidden");
            }
            isExpanded = !isExpanded;
        });
    });
</script>
</body>
</html>