@extends('layouts.app')

@section('title', 'Data Studio')

@section('content')
<div class="container my-5">

    <!-- Section Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">🏢 Data Studio</h2>
            <p class="text-muted small mb-0">Kelola daftar studio bioskop, kapasitas tempat duduk, dan kesiapan operasional.</p>
        </div>
        <a href="{{ route('studios.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
            Tambah Studio
        </a>
    </div>

    <!-- Notifikasi Sukses Berdesain Bersih -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4 rounded-3" role="alert">
            <div class="d-flex align-items-center">
                <span class="me-2">✅</span>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Wrapper Card Utama -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light border-bottom text-uppercase fs-7 fw-semibold text-secondary">
                    <tr>
                        <th class="ps-4 py-3" style="width: 80px;">No</th>
                        <th class="py-3">Nama Studio</th>
                        <th class="py-3">Kapasitas Tempat Duduk</th>
                        <th class="py-3 text-center" style="width: 240px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($studios as $studio)
                    <tr>
                        <!-- Nomor -->
                        <td class="ps-4 fw-medium text-secondary">{{ $loop->iteration }}</td>
                        
                        <!-- Nama Studio (Otomatis Kapital di Awal Kata) -->
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fs-5">🎬</span>
                                <span class="fw-bold text-dark text-capitalize fs-6">{{ $studio->nama_studio }}</span>
                            </div>
                        </td>
                        
                        <!-- Kapasitas dengan Desain Badge Badge -->
                        <td>
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-pill fw-semibold fs-7">
                                🪑 {{ $studio->kapasitas }} Kursi
                            </span>
                        </td>
                        
                        <!-- Tombol Aksi Outline Interaktif -->
                        <td class="text-center pe-3">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('studios.show', $studio->id) }}" 
                                   class="btn btn-outline-info btn-sm rounded-2 px-3 fw-medium">
                                    Detail
                                </a>
                                <a href="{{ route('studios.edit', $studio->id) }}" 
                                   class="btn btn-outline-warning btn-sm rounded-2 px-3 fw-medium">
                                    Edit
                                </a>
                                <form action="{{ route('studios.destroy', $studio->id) }}" 
                                      method="POST" 
                                      style="display:inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus studio ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-2 px-3 fw-medium">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <!-- State jika data studio kosong -->
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <div class="mb-2 fs-2">🏢</div>
                            <h6 class="fw-bold text-dark">Belum ada data studio</h6>
                            <p class="small mb-0">Klik tombol "Tambah Studio" di atas untuk memasukkan data baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection