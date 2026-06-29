@extends('layouts.app')

@section('title', 'Data Film')

@section('content')
<div class="container my-5">

    <!-- Section Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">🎬 Data Film</h2>
            <p class="text-muted small mb-0">Kelola katalog film, genre, poster, dan durasi tayang di sini.</p>
        </div>
        <a href="{{ route('films.create') }}" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm d-flex align-items-center gap-2">
            Tambah Film
        </a>
    </div>

    <!-- Notifikasi Sukses Berdesain Bersih -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-center">
                <span class="me-2">✅</span>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Wrapper Card untuk Efek Dashboard Modern -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light border-bottom text-uppercase fs-7 fw-semibold text-secondary">
                    <tr>
                        <th class="ps-4 py-3" style="width: 70px;">No</th>
                        <th class="py-3" style="width: 110px;">Poster</th>
                        <th class="py-3">Judul Film</th>
                        <th class="py-3">Genre</th>
                        <th class="py-3">Durasi</th>
                        <th class="py-3 text-center" style="width: 240px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($films as $film)
                    <tr>
                        <!-- Nomor -->
                        <td class="ps-4 fw-medium text-secondary">{{ $loop->iteration }}</td>
                        
                        <!-- Poster dengan Efek Lembut -->
                        <td>
                            @if($film->poster)
                                <img src="{{ asset('storage/'.$film->poster) }}" 
                                     alt="Poster {{ $film->judul }}"
                                     class="rounded-3 shadow-sm border" 
                                     style="width: 70px; height: 95px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted border text-center" 
                                     style="width: 70px; height: 95px; font-size: 0.75rem;">
                                    Tidak ada<br>Poster
                                </div>
                            @endif
                        </td>
                        
                        <!-- Judul (Otomatis Kapital di Awal Kata) -->
                        <td>
                            <span class="fw-bold text-dark text-capitalize fs-6">{{ $film->judul }}</span>
                        </td>
                        
                        <!-- Genre Berbentuk Badge -->
                        <td>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-semibold">
                                {{ $film->genre }}
                            </span>
                        </td>
                        
                        <!-- Durasi -->
                        <td>
                            <span class="text-secondary fw-medium">⏱️ {{ $film->durasi }} Menit</span>
                        </td>
                        
                        <!-- Tombol Aksi yang Rapi -->
                        <td class="text-center pe-3">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('films.show', $film->id) }}" 
                                   class="btn btn-outline-info btn-sm rounded-2 px-3 fw-medium">
                                    Detail
                                </a>
                                <a href="{{ route('films.edit', $film->id) }}" 
                                   class="btn btn-outline-warning btn-sm rounded-2 px-3 fw-medium">
                                    Edit
                                </a>
                                <form action="{{ route('films.destroy', $film->id) }}" 
                                      method="POST" 
                                      style="display:inline"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus film ini?')">
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
                    <!-- State jika data film masih kosong -->
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <div class="mb-2 fs-2">🎬</div>
                            <h6 class="fw-bold text-dark">Belum ada data film</h6>
                            <p class="small mb-0">Klik tombol "Tambah Film" di atas untuk menambahkan data baru.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection