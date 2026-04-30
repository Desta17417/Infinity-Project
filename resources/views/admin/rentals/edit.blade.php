@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Update Status Penyewaan</h3>
        <a href="{{ route('admin.rentals') }}" class="btn btn-secondary shadow-sm">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <form action="{{ route('admin.rentals.update', $rental->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 p-3 bg-light rounded-3">
                            <p class="mb-1 text-muted small">Penyewa:</p>
                            <h6 class="fw-bold">{{ $rental->user->name }}</h6>
                            <p class="mb-1 text-muted small mt-2">Motor:</p>
                            <h6 class="fw-bold">{{ $rental->motor->nama_motor }}</h6>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Ubah Status Transaksi</label>
                            <select name="status" class="form-select form-select-lg shadow-sm">
                                <option value="proses" {{ $rental->status == 'proses' ? 'selected' : '' }}>Proses (Belum Selesai)</option>
                                <option value="selesai" {{ $rental->status == 'selesai' ? 'selected' : '' }}>Selesai (Sudah Kembali)</option>
                                <option value="batal" {{ $rental->status == 'batal' ? 'selected' : '' }}>Batalkan Transaksi</option>
                            </select>
                            <small class="text-muted mt-2 d-block">* Pastikan unit motor sudah dicek kembali jika memilih status Selesai.</small>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fa-solid fa-save me-2"></i> Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 bg-primary text-white shadow-sm rounded-4 p-4">
                <h5 class="fw-bold"><i class="fa-solid fa-circle-info me-2"></i> Catatan Admin</h5>
                <p class="small mb-0 mt-3">
                    Mengubah status menjadi <b>Selesai</b> menandakan bahwa pembayaran telah lunas dan unit motor telah diterima kembali oleh pihak rental dalam kondisi baik.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection