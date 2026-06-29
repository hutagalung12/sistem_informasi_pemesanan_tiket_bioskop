<?php

namespace App\Http\Controllers;

use App\Models\Kursi;
use App\Models\Studio;
use App\Models\DetailPemesanan; // Pastikan model DetailPemesanan di-import
use Illuminate\Http\Request;

class KursiController extends Controller
{
    public function index()
    {
        // Mengambil semua data kursi dan mengecek apakah sudah dipesan oleh pelanggan
        $kursis = Kursi::with('studio')->get()->map(function($kursi) {
            
            // Cek apakah ID kursi ini terdaftar di detail pemesanan
            $isTerbooking = DetailPemesanan::where('kursi_id', $kursi->id)->exists();

            // Jika ada yang memesan, ubah statusnya menjadi terisi untuk tampilan Blade
            if ($isTerbooking) {
                $kursi->status = 'terisi';
            }

            return $kursi;
        });

        return view(
            'admin.kursis.index',
            compact('kursis')
        );
    }

    public function create()
    {
        $studios = Studio::all();

        return view(
            'admin.kursis.create',
            compact('studios')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'studio_id' => 'required',
            'nomor_kursi' => 'required'
        ]);

        Kursi::create($request->all());

        return redirect()->route('kursis.index');
    }

    public function edit(Kursi $kursi)
    {
        return view(
            'admin.kursis.edit',
            compact('kursi')
        );
    }

    public function update(Request $request, Kursi $kursi)
    {
        $kursi->update($request->all());

        return redirect()->route('kursis.index');
    }

    public function destroy(Kursi $kursi)
    {
        $kursi->delete();

        return redirect()->route('kursis.index');
    }
}