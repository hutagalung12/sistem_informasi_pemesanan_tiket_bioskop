@extends('layouts.app')

@section('title','Pilih Kursi')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<style>

body{
    background:#0f172a;
    font-family:'Poppins',sans-serif;
    color:white;
}

.container-seat{
    max-width:1300px;
    margin:auto;
    padding:40px;
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.back{
    color:white;
    text-decoration:none;
    font-size:18px;
}

.movie-card{
    display:flex;
    gap:30px;
    background:#1e293b;
    border-radius:20px;
    padding:25px;
    margin-bottom:40px;
}

.movie-card img{
    width:220px;
    border-radius:15px;
}

.movie-info h2{
    font-weight:bold;
    margin-bottom:20px;
}

.movie-info p{
    margin-bottom:10px;
    color:#cbd5e1;
}

.screen-title{
    text-align:center;
    margin-top:20px;
    letter-spacing:4px;
    color:#cbd5e1;
}

.screen{
    height:18px;
    width:90%;
    margin:auto;
    background:white;
    border-radius:50px;
    box-shadow:0 0 40px white;
    margin-bottom:60px;
}

.layout{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:40px;
}

.seat-area{
    background:#1e293b;
    padding:30px;
    border-radius:20px;
}

.summary{
    background:#1e293b;
    padding:25px;
    border-radius:20px;
    height:fit-content;
}

.summary h3{
    margin-bottom:20px;
}

</style>

<div class="container-seat">

<div class="header">

<h2>

🎟 Pilih Kursi

</h2>

<a href="{{ route('pelanggan.jadwal') }}" class="back">

← Kembali

</a>

</div>

<div class="movie-card">

@if($jadwal->film->poster)

<img src="{{ asset('storage/'.$jadwal->film->poster) }}">

@else

<img src="https://placehold.co/300x450">

@endif

<div class="movie-info">

<h2>

{{ $jadwal->film->judul }}

</h2>

<p>

🎬 Genre :
{{ $jadwal->film->genre }}

</p>

<p>

🏢 Studio :
{{ $jadwal->studio->nama_studio }}

</p>

<p>

📅
{{ $jadwal->tanggal }}

</p>

<p>

🕐
{{ $jadwal->jam_tayang }}

</p>

<p>

💰
Rp {{ number_format($jadwal->harga_tiket,0,',','.') }}

</p>

</div>

</div>

<div class="screen-title">

LAYAR BIOSKOP

</div>

<div class="screen"></div>

<div class="layout">

<div class="seat-area">

<form action="{{ route('pesan.store') }}" method="POST">

@csrf

<input
type="hidden"
name="jadwal_id"
value="{{ $jadwal->id }}">

<input
type="hidden"
name="jumlah_tiket"
id="jumlah_tiket"
value="0">
<style>

.seat-grid{

display:grid;
grid-template-columns:repeat(5,90px);
gap:18px;
justify-content:center;
margin-top:20px;

}

.seat{

width:90px;
height:90px;
background:#22c55e;
border-radius:18px;
display:flex;
justify-content:center;
align-items:center;
cursor:pointer;
font-weight:bold;
font-size:18px;
transition:.3s;

}

.seat:hover{

transform:scale(1.08);

}

.booked{

background:#ef4444;
cursor:not-allowed;

}

.selected{

background:#f59e0b !important;

}

.legend{

display:flex;
justify-content:center;
gap:30px;
margin-top:40px;

}

.legend-item{

display:flex;
align-items:center;
gap:10px;

}

.box{

width:25px;
height:25px;
border-radius:6px;

}

.green{

background:#22c55e;

}

.red{

background:#ef4444;

}

.orange{

background:#f59e0b;

}

.summary-card{

background:#0f172a;
padding:20px;
border-radius:15px;
margin-bottom:20px;

}

.price{

font-size:28px;
font-weight:bold;
color:#22c55e;

}

.btn-ticket{

background:#f59e0b;
border:none;
padding:15px;
border-radius:12px;
width:100%;
font-size:18px;
font-weight:bold;
margin-top:20px;

}

</style>

<div class="seat-grid">

@foreach($kursis as $kursi)

<label
class="seat
@if(in_array($kursi->id,$kursiTerisi))
booked
@endif">

@if(!in_array($kursi->id,$kursiTerisi))

<input
type="checkbox"
name="kursi_id[]"
value="{{ $kursi->id }}"
class="seat-check"
data-nomor="{{ $kursi->nomor_kursi }}"
hidden>

@endif

{{ $kursi->nomor_kursi }}

</label>

@endforeach

</div>

<div class="legend">

<div class="legend-item">

<div class="box green"></div>

<span>Kosong</span>

</div>

<div class="legend-item">

<div class="box orange"></div>

<span>Dipilih</span>

</div>

<div class="legend-item">

<div class="box red"></div>

<span>Terisi</span>

</div>

</div>

</div>

<div class="summary">

<h3>

Ringkasan Pesanan

</h3>

<div class="summary-card">

<p>

🎬 Film

</p>

<b>

{{ $jadwal->film->judul }}

</b>

</div>

<div class="summary-card">

<p>

💺 Kursi

</p>

<h4 id="seatName">

Belum dipilih

</h4>
<hr>

<p>Jumlah Tiket</p>

<h4 id="jumlahTiket">

0

</h4>

</div>

<div class="summary-card">

<p>

📅 Jadwal

</p>

<b>

{{ $jadwal->tanggal }}

<br>

{{ $jadwal->jam_tayang }}

</b>

</div>

<div class="summary-card">

<p>

💰 Harga Tiket

</p>

<div
class="price"
id="totalHarga">

Rp 0

</div>

</div>

<button class="btn-ticket">

🎟 Pesan Tiket

</button>

</form>

</div>

</div>
<style>

@media(max-width:992px){

.layout{

grid-template-columns:1fr;

}

.movie-card{

flex-direction:column;
align-items:center;
text-align:center;

}

.movie-card img{

width:220px;

}

}

@media(max-width:768px){

.seat-grid{

grid-template-columns:repeat(5,55px);
gap:10px;

}

.seat{

width:55px;
height:55px;
font-size:13px;

}

.summary{

margin-top:30px;

}

}

@media(max-width:500px){

.container-seat{

padding:15px;

}

.seat-grid{

grid-template-columns:repeat(5,48px);

}

.seat{

width:48px;
height:48px;
font-size:11px;

}

.screen{

width:100%;

}

}

</style>

<script>

const harga = {{ $jadwal->harga_tiket }};

const seatChecks = document.querySelectorAll('.seat-check');

const seatName = document.getElementById('seatName');

const jumlah = document.getElementById('jumlahTiket');

const total = document.getElementById('totalHarga');

const jumlahInput = document.getElementById('jumlah_tiket');

seatChecks.forEach(function(check){

    check.addEventListener('change',function(){

        let nomor=[];

        let totalTiket=0;

        document.querySelectorAll('.seat-check').forEach(function(item){

            if(item.checked){

                nomor.push(item.dataset.nomor);

                totalTiket++;

                item.parentElement.classList.add('selected');

            }else{

                item.parentElement.classList.remove('selected');

            }

        });

        seatName.innerHTML = nomor.length ? nomor.join(', ') : 'Belum dipilih';

        jumlah.innerHTML = totalTiket;

        jumlahInput.value = totalTiket;

        total.innerHTML = 'Rp ' + (harga*totalTiket).toLocaleString('id-ID');

    });

});

document.querySelector('form').addEventListener('submit',function(e){

    if(jumlahInput.value==0){

        e.preventDefault();

        alert('Pilih minimal satu kursi.');

    }

});

</script>

</div>

</div>

@endsection