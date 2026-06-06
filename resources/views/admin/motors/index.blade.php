@extends('admin.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-dark">🏍️ Data Armada Motor</h3>
    <a href="{{ route('admin.motors.create') }}" class="btn btn-primary shadow-sm">+ Tambah Motor</a>
</div>

<div class="card border-0 shadow-sm p-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nama Motor</th>
                    <th>Merk</th>
                    <th>Harga Sewa / Hari</th>
                    <th class="text-center">Status</th>
                    <th>Penyewa / Rental Info</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($motors as $m)
                <tr>
                    <td class="fw-bold">{{ $m->nama_motor }}</td>
                    <td>{{ $m->merk }}</td>
                    <td><span class="text-success fw-bold">Rp {{ number_format($m->harga_sewa, 0, ',', '.') }}</span></td>
                    <td class="text-center">
                        @if($m->rentals->count() > 0)
                            <span class="badge rounded-pill bg-warning">
                                {{ $m->rentals->count() }} Penyewaan
                            </span>
                        @else
                            <span class="badge rounded-pill bg-success">Tersedia</span>
                        @endif
                    </td>
                    <td>
                        @if($m->rentals->count() > 0)
                            @php
                                $latestRental = $m->rentals->first();
                            @endphp
                            <small class="d-block">
                                <strong>{{ $latestRental->user->name ?? 'User Terhapus' }}</strong>
                            </small>
                            <small class="text-muted d-block">
                                {{ \Carbon\Carbon::parse($latestRental->tanggal_sewa)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($latestRental->tanggal_kembali)->format('d M Y') }}
                            </small>
                            <small class="text-primary d-block">
                                <i class="fa-solid fa-calendar-days me-1"></i>{{ $latestRental->durasi_sewa }} Hari
                            </small>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.motors.show', $m->id) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.motors.edit', $m->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            
                            <form action="{{ route('admin.motors.destroy', $m->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Data motor masih kosong.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection