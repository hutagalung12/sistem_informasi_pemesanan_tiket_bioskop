<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Studio;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with([
            'film',
            'studio'
        ])->latest()->get();

        return view(
            'admin.jadwals.index',
            compact('jadwals')
        );
    }

    public function create()
    {
        $films = Film::all();
        $studios = Studio::all();

        return view(
            'admin.jadwals.create',
            compact(
                'films',
                'studios'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
    'film_id' => 'required',
    'studio_id' => 'required',
    'tanggal' => 'required',
    'jam_tayang' => 'required',
    'harga_tiket' => 'required|numeric'
]);

        Jadwal::create($request->all());

        return redirect()
            ->route('jadwals.index')
            ->with(
                'success',
                'Jadwal berhasil ditambahkan'
            );
    }

    public function show(Jadwal $jadwal)
    {
        return view(
            'admin.jadwals.show',
            compact('jadwal')
        );
    }

    public function edit(Jadwal $jadwal)
    {
        $films = Film::all();
        $studios = Studio::all();

        return view(
            'admin.jadwals.edit',
            compact(
                'jadwal',
                'films',
                'studios'
            )
        );
    }

    public function update(
        Request $request,
        Jadwal $jadwal
    )
    {
        $request->validate([
    'film_id' => 'required',
    'studio_id' => 'required',
    'tanggal' => 'required',
    'jam_tayang' => 'required',
    'harga_tiket' => 'required|numeric'
]);

        $jadwal->update($request->all());

        return redirect()
            ->route('jadwals.index')
            ->with(
                'success',
                'Jadwal berhasil diupdate'
            );
    }

   public function destroy(Jadwal $jadwal)
{
    $jadwal->delete();

    return redirect()
        ->route('jadwals.index')
        ->with(
            'success',
            'Jadwal berhasil dihapus'
        );
}

public function pelanggan()
{
    $jadwals = Jadwal::with([
        'film',
        'studio'
    ])->get();

    return view(
        'pelanggan.jadwal',
        compact('jadwals')
    );
}
}