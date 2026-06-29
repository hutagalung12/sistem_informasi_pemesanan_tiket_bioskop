@extends('layouts.app')

@section('title', 'Tambah Studio')

@section('content')
<div class="container my-5">
    
    <!-- Header Halaman + Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">➕ Tambah Studio Baru</h2>
            <p class="text-muted small mb-0">Daftarkan studio baru beserta total kapasitas kursi penonton ke dalam sistem.</p>
        </div>
        <a href="{{ route('studios.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 shadow-sm text-decoration-none">
            ⬅️ Kembali
        </a>
    </div>

    <!-- Wrapper Card Utama -->
    <div class="card border-0 shadow-sm rounded-4 p-2 p-md-4">
        <div class="card-body">

            <!-- Notifikasi Error Global -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                    <strong class="d-block mb-1">⚠️ Gagal menyimpan! Periksa kembali inputan Anda:</strong>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('studios.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- Input Nama Studio -->
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Nama Studio</label>
                            <input type="text" 
                                   name="nama_studio" 
                                   class="form-control form-control-lg rounded-3 @error('nama_studio') is-invalid @enderror" 
                                   value="{{ old('nama_studio') }}" 
                                   placeholder="Contoh: Studio 5, Studio VIP"
                                   required>
                            @error('nama_studio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Kapasitas dengan Satuan Kursi -->
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Kapasitas Tempat Duduk</label>
                            <div class="input-group">
                                <input type="number" 
                                       name="kapasitas" 
                                       class="form-control form-control-lg rounded-start-3 @error('kapasitas') is-invalid @enderror" 
                                       value="{{ old('kapasitas') }}" 
                                       placeholder="60"
                                       required>
                                <span class="input-group-text bg-light border-start-0 rounded-end-3 text-muted">🪑 Kursi</span>
                            </div>
                            @error('kapasitas')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Footer Form: Tombol Simpan -->
                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-5 py-2.5 rounded-3 fw-bold shadow-sm">
                        🚀 Simpan Studio
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection