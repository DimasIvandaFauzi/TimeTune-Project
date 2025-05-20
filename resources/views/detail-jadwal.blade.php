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
        <div class="container mx-auto flex flex-col sm:flex-row items-center justify-between space-y-3 sm:space-y-0">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logo.png') }}" alt="TimeTune Logo" class="h-10 w-auto transition-transform hover:scale-105">
                <span class="text-xl sm:text-2xl font-bold text-white">TimeTune</span>
            </div>
            <div class="flex flex-col sm:flex-row items-center space-y-3 sm:space-y-0 sm:space-x-4 w-full sm:w-auto">
                <span class="tooltip bg-blue-600 text-white font-medium px-3 py-2 rounded-full text-xs sm:text-sm shadow-md text-center" data-tooltip="Email: {{ Auth::user()->email }}">
                    Login sebagai: {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full transition-colors duration-200 btn-pulse text-sm sm:text-base">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <section class="py-8 sm:py-12 min-h-screen flex items-center">
        <div class="container mx-auto px-4 flex flex-col items-center">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 sm:mb-8 text-center text-white fade-in">Daftar Lengkap Jadwal</h2>
            <div class="w-full max-w-4xl sm:max-w-6xl mb-4 sm:mb-6">
                <button id="seimbangkanBtn" class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-2 px-4 sm:px-6 rounded-full transition-colors duration-200 btn-pulse text-sm sm:text-base">
                    Seimbangkan Jadwal
                </button>
            </div>
            <div class="w-full max-w-4xl sm:max-w-6xl bg-white rounded-2xl shadow-lg overflow-x-auto">
                @if ($jadwals->count())
                    <!-- Tabel untuk desktop -->
                    <div class="hidden sm:block">
                        <table class="w-full text-center">
                            <thead class="bg-blue-900 text-white">
                                <tr>
                                    <th class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">No</th>
                                    <th class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">Nama Jadwal</th>
                                    <th class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">Tanggal</th>
                                    <th class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">Kategori</th>
                                    <th class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">Prioritas</th>
                                    <th class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">Deskripsi</th>
                                    <th class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">Deadline</th>
                                    <th class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">Jam</th>
                                    <th class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach ($jadwals as $date)
                                    <tr class="table-row-hover border-b border-gray-200">
                                        <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">{{ $no++ }}</td>
                                        <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base text-capitalize">{{ $date->nama_jadwal }}</td>
                                        <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">{{ $date->tanggal }}</td>
                                        <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">{{ $date->kategori }}</td>
                                        <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">{{ $date->prioritas }}</td>
                                        <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">{{ $date->deskripsi ?? '-' }}</td>
                                        <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">{{ $date->deadline ?? '-' }}</td>
                                        <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">{{ $date->jam }}</td>
                                        <td class="py-3 sm:py-4 px-4 sm:px-6 flex justify-center space-x-2">
                                            <a href="{{ route('jadwal.edit', $date->_id) }}" class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse text-sm sm:text-base">
                                                Edit
                                            </a>
                                            <form action="{{ route('jadwal.destroy', $date->_id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse text-sm sm:text-base" onclick="return confirm('Yakin ingin menghapus?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Kartu untuk mobile -->
                    <div class="block sm:hidden space-y-4 p-4">
                        @php $no = 1; @endphp
                        @foreach ($jadwals as $date)
                            <div class="table-row-hover p-4 rounded-lg shadow-md bg-gray-50">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-bold text-blue-900 text-sm">No: {{ $no++ }}</span>
                                </div>
                                <p class="text-sm"><span class="font-semibold">Nama Jadwal:</span> {{ $date->nama_jadwal }}</p>
                                <p class="text-sm"><span class="font-semibold">Tanggal:</span> {{ $date->tanggal }}</p>
                                <p class="text-sm"><span class="font-semibold">Kategori:</span> {{ $date->kategori }}</p>
                                <p class="text-sm"><span class="font-semibold">Prioritas:</span> {{ $date->prioritas }}</p>
                                <p class="text-sm"><span class="font-semibold">Deskripsi:</span> {{ $date->deskripsi ?? '-' }}</p>
                                <p class="text-sm"><span class="font-semibold">Deadline:</span> {{ $date->deadline ?? '-' }}</p>
                                <p class="text-sm"><span class="font-semibold">Jam:</span> {{ $date->jam }}</p>
                                <div class="flex justify-end space-x-2 mt-3">
                                    <a href="{{ route('jadwal.edit', $date->_id) }}" class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('jadwal.destroy', $date->_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse text-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-800 py-6 sm:py-8 text-base sm:text-lg">Belum ada jadwal yang tersedia.</p>
                @endif
            </div>
            <div class="mt-4 sm:mt-6">
                <a href="{{ route('home') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 sm:px-6 rounded-full transition-colors duration-200 btn-pulse text-sm sm:text-base">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>
    <footer class="bg-gradient-to-r from-blue-900 via-indigo-900 to-blue-700 text-white py-6 sm:py-10">
        <div class="container mx-auto px-4 text-center">
            <div class="flex flex-col sm:flex-row justify-center space-y-6 sm:space-y-0 sm:space-x-8 mb-4 sm:mb-6">
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
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6 mb-3 sm:mb-4">
                <a href="{{ route('home') }}" class="text-white hover:text-cyan-300 transition-colors duration-200 text-sm sm:text-base">Beranda</a>
                <a href="{{ route('jadwal.index') }}" class="text-white hover:text-cyan-300 transition-colors duration-200 text-sm sm:text-base">Daftar Jadwal</a>
                <a href="#" class="text-white hover:text-cyan-300 transition-colors duration-200 text-sm sm:text-base">Tentang Kami</a>
            </div>
            <p class="text-xs sm:text-sm mb-2">© 2025 TimeTune. All rights reserved.</p>
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
                    const mobileCards = document.querySelector('.space-y-4');
                    if (tbody) tbody.innerHTML = '';
                    if (mobileCards) mobileCards.innerHTML = '';

                    if (data.length === 0) {
                        if (tbody) {
                            tbody.innerHTML = '<tr><td colspan="9" class="py-4 px-6 text-center text-gray-800">Belum ada jadwal yang tersedia.</td></tr>';
                        }
                        if (mobileCards) {
                            mobileCards.innerHTML = '<p class="text-center text-gray-800 py-6 text-base">Belum ada jadwal yang tersedia.</p>';
                        }
                        alert('Tidak ada jadwal untuk diseimbangkan.');
                        return;
                    }

                    let no = 1;
                    data.forEach(jadwal => {
                        // Update tabel untuk desktop
                        if (tbody) {
                            const tr = document.createElement('tr');
                            tr.classList.add('table-row-hover', 'border-b', 'border-gray-200');
                            tr.innerHTML = `
                                <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">${no}</td>
                                <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base text-capitalize">${jadwal.nama_jadwal}</td>
                                <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">${jadwal.tanggal}</td>
                                <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">${jadwal.kategori}</td>
                                <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">${jadwal.prioritas}</td>
                                <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">${jadwal.deskripsi ?? '-'}</td>
                                <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">${jadwal.deadline ?? '-'}</td>
                                <td class="py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base">${jadwal.jam}</td>
                                <td class="py-3 sm:py-4 px-4 sm:px-6 flex justify-center space-x-2">
                                    <a href="{{ url('/jadwal') }}/${jadwal._id}/edit" class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse text-sm sm:text-base">Edit</a>
                                    <form action="{{ url('/jadwal') }}/${jadwal._id}" method="POST" class="inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse text-sm sm:text-base" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            `;
                            tbody.appendChild(tr);
                        }

                        // Update kartu untuk mobile
                        if (mobileCards) {
                            const card = document.createElement('div');
                            card.classList.add('table-row-hover', 'p-4', 'rounded-lg', 'shadow-md', 'bg-gray-50');
                            card.innerHTML = `
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-bold text-blue-900 text-sm">No: ${no}</span>
                                </div>
                                <p class="text-sm"><span class="font-semibold">Nama Jadwal:</span> ${jadwal.nama_jadwal}</p>
                                <p class="text-sm"><span class="font-semibold">Tanggal:</span> ${jadwal.tanggal}</p>
                                <p class="text-sm"><span class="font-semibold">Kategori:</span> ${jadwal.kategori}</p>
                                <p class="text-sm"><span class="font-semibold">Prioritas:</span> ${jadwal.prioritas}</p>
                                <p class="text-sm"><span class="font-semibold">Deskripsi:</span> ${jadwal.deskripsi ?? '-'}</p>
                                <p class="text-sm"><span class="font-semibold">Deadline:</span> ${jadwal.deadline ?? '-'}</p>
                                <p class="text-sm"><span class="font-semibold">Jam:</span> ${jadwal.jam}</p>
                                <div class="flex justify-end space-x-2 mt-3">
                                    <a href="{{ url('/jadwal') }}/${jadwal._id}/edit" class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse text-sm">Edit</a>
                                    <form action="{{ url('/jadwal') }}/${jadwal._id}" method="POST" class="inline">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-full transition-colors duration-200 btn-pulse text-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </div>
                            `;
                            mobileCards.appendChild(card);
                        }
                        no++;
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