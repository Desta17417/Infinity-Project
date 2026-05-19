@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h3 class="fw-bold text-dark">
                <i class="fa-solid fa-history me-2"></i>Log Akses Admin
            </h3>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.logs.export', request()->query()) }}" class="btn btn-success btn-sm">
                <i class="fa-solid fa-file-csv me-2"></i>Export CSV
            </a>
            @if(count($logs) > 0)
                <button class="btn btn-warning btn-sm" onclick="clearOldLogs()">
                    <i class="fa-solid fa-trash me-2"></i>Hapus Log Lama
                </button>
            @endif
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.logs.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="date_from" class="form-label fw-semibold">Tanggal Dari</label>
                    <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <label for="date_to" class="form-label fw-semibold">Tanggal Hingga</label>
                    <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-3">
                    <label for="action" class="form-label fw-semibold">Aksi</label>
                    <select class="form-select" id="action" name="action">
                        <option value="">Semua Aksi</option>
                        @foreach($actions as $act)
                            <option value="{{ $act }}" {{ request('action') === $act ? 'selected' : '' }}>
                                {{ ucfirst($act) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="admin_id" class="form-label fw-semibold">Admin</label>
                    <select class="form-select" id="admin_id" name="admin_id">
                        <option value="">Semua Admin</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}" {{ request('admin_id') == $admin->id ? 'selected' : '' }}>
                                {{ $admin->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-magnifying-glass me-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.logs.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fa-solid fa-rotate-left me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-check-circle me-2"></i>{{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Logs Table -->
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="fw-semibold text-dark">ID</th>
                        <th class="fw-semibold text-dark">Admin</th>
                        <th class="fw-semibold text-dark">Aksi</th>
                        <th class="fw-semibold text-dark">IP Address</th>
                        <th class="fw-semibold text-dark">Waktu Akses</th>
                        <th class="fw-semibold text-dark">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr class="border-bottom">
                            <td>
                                <span class="badge bg-primary">{{ $log->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-size: 0.75rem;">
                                        {{ strtoupper(substr($log->admin_name, 0, 1)) }}
                                    </div>
                                    <span>{{ $log->admin_name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-success">{{ ucfirst($log->action) }}</span>
                            </td>
                            <td>
                                <small class="text-muted font-monospace">{{ $log->ip_address }}</small>
                            </td>
                            <td>
                                <div>
                                    <div class="fw-semibold">{{ $log->accessed_at->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $log->accessed_at->format('H:i:s') }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.logs.show', $log->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteLog({{ $log->id }})" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-inbox fs-5"></i>
                                <p class="mt-2">Tidak ada log akses</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $logs->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Delete Confirmation Modal -->
<form id="delete-form" method="POST" style="display:none;">
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
                const form = document.getElementById('delete-form');
                form.action = `/admin/access-logs/${logId}`;
                form.submit();
            }
        });
    }

    function clearOldLogs() {
        Swal.fire({
            title: 'Hapus Log Lama',
            text: 'Hapus semua log yang berusia lebih dari 30 hari?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route("admin.logs.clear") }}';
            }
        });
    }
</script>
@endsection
