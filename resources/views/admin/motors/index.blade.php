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
                        <span class="badge rounded-pill bg-{{ $m->status == 'tersedia' ? 'success' : 'danger' }}">
                            {{ ucfirst($m->status) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.motors.edit', $m->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            
                            <form action="{{ route('admin.motors.destroy', $m->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Data motor masih kosong.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection