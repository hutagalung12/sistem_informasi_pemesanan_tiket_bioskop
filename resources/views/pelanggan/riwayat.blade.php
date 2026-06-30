@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">🎟 Riwayat Pemesanan</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

        <tr>

            <th>Film</th>

            <th>Kursi</th>

            <th>Total</th>

            <th>Status</th>

            <th>Tiket</th>

        </tr>

        </thead>

        <tbody>

        @forelse($pemesanans as $item)

            <tr>

                <td>

                    {{ $item->jadwal->film->judul }}

                </td>

                <td>

                    @foreach($item->detailPemesanans as $detail)

                        <span class="badge bg-primary">

                            {{ $detail->kursi->nomor_kursi }}

                        </span>

                    @endforeach

                </td>

                <td>

                    Rp {{ number_format($item->total_harga,0,',','.') }}

                </td>

                <td>

                    @if($item->status=='pending')

                        <span class="badge bg-warning">

                            Pending

                        </span>

                    @elseif($item->status=='dibayar')

                        <span class="badge bg-success">

                            Dibayar

                        </span>

                    @else

                        <span class="badge bg-danger">

                            Dibatalkan

                        </span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('tiket.pdf',$item->id) }}"
                       class="btn btn-primary btn-sm">

                        📄 Cetak Tiket

                    </a>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5" class="text-center">

                    Belum ada riwayat pemesanan.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection