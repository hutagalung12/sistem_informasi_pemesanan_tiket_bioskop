<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">

<title>Laporan Pemesanan</title>

<style>

body{
    font-family: DejaVu Sans;
    font-size:12px;
}

h2{
    text-align:center;
}

table{

    width:100%;

    border-collapse:collapse;

    margin-top:20px;

}

table,th,td{

    border:1px solid black;

}

th{

    background:#dddddd;

}

th,td{

    padding:8px;

    text-align:center;

}

.total{

    margin-top:20px;

    font-size:15px;

    font-weight:bold;

}

</style>

</head>

<body>

<h2>

LAPORAN PEMESANAN TIKET BIOSKOP

</h2>

<p>

Tanggal Cetak :

{{ now()->format('d-m-Y H:i') }}

</p>

<table>

<thead>

<tr>

<th>No</th>

<th>Pelanggan</th>

<th>Film</th>

<th>Kursi</th>

<th>Jumlah</th>

<th>Total</th>

<th>Status</th>

</tr>

</thead>

<tbody>

@foreach($pemesanans as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->user->name }}</td>

<td>{{ $item->jadwal->film->judul }}</td>

<td>

@if($item->detailPemesanans->count())

@foreach($item->detailPemesanans as $detail)

{{ $detail->kursi?->nomor_kursi ?? '-' }}

@endforeach

@else

-

@endif

</td>

<td>

{{ $item->jumlah_tiket }}

</td>

<td>

Rp {{ number_format($item->total_harga,0,',','.') }}

</td>

<td>

{{ ucfirst($item->status) }}

</td>

</tr>

@endforeach

</tbody>

</table>

<p class="total">

Total Pendapatan :

Rp {{ number_format($totalPendapatan,0,',','.') }}

</p>

</body>

</html>