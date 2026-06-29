<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Studio;
use App\Models\Jadwal;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // =========================
    // DASHBOARD ADMIN
    // =========================
    public function index(Request $request)
    {
        $film = Film::count();
        $studio = Studio::count();
        $jadwal = Jadwal::count();
        $pemesanan = Pemesanan::count();
        $search = $request->search;

        // Film Terbaru + Pencarian
        $films = Film::when($search, function ($query) use ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('genre', 'like', '%' . $search . '%');
        })
        ->latest()
        ->take(6)
        ->get();

        $pemesanans = Pemesanan::with([
            'user',
            'jadwal.film',
            'detailPemesanans.kursi'
        ])
        ->latest()
        ->take(5)
        ->get();

        return view(
            'admin.dashboard',
            compact(
                'film',
                'studio',
                'jadwal',
                'pemesanan',
                'films',
                'pemesanans'
            )
        );
    }

    public function jadwalTayang()
    {
        $jadwals = Jadwal::with([
            'film',
            'studio'
        ])
        ->orderBy('tanggal')
        ->get();

        return view(
            'pelanggan.jadwal-tayang',
            compact('jadwals')
        );
    }

    // =========================
    // DASHBOARD PELANGGAN
    // =========================
    public function pelanggan(Request $request)
    {
        $search = $request->search;

        // Film + Pencarian
        $films = Film::when($search, function ($query) use ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('genre', 'like', '%' . $search . '%');
        })
        ->latest()
        ->take(6)
        ->get();

        // Jadwal + Pencarian
        $jadwals = Jadwal::with([
            'film',
            'studio'
        ])
        ->when($search, function ($query) use ($search) {
            $query->whereHas('film', function ($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('genre', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('tanggal')
        ->take(5)
        ->get();

        $pesanans = Pemesanan::with([
            'jadwal.film',
            'detailPemesanans.kursi'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->take(5)
        ->get();

        $jumlahPesanan = Pemesanan::where('user_id', Auth::id())->count();

        // Variabel diubah menjadi $riwayat agar langsung terbaca di Blade
        // KODE BARU (Menghitung berapa kali melakukan transaksi/pemesanan)
$riwayat = Pemesanan::where('user_id', Auth::id())->count();

        return view(
            'pelanggan.dashboard',
            compact(
                'films',
                'jadwals',
                'pesanans',
                'jumlahPesanan',
                'riwayat'
            )
        );
    }
}