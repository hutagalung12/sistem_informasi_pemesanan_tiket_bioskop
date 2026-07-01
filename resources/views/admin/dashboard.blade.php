@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<style>
body {
    background: linear-gradient(135deg, #eef2ff, #ffffff);
    font-family: 'Poppins', sans-serif;
}

.wrapper {
    display: flex;
}

.sidebar {
    width: 260px;
    min-height: 100vh;
    background: #111827;
    position: fixed;
    left: 0;
    top: 0;
    color: white;
    box-shadow: 5px 0 20px rgba(0,0,0,.2);
    z-index: 1000;
}

.logo {
    text-align: center;
    padding: 25px;
}

.logo h2 {
    color: #FFD54F;
    font-weight: bold;
    font-size: 22px;
}

.logo small {
    color: #bbb;
    letter-spacing: 1px;
}

.sidebar a {
    display: block;
    color: #cbd5e1;
    text-decoration: none;
    padding: 15px 25px;
    transition: .3s ease;
    font-size: 15px;
    font-weight: 500;
}

/* Menu aktif / hover */
.sidebar a:hover, .sidebar a.active {
    background: #1f2937;
    padding-left: 35px;
    color: #FFD54F;
}

.sidebar i {
    width: 25px;
}

.content {
    margin-left: 260px;
    width: calc(100% - 260px);
    padding: 30px;
}

.topbar {
    background: white;
    padding: 18px 30px;
    border-radius: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 30px rgba(0,0,0,.04);
}

.admin {
    display: flex;
    align-items: center;
    gap: 15px;
}

.admin img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
}

.hero {
    margin-top: 25px;
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 40px;
    border-radius: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
}

.hero h2 {
    font-weight: bold;
}

.hero img {
    width: 180px;
}

.stats {
    margin-top: 30px;
}

.stat-card {
    color: white;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 15px 25px rgba(0,0,0,.05);
    transition: .3s;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-card h2 {
    font-size: 38px;
    font-weight: bold;
    margin-top: 5px;
    margin-bottom: 0;
}

.blue { background: #2563eb; }
.green { background: #10b981; }
.orange { background: #f59e0b; }
.red { background: #ef4444; }

/* Custom Styling Tabel Transaksi agar presisi seperti gambar */
.table-custom thead {
    background-color: #0d6efd;
    color: white;
}
.table-custom thead th {
    padding: 14px 20px;
    font-weight: 600;
    border: none;
}
.table-custom thead th:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}
.table-custom thead th:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}
.table-custom tbody td {
    padding: 16px 20px;
    vertical-align: middle;
    color: #334155;
    font-weight: 500;
}
</style>

<div class="wrapper">

    {{-- SIDEBAR CONTAINER --}}
    <div class="sidebar">
        <div class="logo">
            <h2>🎬 TGS CINEMA</h2>
            <small>Administrator Panel</small>
        </div>
        <hr class="opacity-25 mx-3">

        <a href="{{ route('admin.dashboard') }}" class="active">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('films.index') }}">
            <i class="fas fa-film"></i> Data Film
        </a>
        <a href="{{ route('studios.index') }}">
            <i class="fas fa-building"></i> Studio
        </a>
        <a href="{{ route('jadwals.index') }}">
            <i class="fas fa-calendar-alt"></i> Jadwal
        </a>
        <a href="{{ route('kursis.index') }}">
            <i class="fas fa-chair"></i> Kursi
        </a>
        <a href="{{ route('users.index') }}">
            <i class="fas fa-users"></i> User
        </a>
        <a href="{{ route('laporan') }}">
            <i class="fas fa-chart-line"></i> Laporan
        </a>

        <div class="px-3 mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 border-0 text-start ps-3" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    {{-- MAIN CONTENT CONTAINER --}}
    <div class="content">
        
        {{-- TOPBAR --}}
        <div class="topbar">
            <div>
                <h3 class="fw-bold mb-0">Selamat Datang, {{ auth()->user()->name }} 👋</h3>
                <small class="text-muted">Administrator TGS Cinema</small>
            </div>
            
            <form action="{{ route('admin.dashboard') }}" method="GET" class="input-group w-35 mx-4" style="max-width: 400px;">
                <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" name="search" class="form-control bg-light border-start-0" placeholder="Cari Film..." value="{{ request('search') }}">
                <button class="btn btn-primary px-3">Cari</button>
            </form>

            <div class="admin">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff" alt="Avatar">
                <div>
                    <b class="text-dark d-block lh-sm">{{ auth()->user()->name }}</b>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
            </div>
        </div>

        {{-- HERO SECTION --}}
        <div class="hero">
            <div>
                <h2 class="mb-2">Dashboard Bioskop Modern</h2>
                <p class="opacity-75 mb-4">Kelola film, studio, jadwal dan transaksi pelanggan dalam satu dashboard terintegrasi.</p>
                <a href="{{ route('films.create') }}" class="btn btn-warning px-4 fw-bold shadow-sm text-dark">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Film
                </a>
            </div>
            <div>
                <img src="https://cdn-icons-png.flaticon.com/512/3418/3418886.png" alt="Cinema Icon">
            </div>
        </div>

        {{-- CARDS STATISTIK --}}
        <div class="row stats">
            <!-- TOTAL FILM -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card blue">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-film fa-2x opacity-75 mb-2"></i>
                            <h2>{{ $film }}</h2>
                            <small class="text-white-50 fw-medium">Total Film</small>
                        </div>
                        <i class="fas fa-film fa-4x opacity-25"></i>
                    </div>
                </div>
            </div>

            <!-- TOTAL STUDIO -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card green">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-building fa-2x opacity-75 mb-2"></i>
                            <h2>{{ $studio }}</h2>
                            <small class="text-white-50 fw-medium">Total Studio</small>
                        </div>
                        <i class="fas fa-city fa-4x opacity-25"></i>
                    </div>
                </div>
            </div>

            <!-- TOTAL JADWAL -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card orange">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-calendar-alt fa-2x opacity-75 mb-2"></i>
                            <h2>{{ $jadwal }}</h2>
                            <small class="text-white-50 fw-medium">Jadwal Tayang</small>
                        </div>
                        <i class="fas fa-clock fa-4x opacity-25"></i>
                    </div>
                </div>
            </div>

            <!-- TOTAL TIKET -->
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card red">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-ticket-alt fa-2x opacity-75 mb-2"></i>
                            <h2>{{ $pemesanan }}</h2>
                            <small class="text-white-50 fw-medium">Total Tiket</small>
                        </div>
                        <i class="fas fa-ticket fa-4x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>

       {{-- ROW FILM TERBARU & PROFIL --}}
<div class="row mt-2">
    <div class="col-lg-8 mb-4">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="mb-0 fw-bold text-dark">🎬 Film Populer</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- DI SINI PERBAIKANNYA: Menggunakan @forelse --}}
                    @forelse($films as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                            @if($item->poster)
                                <img src="{{ asset('storage/'.$item->poster) }}" class="card-img-top" style="height:260px; object-fit:cover;" alt="Poster">
                            @else
                                <img src="https://placehold.co/300x420?text=No+Poster" class="card-img-top" style="height:260px; object-fit:cover;" alt="No Poster">
                            @endif
                            <div class="card-body p-3">
                                <h6 class="fw-bold text-dark mb-1">{{ $item->judul }}</h6>
                                <span class="badge bg-primary mb-2 px-2 py-1 small">{{ $item->genre }}</span>
                                <p class="text-muted mt-1 mb-3" style="font-size:13px; line-height: 1.4;">
                                    {{ \Illuminate\Support\Str::limit($item->sinopsis, 75) }}
                                </p>
                                <div class="border-top pt-2 d-flex justify-content-between text-muted" style="font-size: 11px;">
                                    <span><i class="fas fa-clock text-warning me-1"></i>{{ $item->durasi }} Min</span>
                                    <span><i class="fas fa-calendar-alt text-success"></i> {{ \Carbon\Carbon::parse($item->tanggal_tayang)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Wajib ada @empty jika menggunakan @forelse --}}
                    @empty
                    <div class="col-12">
                        <div class="alert alert-light border text-center text-muted py-4 mb-0">
                            Belum ada data film yang ditambahkan.
                        </div>
                    </div>
                    {{-- Ditutup dengan @endforelse, bukan @endforeach --}}
                    @endforelse
                </div>
            </div>
        </div>
    </div>

            {{-- PROFIL ADMIN & MINI CHART --}}
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow rounded-4 text-center p-2 mb-4">
                    <div class="card-body">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff" width="90" class="rounded-circle mb-3 shadow-sm">
                        <h5 class="fw-bold text-dark mb-1">{{ auth()->user()->name }}</h5>
                        <p class="badge bg-secondary-light text-secondary px-3 py-1 mb-3">Administrator</p>
                        <hr class="opacity-25">
                        <div class="text-start px-2" style="font-size: 14px;">
                            <p class="mb-2 text-muted"><i class="fas fa-envelope text-primary me-2.5"></i>{{ auth()->user()->email }}</p>
                            <p class="mb-0 text-muted"><i class="fas fa-calendar-check text-success me-2.5"></i>{{ now()->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow rounded-4 p-2">
                    <div class="card-body">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-chart-pie text-primary me-2"></i>Proporsi Data</h6>
                        <div style="max-height: 220px; display: flex; justify-content: center;">
                            <canvas id="chartBioskop"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TRANSAKSI TERBARU --}}
        <div class="card shadow border-0 rounded-4 mt-2">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="mb-0 fw-bold text-dark">💳 Transaksi Terbaru</h5>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Film</th>
                                <th>Kursi</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemesanans as $item)
                            <tr>
                                <td class="fw-bold text-dark">{{ $item->user->name }}</td>
                                <td>{{ $item->jadwal->film->judul ?? 'N/A' }}</td>
                                <td>
                                    @if($item->detailPemesanans && $item->detailPemesanans->count())
                                        @foreach($item->detailPemesanans as $detail)
                                            <span class="badge bg-primary px-2 py-1.5 me-1">{{ $detail->kursi->nomor_kursi }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="fw-bold text-dark">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-success px-2.5 py-1.5 text-capitalize">
                                        <i class="fas fa-check-circle me-1"></i>{{ $item->status ?? 'dibayar' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('pemesanans.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light border btn-sm text-danger px-2.5" title="Hapus Transaksi">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada transaksi terekam saat ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="text-center mt-5 mb-2">
            <hr class="opacity-25">
            <small class="text-muted">© {{ date('Y') }} TGS CINEMA. All Rights Reserved.</small>
        </div>

    </div>
</div>

{{-- SCRIPT CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    new Chart(document.getElementById('chartBioskop'), {
        type: 'doughnut',
        data: {
            labels: ['Film', 'Studio', 'Jadwal', 'Pemesanan'],
            datasets: [{
                data: [{{ $film }}, {{ $studio }}, {{ $jadwal }}, {{ $pemesanan }}],
                backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#ef4444'],
                borderWidth: 2,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 12, font: { size: 12 } }
                }
            }
        }
    });
});
</script>

@endsection