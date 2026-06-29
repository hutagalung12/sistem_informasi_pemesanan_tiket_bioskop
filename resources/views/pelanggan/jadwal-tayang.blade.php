@extends('layouts.app')

@section('title','Jadwal Tayang')

@section('content')

<style>
body{
    background:#eef3fb;
}

.page-title{
    font-size:40px;
    font-weight:bold;
}

.movie-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    transition:.3s;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    background:white;
}

.movie-card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.movie-poster{
    height:330px;
    object-fit:cover;
    width:100%;
}

.price{
    font-size:25px;
    color:#f59e0b;
    font-weight:bold;
}

.btn-ticket{
    border-radius:30px;
    font-weight:bold;
    background:#ffc107;
    border:none;
}

.btn-ticket:hover{
    background:#ffb300;
}

.icon{
    width:22px;
    display:inline-block;
    color:#2563eb;
}
</style>

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="page-title">
📅 Jadwal Tayang
</h2>

<p class="text-muted">
Pilih film favoritmu dan pesan tiket sekarang.
</p>

</div>

<div class="col-md-4">

<input
type="text"
class="form-control rounded-pill"
placeholder="🔍 Cari film...">

</div>

</div>

<div class="row">

@forelse($jadwals as $jadwal)

<div class="col-lg-3 col-md-6 mb-4">

<div class="card movie-card">

@if($jadwal->film->poster)

<img
src="{{ asset('storage/'.$jadwal->film->poster) }}"
class="movie-poster">

@else

<img
src="https://placehold.co/300x420?text=No+Poster"
class="movie-poster">

@endif

<div class="card-body">

<h4 class="fw-bold">

{{ $jadwal->film->judul }}

</h4>

<p class="mb-2">

<span class="icon">🏢</span>

Studio {{ $jadwal->studio->nama_studio }}

</p>

<p class="mb-2">

<span class="icon">📅</span>

{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}

</p>

<p class="mb-2">

<span class="icon">🕒</span>

{{ $jadwal->jam_tayang }}

</p>

<p class="price">

Rp {{ number_format($jadwal->harga_tiket,0,',','.') }}

</p>

<a
href="{{ route('pesan.create',$jadwal->id) }}"
class="btn btn-warning btn-ticket w-100">

🎟 Pesan Tiket

</a>

</div>

</div>

</div>

@empty

<div class="col-12">

<div class="alert alert-warning">

Belum ada jadwal tayang.

</div>

</div>

@endforelse

</div>

</div>

@endsection