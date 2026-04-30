@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4 p-4 text-center">
                <i class="fa-solid fa-circle-check text-success fa-3x mb-3"></i>
                <h3 class="fw-bold">Pemesanan Berhasil!</h3>
                <p class="text-muted">Silakan lakukan pembayaran untuk mengonfirmasi pesanan Anda.</p>
                
                <div class="bg-light p-4 rounded-4 my-4">
                    <p class="mb-1 text-muted small text-uppercase fw-bold">Transfer Ke Nomor Rekening:</p>
                    <h2 class="text-primary fw-bold mb-0">123-456-7890</h2>
                    <p class="fw-bold mt-1">Bank BCA a/n PT RentRide Indonesia</p>
                </div>

                <div class="text-start mb-4">
                    <h6 class="fw-bold">Ringkasan Transaksi:</h6>
                    <div class="d-flex justify-content-between small">
                        <span>Unit Motor:</span>
                        <span class="fw-bold">{{ $rental->motor->nama_motor }}</span>
                    </div>
                    <div class="d-flex justify-content-between small">
                        <span>Total Bayar:</span>
                        <span class="fw-bold text-danger">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <a href="{{ route('katalog.index') }}" class="btn btn-primary w-100 rounded-pill">
                    Saya Sudah Transfer
                </a>
            </div>
        </div>
    </div>
</div>
@endsection