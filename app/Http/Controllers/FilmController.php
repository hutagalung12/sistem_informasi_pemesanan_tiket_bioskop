<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::latest()->paginate(10);

        return view('admin.films.index', compact('films'));
    }
    

    public function create()
    {
        return view('admin.films.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'genre' => 'required',
            'durasi' => 'required|numeric',
            'tanggal_tayang' => 'required',
            'sinopsis' => 'required',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $poster = null;

        if($request->hasFile('poster'))
        {
            $poster = $request->file('poster')
                              ->store('poster','public');
        }

        Film::create([
            'judul' => $request->judul,
            'genre' => $request->genre,
            'durasi' => $request->durasi,
            'tanggal_tayang' => $request->tanggal_tayang,
            'sinopsis' => $request->sinopsis,
            'poster' => $poster
        ]);

        return redirect()
            ->route('films.index')
            ->with('success','Film berhasil ditambahkan');
    }

    public function show(Film $film)
    {
        return view('admin.films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        return view('admin.films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul' => 'required',
            'genre' => 'required',
            'durasi' => 'required|numeric',
            'tanggal_tayang' => 'required',
            'sinopsis' => 'required'
        ]);

        if($request->hasFile('poster'))
        {
            if($film->poster)
            {
                Storage::disk('public')
                    ->delete($film->poster);
            }

            $film->poster = $request->file('poster')
                                    ->store('poster','public');
        }

        $film->judul = $request->judul;
        $film->genre = $request->genre;
        $film->durasi = $request->durasi;
        $film->tanggal_tayang = $request->tanggal_tayang;
        $film->sinopsis = $request->sinopsis;

        $film->save();

        return redirect()
            ->route('films.index')
            ->with('success','Film berhasil diupdate');
    }

    public function destroy(Film $film)
    {
        if($film->poster)
        {
            Storage::disk('public')
                ->delete($film->poster);
        }

        $film->delete();

        return redirect()
            ->route('films.index')
            ->with('success','Film berhasil dihapus');
    }
}