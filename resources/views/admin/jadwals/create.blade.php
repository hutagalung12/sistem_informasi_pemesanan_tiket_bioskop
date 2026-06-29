@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')

<div class="container py-4">
    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold m-0 text-dark">
            <i class="fas fa-plus-circle text-primary me-2"></i>Tambah Jadwal Tayang
        </h2>
        <small class="text-muted">Buat jadwal penayangan baru dengan menentukan film, studio, waktu, dan harga tiket</small>
    </div>

    <div class="card shadow border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-primary py-3 border-0">
            <h5 class="mb-0 fw-bold text-white"><i class="fas fa-calendar-plus me-2"></i>Formulir Jadwal Baru</h5>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('jadwals.store') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- Input Film --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-muted"><i class="fas fa-film me-1.5"></i>Film</label>
                        <select name="film_id" class="form-select form-control" required>
                            <option value="" disabled {{ old('film_id') ? '' : 'selected' }}>-- Pilih Film --</option>
                            @foreach($films as $film)
                                <option value="{{ $film->id }}" {{ old('film_id') == $film->id ? 'selected' : '' }}>
                                    {{ $film->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Studio --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold text-muted"><i class="fas fa-door-open me-1.5"></i>Studio</label>
                        <select name="studio_id" class="form-select form-control" required>
                            <option value="" disabled {{ old('studio_id') ? '' : 'selected' }}>-- Pilih Studio --</option>
                            @foreach($studios as $studio)
                                <option value="{{ $studio->id }}" {{ old('studio_id') == $studio->id ? 'selected' : '' }}>
                                    {{ $studio->nama_studio }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    {{-- Input Tanggal --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold text-muted"><i class="far fa-calendar me-1.5"></i>Tanggal Tayang</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control" required>
                    </div>

                    {{-- Input Jam --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold text-muted"><i class="far fa-clock me-1.5"></i>Jam Tayang</label>
                        <input type="time" name="jam_tayang" value="{{ old('jam_tayang') }}" class="form-control" required>
                    </div>

                    {{-- Input Harga --}}
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold text-muted"><i class="fas fa-money-bill-wave me-1.5"></i>Harga Tiket (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted">Rp</span>
                            <input type="number" name="harga_tiket" value="{{ old('harga_tiket') }}" class="form-control" placeholder="Contoh: 35000" required>
                        </div>
                    </div>
                </div>

                <hr class="text-muted my-4">

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('jadwals.index') }}" class="btn btn-light border shadow-sm px-4">
                        <i class="fas fa-arrow-left me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-success shadow-sm px-4 fw-semibold">
                        <i class="fas fa-check-circle me-2"></i>Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.form-control, .form-select {
    border-radius: 8px;
    padding: 0.6rem 0.75rem;
    border-color: #dee2e6;
}
.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
}
.input-group-text {
    border-radius: 8px 0 0 8px;
    border-color: #dee2e6;
}
.input-group .form-control {
    border-radius: 0 8px 8px 0;
}
</style>

@endsection