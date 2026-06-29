@extends('layouts.app')

@section('title', 'Tambah Film')

@section('content')
<div class="container my-5">
    
    <!-- Header Halaman + Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">➕ Tambah Film Baru</h2>
            <p class="text-muted small mb-0">Masukkan detail informasi, sinopsis, dan unggah poster untuk menambahkan film baru.</p>
        </div>
        <a href="{{ route('films.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 shadow-sm text-decoration-none">
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

            <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <!-- Kolom Kiri: Formulir Detail Film -->
                    <div class="col-lg-8">
                        
                        <!-- Input Judul -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Judul Film</label>
                            <input type="text" 
                                   name="judul" 
                                   class="form-control form-control-lg rounded-3 @error('judul') is-invalid @enderror" 
                                   value="{{ old('judul') }}" 
                                   placeholder="Masukkan judul film"
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
                                       value="{{ old('genre') }}" 
                                       placeholder="Contoh: Aksi, Drama, Komedi"
                                       required>
                                @error('genre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold text-secondary">Durasi</label>
                                <div class="input-group">
                                    <input type="number" 
                                           name="durasi" 
                                           class="form-control form-control-lg rounded-start-3 @error('durasi') is-invalid @enderror" 
                                           value="{{ old('durasi') }}" 
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
                                   value="{{ old('tanggal_tayang') }}" 
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
                                      placeholder="Tulis ringkasan alur cerita film di sini..."
                                      required>{{ old('sinopsis') }}</textarea>
                            @error('sinopsis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Kolom Kanan: Area Unggah Poster -->
                    <div class="col-lg-4 border-start-lg border-light ps-lg-4">
                        <div class="p-3 bg-light rounded-4 border border-dashed text-center h-100 d-flex flex-column justify-content-between">
                            <div>
                                <label class="form-label d-block fw-semibold text-dark mb-3">🖼️ Poster Film</label>
                                
                                <!-- Placeholder Slot Sebelum Gambar Diunggah -->
                                <div class="mb-3">
                                    <div class="border rounded-3 p-5 bg-white text-muted shadow-sm d-flex flex-column align-items-center justify-content-center" 
                                         style="min-height: 260px;">
                                        <span class="fs-1 d-block mb-2 text-primary">📂</span>
                                        <small class="fw-medium text-dark d-block">Siap Menerima File</small>
                                        <span class="fs-7 text-muted mt-1">Belum ada gambar yang dipilih</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Input Pilih File -->
                            <div class="text-start mt-3">
                                <label class="form-label small fw-semibold text-secondary">Pilih File Gambar</label>
                                <input type="file" 
                                       name="poster" 
                                       class="form-control @error('poster') is-invalid @enderror" 
                                       accept="image/*"
                                       required>
                                <small class="text-muted fs-7 d-block mt-1">Format wajib: JPG, JPEG, atau PNG (Maks. 2MB).</small>
                                @error('poster')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Form: Tombol Aksi -->
                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-5 py-2.5 rounded-3 fw-bold shadow-sm">
                        🚀 Simpan Katalog Film
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection