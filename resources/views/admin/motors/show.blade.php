@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Detail Unit: {{ $motor->nama_motor }}</h3>
        <a href="{{ route('admin.motors.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-5 mb-4 mb-md-0 text-center">
                    @if($motor->foto)
                        <img src="{{ asset('storage/' . $motor->foto) }}" class="img-fluid rounded-4 shadow" style="max-height: 400px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-4 d-flex align-items-center justify-content-center border" style="height: 300px;">
                            <div class="text-center">
                                <i class="fa-solid fa-motorcycle fa-4x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada gambar tersedia</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-md-7">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-muted border-0">Nama Motor</th>
                                    <td class="fw-bold border-0">{{ $motor->nama_motor }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Merk / Brand</th>
                                    <td><span class="badge bg-light text-dark border p-2">{{ $motor->merk }}</span></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Harga Sewa</th>
                                    <td>
                                        <h4 class="text-primary fw-bold mb-0">
                                            Rp {{ number_format($motor->harga_sewa, 0, ',', '.') }} <small class="text-muted fs-6">/ hari</small>
                                        </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Riwayat Penyewaan</th>
                                    <td>
                                        <span class="badge bg-primary py-2 px-3 rounded-pill">
                                            {{ $motor->rentals->count() }} Penyewaan
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Deskripsi</th>
                                    <td class="text-secondary">{{ $motor->deskripsi ?? 'Informasi deskripsi belum ditambahkan.' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('admin.motors.edit', $motor->id) }}" class="btn btn-warning px-4 py-2 text-white shadow-sm">
                            <i class="fa-solid fa-pen-to-square me-2"></i> Edit Data
                        </a>
                        <form action="{{ route('admin.motors.destroy', $motor->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger px-4 py-2 shadow-sm">
                                <i class="fa-solid fa-trash-can me-2"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($motor->rentals->count() > 0)
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-bottom">
            <h5 class="mb-0 fw-bold">
                <i class="fa-solid fa-history me-2 text-primary"></i>Riwayat Penyewaan
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">No</th>
                            <th>Penyewa</th>
                            <th>Email</th>
                            <th>Tanggal Sewa</th>
                            <th>Tanggal Kembali</th>
                            <th>Durasi</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($motor->rentals as $index => $rental)
                        <tr>
                            <td class="ps-4">{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $rental->user->name ?? 'User Terhapus' }}</td>
                            <td><small class="text-muted">{{ $rental->user->email ?? '-' }}</small></td>
                            <td>{{ \Carbon\Carbon::parse($rental->tanggal_sewa)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($rental->tanggal_kembali)->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-info text-white">{{ $rental->durasi_sewa }} Hari</span>
                            </td>
                            <td class="fw-bold">Rp {{ number_format($rental->total_harga, 0, ',', '.') }}</td>
                            <td>
                                @if($rental->status == 'selesai')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Selesai</span>
                                @elseif($rental->status == 'proses' || $rental->status == 'dibayar')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">Proses</span>
                                @elseif($rental->status == 'pending')
                                    <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3">Pending</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Batal</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .bg-success-subtle { background-color: #d1e7dd; }
    .bg-warning-subtle { background-color: #fff3cd; }
    .bg-danger-subtle { background-color: #f8d7da; }
    .bg-info-subtle { background-color: #cff4fc; }
</style>
@endsection