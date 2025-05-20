<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Lengkap Jadwal</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Poppins', sans-serif; }
        .fade-in { animation: fadeIn 1s ease-in-out; }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .table-row-hover:hover {
            background-color: #e0f2fe;
            transform: scale(1.01);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .btn-pulse:hover { animation: pulse 1.5s infinite; }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .icon-hover:hover {
            transform: rotate(360deg);
            transition: transform 0.5s ease;
        }
        .tooltip { position: relative; }
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
<body class="min-h-screen flex flex-col text-gray-800 bg-gradient-to-br from-blue-900 via-blue-700 to-blue-500">
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
    <section class="py-12 min-h-screen flex items-center">
        <div class="container mx-auto px-4 flex flex-col items-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-8 text-center text-white fade-in">Daftar Lengkap Jadwal</h2>
            <div class="w-full max-w-6xl mb-6">
                <button id="seimbangkanBtn" class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-6 rounded-full transition-colors duration-200 btn-pulse">
                    Seimbangkan Jadwal
                </button>
            </div>
            <div class="w-full max-w-6xl bg-white rounded-2xl shadow-lg overflow-x-auto">
                @if ($jadwals->count())
                    <table class="w-full text-center">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="py-4 px-6">No</th>
                                <th class="py-4 px-6">Nama Jadwal</th>
                                <th class="py-4 px-6">Tanggal</th>
                                <th class="py-4 px-6">Kategori</th>
                                <th class="py-4 px-6">Prioritas</th>
                                <th class="py-4 px-6">Deskripsi</th>
                                <th class="py-4 px-6">Deadline</th>
                                <th class="py-4 px-6">Jam</th>
                                <th class="py-4 px-6">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($jadwals as $date)
                                <tr class="table-row-hover border-b border-gray-200">
                                    <td class="py-4 px-6">{{ $no++ }}</td>
                                    <td class="py-4 px-6 text-capitalize">{{ $date->nama_jadwal }}</td>
                                    <td class="py-4 px-6">{{ $date->tanggal }}</td>
                                    <td class="py-4 px-6">{{ $date->kategori }}</td>
                                    <td class="py-4 px-6">{{ $date->prioritas }}</td>
                                    <td class="py-4 px-6">{{ $date->deskripsi ?? '-' }}</td>
                                    <td class="py-4 px-6">{{ $date->deadline ?? '-' }}</td>
                                    <td class="py-4 px-6">{{ $date->jam }}</td>
                                    <td class="py-4 px-6 flex justify-center space-x-2">
                                        <a href="{{ route('jadwal.edit', $date->_id) }}" class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse">
                                            Edit
                                        </a>
                                        <form action="{{ route('jadwal.destroy', $date->_id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse" onclick="return confirm('Yakin ingin menghapus?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-800 py-8 text-lg">Belum ada jadwal yang tersedia.</p>
                @endif
            </div>
            <div class="mt-6">
                <a href="{{ route('home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-full transition-colors duration-200 btn-pulse">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>
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
    <script>
        document.getElementById('seimbangkanBtn').addEventListener('click', function () {
            const seimbangkanBtn = this;
            seimbangkanBtn.textContent = 'Memuat...';
            seimbangkanBtn.disabled = true;

            fetch('{{ route('jadwal.seimbangkan') }}', {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
                .then(res => {
                    if (!res.ok) {
                        throw new Error(res.status === 500 ? 'Terjadi kesalahan di server' : 'Gagal mengambil data');
                    }
                    return res.json();
                })
                .then(data => {
                    const tbody = document.querySelector('tbody');
                    tbody.innerHTML = '';
                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="9" class="py-4 px-6 text-center text-gray-800">Belum ada jadwal yang tersedia.</td></tr>';
                        alert('Tidak ada jadwal untuk diseimbangkan.');
                        return;
                    }

                    let no = 1;
                    data.forEach(jadwal => {
                        const tr = document.createElement('tr');
                        tr.classList.add('table-row-hover', 'border-b', 'border-gray-200');
                        tr.innerHTML = `
                            <td class="py-4 px-6">${no++}</td>
                            <td class="py-4 px-6 text-capitalize">${jadwal.nama_jadwal}</td>
                            <td class="py-4 px-6">${jadwal.tanggal}</td>
                            <td class="py-4 px-6">${jadwal.kategori}</td>
                            <td class="py-4 px-6">${jadwal.prioritas}</td>
                            <td class="py-4 px-6">${jadwal.deskripsi ?? '-'}</td>
                            <td class="py-4 px-6">${jadwal.deadline ?? '-'}</td>
                            <td class="py-4 px-6">${jadwal.jam}</td>
                            <td class="py-4 px-6 flex justify-center space-x-2">
                                <a href="{{ url('/jadwal') }}/${jadwal._id}/edit" class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse">Edit</a>
                                <form action="{{ url('/jadwal') }}/${jadwal._id}" method="POST" class="inline">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                    alert('Jadwal berhasil diseimbangkan!');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menyeimbangkan jadwal: ' + error.message);
                })
                .finally(() => {
                    seimbangkanBtn.textContent = 'Seimbangkan Jadwal';
                    seimbangkanBtn.disabled = false;
                });
        });
    </script>
</body>
</html>