@extends('layouts.app')

@section('title','Dashboard Pelanggan')

@section('content')

<style>
    body {
        background: #eef2f7;
        font-family: 'Poppins', sans-serif;
        transition: background 0.3s, color 0.3s;
    }

    .wrapper {
        display: flex;
    }

    /* ====================== SIDEBAR ====================== */
    .sidebar {
        width: 260px;
        min-height: 100vh;
        background: #111827;
        position: fixed;
        left: 0;
        top: 0;
        color: white;
        z-index: 1000;
    }

    .logo {
        padding: 25px;
        text-align: center;
    }

    .logo h2 {
        color: #FFD54F;
        font-weight: bold;
        margin-bottom: 0;
    }

    .logo p {
        color: #aaa;
        margin-bottom: 0;
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 15px 25px;
        text-decoration: none;
        transition: .3s;
    }

    .sidebar a:hover {
        background: #1f2937;
        color: #FFD54F;
        padding-left: 35px;
    }

    .sidebar i {
        width: 25px;
    }

    /* ====================== CONTENT ====================== */
    .content {
        margin-left: 260px;
        width: 100%;
        padding: 30px;
        min-height: 100vh;
    }

    /* ====================== TOPBAR ====================== */
    .topbar {
        background: white;
        border-radius: 15px;
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 25px rgba(0,0,0,.04);
        margin-bottom: 30px;
    }

    .search-container {
        width: 400px;
    }

    .search-container .input-group {
        margin-bottom: 0 !important;
    }

    .search-container input {
        border-radius: 50px 0 0 50px !important;
    }

    .search-container button {
        border-radius: 0 50px 50px 0 !important;
    }

    /* ====================== USER ====================== */
    .user {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* ====================== BANNER ====================== */
    .banner {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        border-radius: 25px;
        padding: 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
        overflow: hidden;
        margin-bottom: 35px;
    }

    .banner h1 {
        font-weight: bold;
    }

    /* ====================== SECTION & CARDS ====================== */
    .section-title {
        margin-top: 15px;
        margin-bottom: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .movie-scroll {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding-bottom: 15px;
        margin-bottom: 35px;
    }

    .movie-scroll::-webkit-scrollbar {
        height: 8px;
    }

    .movie-scroll::-webkit-scrollbar-thumb {
        background: #2563eb;
        border-radius: 20px;
    }

    .movie-card {
        min-width: 220px;
        max-width: 220px;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0,0,0,.05);
        transition: transform 0.35s, box-shadow 0.35s;
        border: none;
    }

    .movie-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,.15);
    }

    .movie-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .movie-card .body {
        padding: 15px;
    }

    .badge-genre {
        background: rgba(37, 99, 235, 0.1);
        color: #2563eb;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .stat-user {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(0,0,0,.05);
        transition: transform 0.3s;
    }
    
    .stat-user:hover {
        transform: translateY(-5px);
    }

    footer {
        padding: 30px 0;
    }

    /* ====================== DARK MODE STYLES ====================== */
    .dark-mode {
        background: #0f172a !important;
        color: #f8fafc !important;
    }

    .dark-mode .topbar,
    .dark-mode .card,
    .dark-mode .movie-card {
        background: #1e293b !important;
        color: #f8fafc !important;
    }

    .dark-mode .text-muted {
        color: #94a3b8 !important;
    }

    .dark-mode .banner {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        border: 1px solid #334155;
    }

    .dark-mode input {
        background: #334155 !important;
        border-color: #475569 !important;
        color: white !important;
    }
    
    .dark-mode input::placeholder {
        color: #94a3b8;
    }

    /* ====================== RESPONSIVE ====================== */
    @media(max-width: 992px) {
        .wrapper {
            flex-direction: column;
        }
        .sidebar {
            position: relative;
            width: 100%;
            min-height: auto;
        }
        .content {
            margin-left: 0;
            padding: 20px;
        }
        .banner {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }
        .banner img {
            width: 150px;
        }
        .movie-scroll {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
        .movie-card {
            min-width: unset;
            max-width: unset;
        }
    }

    @media(max-width: 768px) {
        .topbar {
            flex-direction: column-reverse;
            gap: 15px;
            align-items: stretch;
        }
        .search-container {
            width: 100%;
        }
        .user {
            justify-content: flex-start;
        }
    }
</style>

<div class="wrapper">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            <h2>🎬 TGS CINEMA</h2>
            <p>Pelanggan</p>
        </div>
        <hr class="text-secondary">
        <a href="{{ route('pelanggan.dashboard') }}">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('pelanggan.jadwal') }}">
            <i class="fas fa-film"></i> Jadwal Tayang
        </a>
        <a href="{{ route('riwayat') }}">
            <i class="fas fa-ticket"></i> Riwayat Tiket
        </a>
        <div class="p-3 mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100 rounded-pill">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        
        <!-- TOPBAR -->
        <div class="topbar">
            <div class="search-container">
                <form action="{{ route('pelanggan.dashboard') }}" method="GET" class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari film favoritmu..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="user">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=2563eb&color=fff" alt="User Avatar">
                <div>
                    <h6 class="mb-0 fw-bold">{{ auth()->user()->name }}</h6>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
            </div>
        </div>

        <!-- BANNER -->
        <div class="banner">
            <div>
                <h1>🍿 Selamat Datang!</h1>
                <p>Nikmati pengalaman menonton terbaik bersama TGS Cinema. Pesan tiket pilihanmu secara instan dan tanpa antre.</p>
                <a href="{{ route('pelanggan.jadwal') }}" class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm">
                    🎟 Pesan Tiket Sekarang
                </a>
            </div>
            <img src="https://cdn-icons-png.flaticon.com/512/3418/3418886.png" alt="Cinema Icon">
        </div>

        <!-- SEDANG TAYANG -->
        <h3 class="section-title">🎬 Film Populer</h3>
        <div class="movie-scroll">
            @forelse($films as $film)
                <div class="movie-card">
                    <img src="{{ $film->poster ? asset('storage/'.$film->poster) : 'https://placehold.co/300x450?text=No+Poster' }}" alt="{{ $film->judul }}">
                    <div class="body">
                        <h6 class="fw-bold text-truncate" title="{{ $film->judul }}">{{ $film->judul }}</h6>
                        <span class="badge-genre mb-2">{{ $film->genre }}</span>
                        <div class="text-muted small mt-2">
                            <i class="fas fa-clock me-1"></i> {{ $film->durasi }} Menit
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-muted p-3">Tidak ada film yang sedang tayang.</div>
            @endforelse
        </div>

        <!-- JADWAL TAYANG HARI INI -->
        <h3 class="section-title">📅 Jadwal Tayang Hari Ini</h3>
        <div class="row">
            @forelse($jadwals as $jadwal)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    <div class="card movie-card h-100 shadow-sm">
                        <img src="{{ $jadwal->film->poster ? asset('storage/'.$jadwal->film->poster) : 'https://placehold.co/400x550?text=No+Poster' }}" alt="{{ $jadwal->film->judul }}">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="fw-bold text-truncate" title="{{ $jadwal->film->judul }}">{{ $jadwal->film->judul }}</h5>
                                <p class="text-muted small mb-2">
                                    <i class="fas fa-building text-primary me-2"></i>Studio {{ $jadwal->studio->nama_studio }}
                                </p>
                                <p class="text-muted small mb-2">
                                    <i class="fas fa-calendar text-danger me-2"></i>{{ $jadwal->tanggal }}
                                </p>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-clock text-success me-2"></i>{{ $jadwal->jam_tayang }}
                                </p>
                            </div>
                            <div>
                                <h5 class="fw-bold text-danger mb-3">Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}</h5>
                                <a href="{{ route('pesan.create', $jadwal->id) }}" class="btn btn-warning w-100 rounded-pill fw-bold shadow-sm">
                                    <i class="fas fa-ticket-alt me-1"></i> Pesan Tiket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-muted ps-3">Belum ada jadwal penayangan untuk hari ini.</div>
            @endforelse
        </div>

        <!-- MENU CEPAT -->
        <h3 class="section-title">⚡ Menu Cepat</h3>
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 rounded-4 stat-user">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-film fa-2x text-primary mb-3"></i>
                        <h5>Sedang Tayang</h5>
                        <p class="text-muted small">Lihat daftar film terbaru yang bisa kamu tonton.</p>
                        <a href="{{ route('pelanggan.jadwal') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Lihat Film</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 rounded-4 stat-user">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-ticket-alt fa-2x text-warning mb-3"></i>
                        <h5>Pesan Tiket</h5>
                        <p class="text-muted small">Pilih jadwal serta kursi ternyaman favoritmu.</p>
                        <a href="{{ route('pelanggan.jadwal') }}" class="btn btn-outline-warning btn-sm rounded-pill px-3">Pesan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 rounded-4 stat-user">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-history fa-2x text-success mb-3"></i>
                        <h5>Riwayat Tiket</h5>
                        <p class="text-muted small">Cek kembali tiket lama atau tiket aktifmu.</p>
                        <a href="{{ route('riwayat') }}" class="btn btn-outline-success btn-sm rounded-pill px-3">Riwayat</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- AKTIVITAS SAYA -->
        <h3 class="section-title">📊 Aktivitas Saya</h3>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card stat-user bg-primary text-white">
                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                        <div>
                            <p class="mb-1 opacity-75">Total Tiket Dibeli</p>
                            <h2 class="fw-bold mb-0">{{ $riwayat ?? 0 }}</h2>
                        </div>
                        <i class="fas fa-ticket-alt fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stat-user bg-success text-white">
                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                        <div>
                            <p class="mb-1 opacity-75">Film Tersedia</p>
                            <h2 class="fw-bold mb-0">{{ $films->count() }}</h2>
                        </div>
                        <i class="fas fa-film fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card stat-user bg-danger text-white">
                    <div class="card-body d-flex align-items-center justify-content-between p-4">
                        <div>
                            <p class="mb-1 opacity-75">Jadwal Hari Ini</p>
                            <h2 class="fw-bold mb-0">{{ $jadwals->count() }}</h2>
                        </div>
                        <i class="fas fa-calendar-alt fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="mt-5">
            <hr class="text-secondary">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="fw-bold mb-1">🎬 TGS CINEMA</h5>
                    <p class="text-muted small mb-0">Nikmati pengalaman menonton terbaik bersama kami.</p>
                </div>
                <div>
                    <a href="#" class="btn btn-outline-dark btn-sm rounded-circle me-2 social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-danger btn-sm rounded-circle me-2 social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-circle social-icon"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
            <hr class="text-secondary">
            <p class="text-center text-muted small">© {{ date('Y') }} TGS Cinema | All Rights Reserved</p>
        </footer>

        <!-- DARK MODE BUTTON -->
        <button id="darkBtn" class="btn btn-dark position-fixed shadow-lg" style="right: 25px; bottom: 25px; border-radius: 50%; width: 55px; height: 55px; z-index: 999; font-size: 20px;">
            🌙
        </button>

    </div>
</div>

<script>
    const btn = document.getElementById('darkBtn');
    
    if(localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        btn.innerHTML = "☀️";
    }

    btn.onclick = function() {
        document.body.classList.toggle('dark-mode');
        if(document.body.classList.contains('dark-mode')){
            btn.innerHTML = "☀️";
            localStorage.setItem('theme', 'dark');
        } else {
            btn.innerHTML = "🌙";
            localStorage.setItem('theme', 'light');
        }
    }
</script>

@endsection