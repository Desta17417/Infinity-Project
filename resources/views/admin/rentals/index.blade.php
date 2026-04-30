@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Riwayat Penyewaan</h3>
            <p class="text-muted">Pantau semua transaksi penyewaan armada motor Anda.</p>
        </div>
        <button class="btn btn-primary shadow-sm" onclick="window.print()">
            <i class="fa-solid fa-print me-2"></i> Cetak Laporan
        </button>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-3 bg-primary text-white rounded-4">
                <small class="opacity-75">Total Transaksi</small>
                <h3 class="fw-bold mb-0">{{ $rentals->count() }}</h3>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3">No</th>
                            <th class="py-3">Penyewa</th>
                            <th class="py-3">Motor</th>
                            <th class="py-3">Tgl Sewa</th>
                            <th class="py-3">Durasi</th>
                            <th class="py-3">Total Harga</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rentals as $index => $rental)
                        <tr>
                            <td class="ps-4">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $rental->user->name ?? 'User Terhapus' }}</div>
                                <small class="text-muted">{{ $rental->user->email ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info border border-info-subtle px-2">
                                    {{ $rental->motor->nama_motor ?? 'Unit Dihapus' }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($rental->tgl_sewa)->format('d M Y') }}</td>
                            <td>{{ $rental->durasi_sewa }} Hari</td>
                            <td class="fw-bold text-dark">
                                Rp {{ number_format($rental->total_harga, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($rental->status == 'selesai')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Selesai</span>
                                @elseif($rental->status == 'proses')
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3">Proses</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Batal</span>
                                @endif
                            </td>
                            <td class="text-center pe-4">
                                <div class="btn-group shadow-sm">
                                    <a href="#" class="btn btn-light btn-sm border" title="Detail">
                                        <i class="fa-solid fa-eye text-primary"></i>
                                    </a>
                                    <form action="#" method="POST" onsubmit="return confirm('Hapus data rental?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-sm border" title="Hapus">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-inbox fa-3x mb-3 d-block opacity-25"></i>
                                Belum ada data penyewaan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling tambahan untuk badge lembut (Subtle) */
    .bg-success-subtle { background-color: #d1e7dd; }
    .bg-warning-subtle { background-color: #fff3cd; }
    .bg-danger-subtle { background-color: #f8d7da; }
    .bg-info-subtle { background-color: #cff4fc; }
    
    .table thead th {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        color: #6c757d;
    }
</style>
@endsection