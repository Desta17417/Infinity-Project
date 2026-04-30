@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Detail Transaksi #{{ $rental->id }}</h3>
        <a href="{{ route('admin.rentals') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary">Informasi Penyewaan</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Nama Penyewa</div>
                        <div class="col-sm-8 fw-bold">{{ $rental->user->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Unit Motor</div>
                        <div class="col-sm-8 text-primary fw-bold">{{ $rental->motor->nama_motor }} ({{ $rental->motor->merk }})</div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Tanggal Sewa</div>
                        <div class="col-sm-8">{{ \Carbon\Carbon::parse($rental->tgl_sewa)->format('d F Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Durasi</div>
                        <div class="col-sm-8">{{ $rental->durasi_sewa }} Hari</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Total Bayar</div>
                        <div class="col-sm-8 fw-bold text-success fs-5">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4">
                <h6 class="text-muted mb-3">Status Transaksi</h6>
                @if($rental->status == 'selesai')
                    <div class="alert alert-success rounded-pill fw-bold">SELESAI</div>
                @elseif($rental->status == 'proses')
                    <div class="alert alert-warning rounded-pill fw-bold">DALAM PROSES</div>
                @else
                    <div class="alert alert-danger rounded-pill fw-bold">DIBATALKAN</div>
                @endif
                
                <hr>
                
                <p class="small text-muted">Aksi Admin:</p>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary"><i class="fa-solid fa-envelope me-2"></i> Hubungi User</button>
                    <button class="btn btn-outline-dark" onclick="window.print()"><i class="fa-solid fa-print me-2"></i> Cetak Invoice</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection