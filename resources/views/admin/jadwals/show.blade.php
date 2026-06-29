@extends('layouts.app')

@section('title', 'Detail Jadwal')

@section('content')

<div class="container py-4">
    {{-- Header --}}
    <div class="mb-4">
        <h2 class="fw-bold m-0 text-dark">
            <i class="fas fa-info-circle text-info me-2"></i>Detail Jadwal Tayang
        </h2>
        <small class="text-muted">Informasi lengkap mengenai jadwal penayangan film</small>
    </div>

    <div class="card shadow border-0" style="border-radius: 12px; overflow: hidden;">
        <div class="card-header bg-info py-3 border-0">
            <h5 class="mb-0 fw-bold text-white"><i class="fas fa-receipt me-2"></i>Rincian Jadwal</h5>
        </div>

        <div class="card-body p-4">
            <div class="row g-4">
                {{-- Bagian Poster Film --}}
                <div class="col-md-4 col-lg-3 text-center text-md-start">
                    <div class="poster-preview shadow-sm border mx-auto mx-md-0" style="width: 100%; max-width: 200px; height: 280px; border-radius: 8px; overflow: hidden; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center;">
                        @if($jadwal->film && $jadwal->film->poster)
                            <img src="{{ asset('storage/' . $jadwal->film->poster) }}" alt="Poster {{ $jadwal->film->judul }}" class="w-100 h-100" style="object-fit: cover;">
                        @else
                            <div class="text-muted text-center p-3">
                                <i class="fas fa-film fa-3x mb-2 text-secondary"></i>
                                <p class="small mb-0">Tidak ada poster</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Bagian Informasi Detail --}}
                <div class="col-md-8 col-lg-9">
                    <table class="table table-borderless align-middle fs-6">
                        <tbody>
                            <tr>
                                <td width="150" class="text-muted fw-semibold">Judul Film</td>
                                <td width="20" class="text-muted">:</td>
                                <td class="fw-bold text-dark fs-5">{{ $jadwal->film->judul ?? 'Film Terhapus' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Studio</td>
                                <td class="text-muted">:</td>
                                <td>
                                    <span class="badge bg-info text-dark px-2.5 py-1.5 fw-semibold border border-info-subtle">
                                        <i class="fas fa-door-open me-1"></i>{{ $jadwal->studio->nama_studio ?? 'N/A' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Tanggal Tayang</td>
                                <td class="text-muted">:</td>
                                <td class="text-dark fw-medium">
                                    <i class="far fa-calendar text-muted me-1.5"></i>
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Jam Mulai</td>
                                <td class="text-muted">:</td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2.5 py-1.5 font-monospace fw-bold">
                                        <i class="far fa-clock text-primary me-1.5"></i>{{ substr($jadwal->jam_tayang, 0, 5) }} WIB
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-semibold">Harga Tiket</td>
                                <td class="text-muted">:</td>
                                <td class="fw-bold text-success fs-5">
                                    Rp {{ number_format($jadwal->harga_tiket ?? $jadwal->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr class="text-muted my-4">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('jadwals.index') }}" class="btn btn-light border shadow-sm px-4">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="{{ route('jadwals.edit', $jadwal->id) }}" class="btn btn-warning shadow-sm px-4 text-dark fw-semibold">
                            <i class="fas fa-edit me-2"></i>Edit Jadwal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection