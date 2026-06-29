 @extends('layouts.app')

@section('title', 'Detail Film')

@section('content')
<div class="container my-5">
    
    <!-- Header Halaman + Tombol Aksi Cepat -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">🎬 Detail Informasi Film</h2>
            <p class="text-muted small mb-0">Pratinjau tampilan data film yang tersimpan di dalam sistem.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('films.index') }}" class="btn btn-outline-secondary px-3 py-2 rounded-3 shadow-sm text-decoration-none">
                ⬅️ Kembali
            </a>
            <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning px-3 py-2 rounded-3 shadow-sm text-dark fw-bold text-decoration-none">
                ✏️ Edit Film
            </a>
        </div>
    </div>

    <!-- Wrapper Card Utama -->
    <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4">
        <div class="row g-4 align-items-start">
            
            <!-- Kolom Kiri: Poster Film (Theater Style) -->
            <div class="col-md-4 text-center text-md-start">
                @if($film->poster)
                    <img src="{{ asset('storage/'.$film->poster) }}" 
                         alt="Poster {{ $film->judul }}" 
                         class="img-fluid rounded-4 shadow border w-100" 
                         style="max-height: 480px; object-fit: cover;">
                @else
                    <div class="bg-light rounded-4 d-flex flex-column align-items-center justify-content-center text-muted border text-center shadow-sm" 
                         style="min-height: 400px;">
                        <span class="fs-1 mb-2">📷</span>
                        <h6 class="fw-bold mb-0">Belum Ada Poster</h6>
                        <small class="text-muted">Gunakan menu edit untuk mengunggah</small>
                    </div>
                @endif
            </div>

            <!-- Kolom Kanan: Detail & Sinopsis -->
            <div class="col-md-8">
                <!-- Judul Film -->
                <h1 class="fw-black text-dark text-capitalize mb-3 display-6 font-monospace-heading fw-bold">
                    {{ $film->judul }}
                </h1>
                
                <!-- Kumpulan Informasi Ringkas (Meta Badges) -->
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill fw-semibold fs-7">
                        🎭 {{ $film->genre }}
                    </span>
                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-pill fw-semibold fs-7">
                        ⏱️ {{ $film->durasi }} Menit
                    </span>
                    <span class="badge bg-info-subtle text-info border border-info-subtle px-3 py-2 rounded-pill fw-semibold fs-7">
                        📅 Rilis: {{ date('d M Y', strtotime($film->tanggal_tayang)) }}
                    </span>
                </div>

                <hr class="text-muted opacity-25 my-4">

                <!-- Blok Sinopsis -->
                <div class="mb-3">
                    <h5 class="fw-bold text-dark d-flex align-items-center gap-2 mb-3">
                        <span>📄</span> Sinopsis Film
                    </h5>
                    <div class="p-3 bg-light rounded-4 border-0">
                        <p class="text-secondary lh-lg mb-0" style="text-align: justify; white-space: pre-line;">
                            {{ $film->sinopsis }}
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection