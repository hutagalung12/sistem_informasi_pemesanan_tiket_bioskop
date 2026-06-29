@extends('layouts.app')

@section('content')

<div class="container mt-4">

<h2>Edit Kursi</h2>

<form action="{{ route('kursis.update',$kursi->id) }}"
      method="POST">

@csrf
@method('PUT')

<div class="mb-3">

<label>Nomor Kursi</label>

<input type="text"
       name="nomor_kursi"
       value="{{ $kursi->nomor_kursi }}"
       class="form-control">

</div>

<div class="mb-3">

<label>Status</label>

<select name="status"
        class="form-control">

<option
value="kosong"
{{ $kursi->status=='kosong' ? 'selected':'' }}>

Kosong

</option>

<option
value="terisi"
{{ $kursi->status=='terisi' ? 'selected':'' }}>

Terisi

</option>

</select>

</div>

<button class="btn btn-success">

Update

</button>

</form>

</div>

@endsection