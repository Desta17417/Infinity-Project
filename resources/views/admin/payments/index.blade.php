@extends('admin.layout')

@section('content')

<h3>Verifikasi Pembayaran</h3>

<div class="card shadow p-3">
<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Rental</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    @foreach($payments as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>#{{ $p->rental_id }}</td>
        <td>
            <span class="badge bg-warning">{{ $p->status }}</span>
        </td>
        <td>
            <a href="/admin/payment/{{ $p->id }}" class="btn btn-success btn-sm">
                Validasi
            </a>
        </td>
    </tr>
    @endforeach

</table>
</div>

@endsection