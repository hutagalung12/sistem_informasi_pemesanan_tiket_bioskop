@extends('layouts.app')

@section('content')

<div class="container mt-4">

<h2>Tambah Kursi</h2>

<form action="{{ route('kursis.store') }}"
      method="POST">

@csrf

<div class="mb-3">

<label>Studio</label>

<select name="studio_id"
        class="form-control">

@foreach($studios as $studio)

<option value="{{ $studio->id }}">

{{ $studio->nama_studio }}

</option>

@endforeach

</select>

</div>

<div class="mb-3">

<label>Nomor Kursi</label>

<input type="text"
       name="nomor_kursi"
       class="form-control">

</div>

<div class="mb-3">

<label>Status</label>

<select name="status"
        class="form-control">

<option value="kosong">
Kosong
</option>

<option value="terisi">
Terisi
</option>

</select>

</div>

<button class="btn btn-success">

Simpan

</button>

</form>

</div>

@endsection