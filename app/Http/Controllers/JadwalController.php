<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil jadwal hanya untuk user yang login
        $jadwals = Jadwal::where('user_id', Auth::id())->get();
        return view('detail-jadwal', compact('jadwals'));
    }

    /**
     * Display home page with all jadwal
     */
    public function home()
    {
        // Ambil jadwal hanya untuk user yang login
        $jadwal = Jadwal::where('user_id', Auth::id())->get();
        return view('home', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create-jadwal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_jadwal' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori' => 'required|string',
            'deadline' => 'nullable|date|required_if:kategori,Tugas',
            'jam' => 'required',
            'prioritas' => 'required|string',
            'deskripsi' => 'nullable|string',
        ], [
            'deadline.required_if' => 'Deadline wajib diisi jika kategori adalah Tugas.'
        ]);

        // Simpan data ke database dengan user_id
        Jadwal::create(array_merge(
            $request->only([
                'nama_jadwal', 'tanggal', 'kategori', 'deadline', 'jam', 'prioritas', 'deskripsi'
            ]),
            ['user_id' => Auth::id()]
        ));

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cari jadwal berdasarkan ID dan user_id
        $jadwal = Jadwal::where('user_id', Auth::id())->where('_id', $id)->firstOrFail();
        return view('show-jadwal', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari jadwal berdasarkan ID dan user_id
        $jadwal = Jadwal::where('user_id', Auth::id())->where('_id', $id)->firstOrFail();
        return view('edit-jadwal', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_jadwal' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'kategori' => 'required|string',
            'deadline' => 'nullable|date|required_if:kategori,Tugas',
            'jam' => 'required',
            'prioritas' => 'required|string',
            'deskripsi' => 'nullable|string',
        ], [
            'deadline.required_if' => 'Deadline wajib diisi jika kategori adalah Tugas.'
        ]);

        // Cari jadwal berdasarkan ID dan user_id
        $jadwal = Jadwal::where('user_id', Auth::id())->where('_id', $id)->firstOrFail();

        // Update data
        $jadwal->update($request->only([
            'nama_jadwal', 'tanggal', 'kategori', 'deadline', 'jam', 'prioritas', 'deskripsi'
        ]));

        // Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari jadwal berdasarkan ID dan user_id
        $jadwal = Jadwal::where('user_id', Auth::id())->where('_id', $id)->firstOrFail();

        // Hapus jadwal dari database
        $jadwal->delete();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }

    public function sortBalanced()
    {
        // Ambil jadwal hanya untuk user yang login
        $jadwals = Jadwal::where('user_id', Auth::id())->get()->sort(function ($a, $b) {
            $timeA = strtotime($a->tanggal . ' ' . $a->jam);
            $timeB = strtotime($b->tanggal . ' ' . $b->jam);

            if ($timeA === $timeB) {
                $prioA = $this->getPrioritasScore($a->prioritas) + $this->getKategoriScore($a->kategori);
                $prioB = $this->getPrioritasScore($b->prioritas) + $this->getKategoriScore($b->kategori);
                return $prioA <=> $prioB;
            }
            return $timeA <=> $timeB;
        })->values();

        return response()->json($jadwals);
    }

    private function getPrioritasScore($prioritas)
    {
        return match($prioritas) {
            'Tinggi' => 1,
            'Sedang' => 2,
            'Rendah' => 3,
            default => 4,
        };
    }

    private function getKategoriScore($kategori)
    {
        return match($kategori) {
            'Tugas' => 1,
            'Pekerjaan' => 2,
            'Acara' => 3,
            'Istirahat/Healing' => 4,
            default => 5,
        };
    }
}