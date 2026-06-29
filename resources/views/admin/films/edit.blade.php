@extends('layouts.app')

@section('title', 'Edit Film')

@section('content')
<div class="container my-5">
    
    <!-- Header Halaman + Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">✏️ Edit Film</h2>
            <p class="text-muted small mb-0">Perbarui informasi, sinopsis, atau ubah poster film secara berkala.</p>
        </div>
        <a href="{{ route('films.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 shadow-sm text-decoration-none">
            ⬅️ Kembali
        </a>
    </div>

    <!-- Wrapper Card Utama -->
    <div class="card border-0 shadow-sm rounded-4 p-2 p-md-4">
        <div class="card-body">

            <!-- Notifikasi Error Global (Opsional jika ingin tetap dipertahankan) -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
                    <strong class="d-block mb-1">⚠️ Periksa kembali data yang diisi:</strong>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('films.update', $film->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <!-- Kolom Kiri: Detail Informasi Film -->
                    <div class="col-lg-8">
                        
                        <!-- Input Judul -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Judul Film</label>
                            <input type="text" 
                                   name="judul" 
                                   class="form-control form-control-lg rounded-3 @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul', $film->judul) }}" 
                                   placeholder="Masukkan judul lengkap film"
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Baris untuk Genre dan Durasi -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Genre</label>
                                <input type="text" 
                                       name="genre" 
                                       class="form-control form-control-lg rounded-3 @error('genre') is-invalid @enderror" 
                                       value="{{ old('genre', $film->genre) }}" 
                                       placeholder="Contoh: Horor, Komedi, Drama"
                                       required>
                                @error('genre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Durasi (Menit)</label>
                                <div class="input-group">
                                    <input type="number" 
                                           name="durasi" 
                                           class="form-control form-control-lg rounded-start-3 @error('durasi') is-invalid @enderror" 
                                           value="{{ old('durasi', $film->durasi) }}" 
                                           placeholder="120"
                                           required>
                                    <span class="input-group-text bg-light border-start-0 rounded-end-3 text-muted">Menit</span>
                                </div>
                                @error('durasi')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Input Tanggal Tayang -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Tanggal Tayang</label>
                            <input type="date" 
                                   name="tanggal_tayang" 
                                   class="form-control form-control-lg rounded-3 @error('tanggal_tayang') is-invalid @enderror" 
                                   value="{{ old('tanggal_tayang', $film->tanggal_tayang) }}" 
                                   required>
                            @error('tanggal_tayang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Sinopsis -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Sinopsis Film</label>
                            <textarea name="sinopsis" 
                                      rows="5" 
                                      class="form-control rounded-3 @error('sinopsis') is-invalid @enderror" 
                                      placeholder="Tuliskan jalan cerita singkat film di sini..."
                                      required>{{ old('sinopsis', $film->sinopsis) }}</textarea>
                            @error('sinopsis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Kolom Kanan: Manajemen Poster -->
                    <div class="col-lg-4 border-start-lg border-light ps-lg-4">
                        <div class="p-3 bg-light rounded-4 border border-dashed text-center h-100 d-flex flex-column justify-content-between">
                            <div>
                                <label class="form-label d-block fw-semibold text-dark mb-3">🖼️ Poster Film</label>
                                
                                <!-- Area Preview Poster Saat Ini -->
                                <div class="mb-3">
                                    @if($film->poster)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('storage/'.$film->poster) }}" 
                                                 alt="Poster Saat Ini" 
                                                 class="img-fluid rounded-3 shadow-sm border" 
                                                 style="max-height: 260px; object-fit: cover;">
                                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-dark shadow">
                                                Poster Aktif
                                            </span>
                                        </div>
                                    @else
                                        <div class="border rounded-3 p-5 bg-white text-muted shadow-sm">
                                            <span class="fs-1 d-block mb-2">📷</span>
                                            <small class="d-block">Belum ada poster</small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Input Ganti Poster Baru -->
                            <div class="text-start mt-3">
                                <label class="form-label small fw-semibold text-secondary">Ganti File Poster</label>
                                <input type="file" 
                                       name="poster" 
                                       class="form-control @error('poster') is-invalid @enderror" 
                                       accept="image/*">
                                <small class="text-muted fs-7 d-block mt-1">Format: JPG, PNG. Maksimal 2MB.</small>
                                @error('poster')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Form: Aksi Tombol -->
                <div class="border-top pt-4 mt-4 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-warning px-5 py-2.5 rounded-3 fw-bold shadow-sm text-dark">
                        💾 Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection