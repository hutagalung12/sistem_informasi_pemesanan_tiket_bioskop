@extends('layouts.app')

@section('title','Data Kursi')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold m-0">
                <i class="fas fa-couch text-primary me-2"></i>Data Kursi
            </h2>
            <small class="text-muted">
                Kelola seluruh kursi bioskop dan pantau keterisiannya
            </small>
        </div>
        <a href="{{ route('kursis.create') }}" class="btn btn-primary shadow-sm px-4">
            <i class="fas fa-plus-circle me-2"></i>Tambah Kursi
        </a>
    </div>

    {{-- Main Layout (Bagi menjadi Kiri dan Kanan) --}}
    <div class="row">
        
        {{-- Sisi Kiri: Denah Layout Kursi Per Studio --}}
        <div class="col-lg-5 mb-4">
            @php
                // Kelompokkan data kursi berdasarkan studio_id agar tidak bercampur
                $kursisPerStudio = $kursis->groupBy('studio_id');
            @endphp

            @forelse($kursisPerStudio as $studioId => $kursiStudio)
                @php
                    $namaStudio = $kursiStudio->first()->studio->nama_studio ?? 'Studio ' . $studioId;
                    
                    // Kelompokkan kursi di studio ini berdasarkan huruf depannya (Baris A, B, C)
                    $groupKursiBaris = $kursiStudio->groupBy(function($item){
                        return substr($item->nomor_kursi, 0, 1);
                    });
                @endphp

                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                        <h5 class="mb-0 fs-6">🎬 Layout {{ $namaStudio }}</h5>
                        <span class="badge bg-primary">{{ $kursiStudio->count() }} Kursi</span>
                    </div>
                    <div class="card-body">
                        <div class="screen text-center">LAYAR {{ strtoupper($namaStudio) }}</div>

                        <div class="cinema-seats mb-3">
                            @foreach($groupKursiBaris as $baris => $kursiBaris)
                                <div class="seat-row">
                                    <span class="row-label">{{ $baris }}</span>
                                    <div class="seats-container">
                                        @foreach($kursiBaris as $kursi)
                                            <a href="{{ route('kursis.edit', $kursi->id) }}" class="seat-link" title="Edit Kursi {{ $kursi->nomor_kursi }}">
                                                <div class="seat {{ $kursi->status == 'kosong' ? 'available' : 'occupied' }}">
                                                    {{ $kursi->nomor_kursi }}
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Legend Ringkas per Studio --}}
                        <div class="legend border-top pt-2 d-flex justify-content-center gap-3">
                            <div class="legend-item">
                                <div class="seat-demo available" style="width:12px; height:12px;"></div>
                                <span style="font-size: 0.8rem;">Kosong ({{ $kursiStudio->where('status','kosong')->count() }})</span>
                            </div>
                            <div class="legend-item">
                                <div class="seat-demo occupied" style="width:12px; height:12px;"></div>
                                <span style="font-size: 0.8rem;">Terisi ({{ $kursiStudio->where('status','terisi')->count() }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow border-0 mb-4">
                    <div class="card-body text-center py-4 text-muted">
                        <i class="fas fa-info-circle fa-2x mb-2"></i>
                        <p class="mb-0">Belum ada data kursi yang ditambahkan.</p>
                    </div>
                </div>
            @endforelse
        </div>

        {{-- Sisi Kanan: Statistik Ringkas & Tabel Rincian Data --}}
        <div class="col-lg-7 mb-4">
            
            {{-- Atas: Card Statistik Grid --}}
            <div class="row g-3 mb-4">
                {{-- Total Kursi --}}
                <div class="col-sm-6">
                    <div class="card shadow border-0 card-stat">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block mb-1">Total Kursi (Semua)</small>
                                <h3 class="fw-bold mb-0">{{ $kursis->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-light text-primary">
                                <i class="fas fa-chair fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kursi Kosong --}}
                <div class="col-sm-6">
                    <div class="card shadow border-0 card-stat">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block mb-1">Total Kursi Kosong</small>
                                <h3 class="fw-bold text-success mb-0">{{ $kursis->where('status','kosong')->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-success-light text-success">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kursi Terisi --}}
                <div class="col-sm-6">
                    <div class="card shadow border-0 card-stat">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block mb-1">Total Kursi Terisi</small>
                                <h3 class="fw-bold text-danger mb-0">{{ $kursis->where('status','terisi')->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-light text-danger">
                                <i class="fas fa-times-circle fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Studio --}}
                <div class="col-sm-6">
                    <div class="card shadow border-0 card-stat">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block mb-1">Jumlah Studio</small>
                                <h3 class="fw-bold text-warning mb-0">{{ $kursis->pluck('studio_id')->unique()->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-light text-warning">
                                <i class="fas fa-film fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bawah: Tabel Rincian Kursi --}}
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3 border-0">
                    <div class="row align-items-center g-2">
                        <div class="col-md-5">
                            <h5 class="mb-0 fw-bold">Daftar Rincian Kursi</h5>
                        </div>
                        <div class="col-md-7">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                                <input type="text" class="form-control bg-light border-start-0" id="searchKursi" placeholder="Cari nomor kursi atau studio...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="tableKursi">
                            <thead class="table-light text-uppercase fs-7">
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Studio</th>
                                    <th>Nomor Kursi</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4" width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kursis as $kursi)
                                <tr>
                                    <td class="ps-4">{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-info text-dark px-2.5 py-1.5 fw-semibold">
                                            {{ $kursi->studio->nama_studio ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary px-2.5 py-1.5 fw-semibold">
                                            {{ $kursi->nomor_kursi }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($kursi->status == "kosong")
                                            <span class="badge bg-success-light text-success border border-success-subtle px-2.5 py-1.5">
                                                <i class="fas fa-circle fs-8 me-1 align-middle"></i> Kosong
                                            </span>
                                        @elseif($kursi->status == "terisi")
                                            <span class="badge bg-danger-light text-danger border border-danger-subtle px-2.5 py-1.5">
                                                <i class="fas fa-circle fs-8 me-1 align-middle"></i> Terisi
                                            </span>
                                        @else
                                            <span class="badge bg-warning-light text-warning border border-warning-subtle px-2.5 py-1.5">
                                                {{ ucfirst($kursi->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group">
                                            <a href="{{ route('kursis.edit', $kursi->id) }}" class="btn btn-light btn-sm text-warning border" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('kursis.destroy', $kursi->id) }}" method="POST" class="d-inline formDelete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-light btn-sm text-danger border" title="Hapus" onclick="return confirm('Yakin ingin menghapus kursi ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Utility CSS */
.bg-primary-light { background-color: rgba(13, 110, 253, 0.1); }
.bg-success-light { background-color: rgba(25, 135, 84, 0.1); }
.bg-danger-light  { background-color: rgba(220, 53, 69, 0.1); }
.bg-warning-light { background-color: rgba(255, 193, 7, 0.1); }
.fs-7 { font-size: 0.85rem; }
.fs-8 { font-size: 0.65rem; }

/* Dashboard UI Layout */
.card {
    border-radius: 12px;
    overflow: hidden;
}
.card-stat {
    transition: transform .2s ease;
}
.card-stat:hover {
    transform: translateY(-3px);
}
.stat-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Bioskop Screen & Seat Wrapper */
.screen {
    width: 90%;
    height: 32px;
    background: #e2e8f0;
    color: #4a5568;
    margin: 0 auto 30px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 700;
    letter-spacing: 5px;
    font-size: 0.85rem;
    border-radius: 4px;
    border-bottom: 3px solid #cbd5e1;
}
.cinema-seats {
    max-height: 360px;
    overflow-y: auto;
    padding-right: 4px;
}
.seat-row {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}
.row-label {
    width: 25px;
    font-weight: bold;
    font-size: 1rem;
    color: #4a5568;
}
.seats-container {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
}
.seat-link {
    text-decoration: none;
}
.seat {
    width: 36px;
    height: 36px;
    border-radius: 6px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 0.8rem;
    font-weight: bold;
    color: white;
    transition: all .2s;
}
.seat.available { background: #28a745; }
.seat.occupied { background: #dc3545; }
.seat:hover {
    transform: scale(1.15);
    box-shadow: 0 4px 6px rgba(0,0,0,0.15);
}

/* Keterangan Status Denah */
.legend {
    display: flex;
    justify-content: center;
    gap: 20px;
}
.legend-item {
    display: flex;
    align-items: center;
    gap: 6px;
}
.seat-demo {
    border-radius: 3px;
}
.seat-demo.available { background: #28a745; }
.seat-demo.occupied { background: #dc3545; }
</style>

<script>
document.getElementById("searchKursi").addEventListener("keyup", function(){
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableKursi tbody tr");
    
    rows.forEach(function(row){
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});
</script>

@endsection