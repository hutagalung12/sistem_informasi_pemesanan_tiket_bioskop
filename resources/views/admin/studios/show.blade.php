@extends('layouts.app')

@section('title', 'Detail Studio')

@section('content')
<div class="container my-5">
    
    <!-- Header Halaman + Tombol Navigasi -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">🏢 Detail Informasi Studio</h2>
            <p class="text-muted small mb-0">Pratinjau spesifikasi dan kapasitas akomodasi tempat duduk studio.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('studios.index') }}" class="btn btn-outline-secondary px-3 py-2 rounded-3 shadow-sm text-decoration-none">
                ⬅️ Kembali
            </a>
            <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-warning px-3 py-2 rounded-3 shadow-sm text-dark fw-bold text-decoration-none">
                ✏️ Edit Studio
            </a>
        </div>
    </div>

    <!-- Wrapper Card Utama -->
    <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4">
        <div class="row align-items-center">
            
            <!-- Kolom Kiri: Ikon Ilustrasi Studio -->
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <div class="bg-light rounded-4 d-flex align-items-center justify-content-center mx-auto shadow-sm border border-light" 
                     style="width: 130px; height: 130px; font-size: 3.5rem;">
                    🏢
                </div>
            </div>

            <!-- Kolom Kanan: Detail Data -->
            <div class="col-md-9 text-center text-md-start">
                <!-- Nama Studio (Otomatis Kapital) -->
                <h3 class="fw-bold text-dark text-capitalize mb-2 display-6 font-monospace-heading">
                    {{ $studio->nama_studio }}
                </h3>
                
                <!-- Status & Kapasitas Badges -->
                <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2 mb-3">
                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-pill fw-semibold fs-7">
                        🪑 Total Kapasitas: {{ $studio->kapasitas }} Kursi
                    </span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold fs-7">
                        🟢 Status: Siap Operasional
                    </span>
                </div>
                
                <hr class="text-muted opacity-25 my-3 d-none d-md-block">

                <!-- Catatan Tambahan Minimalis -->
                <p class="text-muted small mb-0">
                    Studio ini telah dikonfigurasi dengan tata letak kursi berundak untuk memastikan kenyamanan visual penonton serta didukung oleh sistem audio teater standar.
                </p>
            </div>

        </div>
    </div>
</div>
@endsection