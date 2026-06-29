<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kursi;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with([
    'jadwal.film',
    'detailPemesanans.kursi'
])
->where('user_id', Auth::id())
->latest()
->get();

        return view(
            'pelanggan.riwayat',
            compact('pemesanans')
        );
    }

    public function create(Jadwal $jadwal)
{
    $kursis = Kursi::where(
        'studio_id',
        $jadwal->studio_id
    )->orderBy('nomor_kursi')->get();

    $kursiTerisi = DetailPemesanan::whereHas('pemesanan', function ($q) use ($jadwal) {

        $q->where('jadwal_id', $jadwal->id);

    })->pluck('kursi_id')->toArray();

    return view(
        'pelanggan.pesan',
        compact(
            'jadwal',
            'kursis',
            'kursiTerisi'
        )
    );
}
public function store(Request $request)
{
    $request->validate([
        'jadwal_id' => 'required',
        'kursi_id' => 'required|array|min:1',
        'jumlah_tiket' => 'required|integer|min:1'
    ]);

    // Cek apakah ada kursi yang sudah dipakai
    foreach ($request->kursi_id as $kursi) {

        $sudahDipakai = DetailPemesanan::where('kursi_id', $kursi)
            ->whereHas('pemesanan', function ($q) use ($request) {
                $q->where('jadwal_id', $request->jadwal_id);
            })
            ->exists();

        if ($sudahDipakai) {
            return back()->with(
                'error',
                'Salah satu kursi sudah dipesan.'
            );
        }
    }

    $jadwal = Jadwal::findOrFail($request->jadwal_id);

    $total = $jadwal->harga_tiket * count($request->kursi_id);

   $pemesanan = Pemesanan::create([
    'user_id' => Auth::id(),
    'jadwal_id' => $request->jadwal_id,
    'jumlah_tiket' => count($request->kursi_id),
    'total_harga' => $total,
    'status' => 'pending',

    'kode_pembayaran' => 'PAY-'.strtoupper(uniqid()),

    'expired_at' => now()->addMinutes(30)
]);

    foreach ($request->kursi_id as $kursi) {

        DetailPemesanan::create([
            'pemesanan_id' => $pemesanan->id,
            'kursi_id' => $kursi
        ]);

    }

    return redirect()
    ->route(
        'pembayaran',
        $pemesanan->id
    );
}
public function pembayaran(Pemesanan $pemesanan)
{
    return view(
        'pelanggan.pembayaran',
        compact('pemesanan')
    );
}
public function bayar(Request $request, Pemesanan $pemesanan)
{
    if ($pemesanan->status == 'dibayar') {

        return back()->with(
            'error',
            'Pesanan ini sudah dibayar.'
        );

    }

    $request->validate([
        'metode_pembayaran' => 'required'
    ]);

    $pemesanan->update([
        'metode_pembayaran' => $request->metode_pembayaran,
        'status' => 'dibayar'
    ]);

    return redirect()
        ->route('riwayat')
        ->with(
            'success',
            'Pembayaran berhasil.'
        );
}
public function destroy(Pemesanan $pemesanan)
{
    $pemesanan->delete();

    return redirect()->back()->with(
        'success',
        'Transaksi berhasil dihapus.'
    );
}
 public function laporan(Request $request)
{
    $query = Pemesanan::with([
        'user',
        'jadwal.film',
        'detailPemesanans.kursi'
    ]);

    // ==========================
    // PENCARIAN
    // ==========================
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->whereHas('user', function ($user) use ($search) {
                $user->where('name', 'like', '%' . $search . '%');
            })

            ->orWhereHas('jadwal.film', function ($film) use ($search) {
                $film->where('judul', 'like', '%' . $search . '%');
            });

        });
    }

    // ==========================
    // FILTER TANGGAL
    // ==========================
    if ($request->filled('tanggal')) {

        $query->whereDate(
            'created_at',
            $request->tanggal
        );

    }

    $pemesanans = $query
        ->latest()
        ->get();

    $totalPendapatan = $pemesanans->sum('total_harga');

    $jumlahTransaksi = $pemesanans->count();

    return view(
        'admin.laporan',
        compact(
            'pemesanans',
            'totalPendapatan',
            'jumlahTransaksi'
        )
    );
}

  public function pdf($id)
{
    $pemesanan = Pemesanan::with([
        'user',
        'jadwal.film',
        'jadwal.studio',
        'detailPemesanans.kursi'
    ])->findOrFail($id);

    $pdf = Pdf::loadView(
        'pdf.tiket',
        compact('pemesanan')
    );

    return $pdf->download('Tiket-Bioskop.pdf');
}
    public function exportPdf()
{
    $pemesanans = Pemesanan::with([
        'user',
        'jadwal.film',
        'detailPemesanans.kursi'
    ])->latest()->get();

    $totalPendapatan = $pemesanans->sum('total_harga');

    $pdf = Pdf::loadView(
        'pdf.laporan',
        compact(
            'pemesanans',
            'totalPendapatan'
        )
    );

    return $pdf->download('laporan-pemesanan.pdf');
}
}