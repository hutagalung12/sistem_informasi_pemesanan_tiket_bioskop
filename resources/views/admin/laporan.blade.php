@extends('layouts.app')

@section('title','Laporan')

@section('content')

<div class="container mt-4">

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h2 class="fw-bold">
            📊 Laporan Pemesanan Tiket
        </h2>

        <p class="text-muted mb-0">
            Data seluruh transaksi pelanggan TGS Cinema
        </p>

    </div>

</div>

<hr>

<!-- SEARCH -->
<div class="card shadow border-0 rounded-4 mb-4">

    <div class="card-body">

        <form method="GET"
      action="{{ route('laporan') }}">

<div class="row">

<div class="col-md-5">

<input
type="text"
name="search"
class="form-control"
placeholder="Cari pelanggan / film..."
value="{{ request('search') }}">

</div>

<div class="col-md-3">

<input
type="date"
name="tanggal"
class="form-control"
value="{{ request('tanggal') }}">

</div>

<div class="col-md-2">

<button
class="btn btn-primary w-100">

Cari

</button>

</div>

<div class="col-md-2">

<a
href="{{ route('laporan') }}"
class="btn btn-secondary w-100">

Reset

</a>

</div>

</div>

</form>

    </div>

</div>

<!-- CARD STATISTIK -->

<div class="row mb-4">

    <div class="col-lg-6">

        <div class="card border-0 shadow rounded-4 bg-success text-white">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small>Total Pendapatan</small>

                        <h2 class="fw-bold mt-2">

                            Rp {{ number_format($totalPendapatan,0,',','.') }}

                        </h2>

                    </div>

                    <i class="fas fa-money-bill-wave fa-4x opacity-50"></i>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="card border-0 shadow rounded-4 bg-primary text-white">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small>Total Transaksi</small>

                        <h2 class="fw-bold mt-2">

                            {{ $jumlahTransaksi }}

                        </h2>

                    </div>

                    <i class="fas fa-ticket-alt fa-4x opacity-50"></i>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="mb-3">

<a
href="{{ route('laporan.pdf') }}"
class="btn btn-danger">

📄 Export PDF

</a>

</div>
<div class="card shadow border-0 rounded-4">

<div class="card-header bg-dark text-white">

<h5 class="mb-0">

📋 Daftar Transaksi

</h5>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-dark text-center">

<tr>

<th>No</th>
<th>Pelanggan</th>
<th>Film</th>
<th>Kursi</th>
<th>Jumlah Tiket</th>
<th>Total Bayar</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($pemesanans as $item)

<tr>

<td class="text-center">

{{ $loop->iteration }}

</td>

<td>

<strong>{{ $item->user->name }}</strong>

</td>

<td>

{{ $item->jadwal->film->judul }}

</td>

<td>

@if($item->detailPemesanans->count())

@foreach($item->detailPemesanans as $detail)

<span class="badge bg-primary me-1">

{{ $detail->kursi?->nomor_kursi ?? '-' }}

</span>

@endforeach

@else

<span class="badge bg-secondary">

-

</span>

@endif

</td>

<td class="text-center">

{{ $item->jumlah_tiket }}

</td>

<td>

<strong class="text-success">

Rp {{ number_format($item->total_harga,0,',','.') }}

</strong>

</td>

<td>

@if($item->status == 'dibayar')

<span class="badge bg-success">

✔ Dibayar

</span>

@elseif($item->status == 'pending')

<span class="badge bg-warning text-dark">

Menunggu

</span>

@else

<span class="badge bg-danger">

{{ ucfirst($item->status) }}

</span>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center py-4">

<img src="https://cdn-icons-png.flaticon.com/512/6134/6134065.png"
width="80"
class="mb-3">

<br>

Belum ada data transaksi.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

</div>

@endsection