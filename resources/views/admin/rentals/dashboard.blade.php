@extends('admin.layout')

@section('content')
<div class="container-fluid py-4">
    <h3 class="fw-bold mb-4" style="color: #334155;">📊 Dashboard Overview</h3>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold">Total Motor</p>
                        <h2 class="fw-bold mb-0">{{ $total_motor }}</h2>
                    </div>
                    <div class="rounded-3 p-3" style="background-color: #eff6ff;">
                        <i class="fas fa-motorcycle fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold">Total Rental</p>
                        <h2 class="fw-bold mb-0">{{ $total_rental }}</h2>
                    </div>
                    <div class="rounded-3 p-3" style="background-color: #f0fdf4;">
                        <i class="fas fa-calendar-check fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1 fw-semibold">Total User</p>
                        <h2 class="fw-bold mb-0">{{ $total_user }}</h2>
                    </div>
                    <div class="rounded-3 p-3" style="background-color: #fffbeb;">
                        <i class="fas fa-users fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Tambahkan sedikit styling tambahan untuk mencocokkan gambar */
    .card {
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .rounded-4 {
        border-radius: 15px !important;
    }
</style>
@endsection