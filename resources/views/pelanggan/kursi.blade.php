@extends('layouts.app')

@section('title', 'Pilih Kursi')

@section('content')

<style>
.screen {
    background: #333;
    color: white;
    text-align: center;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 8px;
}

.seat-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: center;
}

.row {
    display: flex;
    gap: 10px;
}

.seat {
    width: 40px;
    height: 40px;
    background: #ddd;
    border-radius: 6px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: 0.2s;
    font-weight: bold;
}

.seat:hover {
    background: #90cdf4;
}

.seat.selected {
    background: #38bdf8;
    color: white;
}

.seat.occupied {
    background: #ef4444;
    cursor: not-allowed;
    color: white;
}
</style>

<div class="container mt-4">

    <h3 class="text-center mb-3">🎟️ Pilih Kursi Bioskop</h3>

    <div class="screen">LAYAR BIOSKOP</div>

    <div class="seat-container">
        {{-- BARIS A --}}
        <div class="row">
            <div class="seat" data-seat="A1">A1</div>
            <div class="seat" data-seat="A2">A2</div>
            <div class="seat" data-seat="A3">A3</div>
            <div class="seat" data-seat="A4">A4</div>
        </div>

        {{-- BARIS B --}}
        <div class="row">
            <div class="seat" data-seat="B1">B1</div>
            <div class="seat" data-seat="B2">B2</div>
            <div class="seat" data-seat="B3">B3</div>
            <div class="seat" data-seat="B4">B4</div>
        </div>

        {{-- BARIS C --}}
        <div class="row">
            <div class="seat" data-seat="C1">C1</div>
            <div class="seat" data-seat="C2">C2</div>
            <div class="seat" data-seat="C3">C3</div>
            <div class="seat" data-seat="C4">C4</div>
        </div>
    </div>

    <form action="{{ route('booking.store') }}" method="POST" class="text-center mt-4">
        @csrf

        <input type="hidden" name="seat" id="selectedSeat">

        <button type="submit" class="btn btn-primary">
            Konfirmasi Kursi
        </button>
    </form>

</div>

<script>
let seats = document.querySelectorAll(".seat");

seats.forEach(seat => {
    seat.addEventListener("click", function () {

        if (this.classList.contains("occupied")) return;

        seats.forEach(s => s.classList.remove("selected"));

        this.classList.add("selected");

        document.getElementById("selectedSeat").value = this.dataset.seat;
    });
});
</script>

@endsection