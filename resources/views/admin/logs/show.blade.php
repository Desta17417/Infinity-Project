@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h3 class="fw-bold text-dark">
                <i class="fa-solid fa-eye me-2"></i>Detail Log Akses
            </h3>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">ID Log</label>
                        <div class="fs-6 text-dark">{{ $log->id }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Admin</label>
                        <div class="d-flex align-items-center">
                            <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($log->admin_name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fs-6 text-dark fw-semibold">{{ $log->admin_name }}</div>
                                <small class="text-muted">Email: {{ $log->user->email ?? 'N/A' }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Aksi</label>
                        <div>
                            <span class="badge bg-success fs-6">{{ ucfirst($log->action) }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">IP Address</label>
                        <div class="fs-6 text-dark font-monospace">{{ $log->ip_address ?? 'N/A' }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Waktu Akses</label>
                        <div>
                            <div class="fs-6 text-dark">{{ $log->accessed_at->format('d MMMM Y H:i:s') }}</div>
                            <small class="text-muted">({{ $log->accessed_at->diffForHumans() }})</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted">Dicatat Pada</label>
                        <div class="fs-6 text-dark">{{ $log->created_at->format('d MMMM Y H:i:s') }}</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label class="form-label fw-semibold text-muted">User Agent</label>
                    <div class="alert alert-light border border-1">
                        <small class="text-dark">{{ $log->user_agent ?? 'N/A' }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Log
        </a>
        <button class="btn btn-danger" onclick="deleteLog({{ $log->id }})">
            <i class="fa-solid fa-trash me-2"></i>Hapus Log
        </button>
    </div>
</div>

<!-- Delete Form -->
<form id="delete-form" method="POST" action="{{ route('admin.logs.destroy', $log->id) }}" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<script>
    function deleteLog(logId) {
        Swal.fire({
            title: 'Hapus Log',
            text: 'Apakah Anda yakin ingin menghapus log ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form').submit();
            }
        });
    }
</script>
@endsection
