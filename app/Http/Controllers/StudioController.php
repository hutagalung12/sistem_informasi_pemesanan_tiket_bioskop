<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::latest()->get();

        return view('admin.studios.index', compact('studios'));
    }

    public function create()
    {
        return view('admin.studios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_studio' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        Studio::create($request->all());

        return redirect()
            ->route('studios.index')
            ->with('success', 'Studio berhasil ditambahkan');
    }

    public function show(Studio $studio)
    {
        return view('admin.studios.show', compact('studio'));
    }

    public function edit(Studio $studio)
    {
        return view('admin.studios.edit', compact('studio'));
    }

    public function update(Request $request, Studio $studio)
    {
        $request->validate([
            'nama_studio' => 'required',
            'kapasitas' => 'required|numeric'
        ]);

        $studio->update($request->all());

        return redirect()
            ->route('studios.index')
            ->with('success', 'Studio berhasil diupdate');
    }

    public function destroy(Studio $studio)
    {
        $studio->delete();

        return redirect()
            ->route('studios.index')
            ->with('success', 'Studio berhasil dihapus');
    }
}