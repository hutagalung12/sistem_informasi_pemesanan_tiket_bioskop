@extends('layouts.app')

@section('title', 'Data Jadwal')

@section('content')

<div class="container-fluid py-4">

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0">
                <i class="fas fa-calendar-alt text-primary me-2"></i>Data Jadwal Tayang
            </h2>
            <small class="text-muted">
                Atur waktu penayangan film, studio, dan harga tiket bioskop
            </small>
        </div>
        <a href="{{ route('jadwals.create') }}" class="btn btn-primary shadow-sm px-4">
            <i class="fas fa-plus-circle me-2"></i>Tambah Jadwal
        </a>
    </div>

    {{-- Table Card Container --}}
    <div class="card shadow border-0">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">Rincian Jadwal Aktif</h5>
            <div class="input-group style-search" style="max-width: 300px;">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control bg-light border-start-0" id="searchJadwal" placeholder="Cari film atau studio...">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tableJadwal">
                    <thead class="table-light text-uppercase fs-7">
                        <tr>
                            <th class="ps-4" width="60">No</th>
                            <th>Film</th>
                            <th>Studio</th>
                            <th>Tanggal Tayang</th>
                            <th>Jam Mulai</th>
                            <th>Harga Tiket</th>
                            <th class="text-end pe-4" width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $jadwal)
                        <tr>
                            <td class="ps-4 fw-semibold text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    {{-- Kolom Poster Film --}}
                                    <div class="poster-thumbnail me-3 shadow-sm">
                                        @if($jadwal->film && $jadwal->film->poster)
                                            <img src="{{ asset('storage/' . $jadwal->film->poster) }}" alt="Poster {{ $jadwal->film->judul }}" class="w-100 h-100">
                                        @else
                                            <div class="w-100 h-100 bg-primary-light text-primary d-flex align-items-center justify-content-center">
                                                <i class="fas fa-film"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark d-block mb-0">{{ $jadwal->film->judul ?? 'Film Terhapus' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark px-2.5 py-1.5 fw-semibold border border-info-subtle">
                                    <i class="fas fa-door-open me-1"></i>{{ $jadwal->studio->nama_studio ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="text-dark fw-medium">
                                    <i class="far fa-calendar text-muted me-1.5"></i>
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y') }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-2.5 py-1.5 font-monospace fw-bold">
                                    <i class="far fa-clock text-primary me-1.5"></i>{{ substr($jadwal->jam_tayang, 0, 5) }} WIB
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-success">
                                    Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('jadwals.show', $jadwal->id) }}" class="btn btn-light btn-sm text-info border" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('jadwals.edit', $jadwal->id) }}" class="btn btn-light btn-sm text-warning border" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('jadwals.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-sm text-danger border" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal penayangan ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <div class="mb-2"><i class="fas fa-calendar-times fa-3x text-light-dark"></i></div>
                                <h6 class="fw-bold mb-1">Belum Ada Jadwal Tayang</h6>
                                <p class="small mb-0">Klik tombol "Tambah Jadwal" di atas untuk membuat jadwal baru.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<style>
.bg-primary-light { background-color: rgba(13, 110, 253, 0.08); }
.fs-7 { font-size: 0.825rem; letter-spacing: 0.5px; }

.card {
    border-radius: 12px;
    overflow: hidden;
}

/* Style baru untuk thumbnail poster agar proporsional tegak (portrait) */
.poster-thumbnail {
    width: 42px;
    height: 58px;
    border-radius: 6px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    background-color: #f8f9fa;
}

.poster-thumbnail img {
    object-fit: cover;
}

.table tbody tr {
    transition: background-color 0.15s ease;
}
.table tbody tr:hover {
    background-color: rgba(248, 249, 250, 0.85);
}

.btn-group .btn {
    padding: 0.375rem 0.6rem;
}
.btn-group .btn:hover {
    background-color: #f8f9fa;
}

.style-search .form-control:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
</style>

<script>
document.getElementById("searchJadwal").addEventListener("keyup", function(){
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableJadwal tbody tr");
    
    rows.forEach(function(row){
        if(row.cells.length > 1) {
            row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
        }
    });
});
</script>

@endsection