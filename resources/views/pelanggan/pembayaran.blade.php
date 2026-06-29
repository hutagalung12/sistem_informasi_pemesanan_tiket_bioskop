@extends('layouts.app')

@section('title','Pembayaran')

@section('content')

<style>

body{
    background:#eef3fb;
}

.payment-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.method{
    border:2px solid #dee2e6;
    border-radius:15px;
    padding:18px;
    cursor:pointer;
    transition:.3s;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.method.active{
    border-color:#198754;
    background:#e8fff1;
    box-shadow:0 0 10px rgba(25,135,84,.3);
}

.method input{
    transform:scale(1.3);
}

.method:hover{
    border-color:#0d6efd;
    background:#f8f9ff;
}

.method input{
    margin-right:10px;
}

.info{
    background:#f8f9fa;
    border-radius:15px;
    padding:20px;
}

.total{
    color:#198754;
    font-size:30px;
    font-weight:bold;
}

.countdown{
    color:#dc3545;
    font-size:18px;
    font-weight:bold;
}

</style>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card payment-card">

<div class="card-header bg-primary text-white">

<h3 class="mb-0">
💳 Pembayaran Tiket
</h3>

</div>

<div class="card-body">

<div class="info mb-4">

<h4>

{{ $pemesanan->jadwal->film->judul }}

</h4>

<hr>

<p>

🎟 Jumlah Tiket :

<b>

{{ $pemesanan->jumlah_tiket }}

</b>

</p>

<p>

💰 Total Bayar

</p>

<div class="total">

Rp {{ number_format($pemesanan->total_harga,0,',','.') }}

</div>

<hr>

<p>

Kode Pembayaran

</p>

<h5>

{{ $pemesanan->kode_pembayaran }}

</h5>

<p>

Batas Pembayaran

</p>

<div
class="countdown"
id="timer">

Loading...

</div>

</div>

<form
action="{{ route('bayar',$pemesanan->id) }}"
method="POST">

@csrf

<h5 class="mb-3">

Pilih Metode Pembayaran

</h5>

<div class="method mb-3">

<label class="w-100 d-flex justify-content-between align-items-center m-0">

<span>📱 QRIS</span>

<input
type="radio"
name="metode_pembayaran"
value="QRIS"
required>

</label>

</div>

<div class="method mb-3">

<label class="w-100 d-flex justify-content-between align-items-center m-0">

<span>🏦 Transfer Bank</span>

<input
type="radio"
name="metode_pembayaran"
value="Transfer Bank">

</label>

</div>

<div class="method mb-3">

<label class="w-100 d-flex justify-content-between align-items-center m-0">

<span>🟦 DANA</span>

<input
type="radio"
name="metode_pembayaran"
value="DANA">

</label>

</div>

<div class="method mb-3">

<label class="w-100 d-flex justify-content-between align-items-center m-0">

<span>🟣 OVO</span>

<input
type="radio"
name="metode_pembayaran"
value="OVO">

</label>

</div>

<div class="method mb-4">

<label class="w-100 d-flex justify-content-between align-items-center m-0">

<span>🟢 GoPay</span>

<input
type="radio"
name="metode_pembayaran"
value="GoPay">

</label>

</div>

<button
class="btn btn-success btn-lg w-100">

✔ Bayar Sekarang

</button>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

let expired = new Date("{{ $pemesanan->expired_at }}").getTime();

let timer = setInterval(function(){

let now = new Date().getTime();

let distance = expired-now;

if(distance<0){

clearInterval(timer);

document.getElementById("timer").innerHTML="Waktu pembayaran habis";

return;

}

let minutes=Math.floor(distance/(1000*60));

let seconds=Math.floor((distance%(1000*60))/1000);

document.getElementById("timer").innerHTML=

minutes+" menit "+seconds+" detik";

},1000);
const methods=document.querySelectorAll('.method');

methods.forEach(function(method){

    method.addEventListener('click',function(){

        methods.forEach(function(m){

            m.classList.remove('active');

        });

        this.classList.add('active');

        this.querySelector('input').checked=true;

    });

});

</script>


@endsection