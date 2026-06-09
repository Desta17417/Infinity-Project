@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">Detail Unit: {{ $motor->nama_motor }}</h3>
        <a href="{{ route('admin.motors.index') }}" class="btn btn-secondary shadow-sm">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-5 mb-4 mb-md-0 text-center">
                    @if($motor->gambar)
                        <img src="{{ asset('storage/' . $motor->gambar) }}" class="img-fluid rounded-4 shadow" style="max-height: 400px; object-fit: cover;">
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
                                    <th class="text-muted">Status Armada</th>
                                    <td>
                                        @if($motor->status == 'tersedia')
                                            <span class="badge bg-success py-2 px-3 rounded-pill">Tersedia</span>
                                        @else
                                            <span class="badge bg-danger py-2 px-3 rounded-pill">Sedang Disewa</span>
                                        @endif
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
</div>
@endsection