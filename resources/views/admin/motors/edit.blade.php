@extends('admin.layout')

@section('content')
<div class="container">
    <h2>Edit Motor: {{ $motor->nama_motor }}</h2>
    
    <form action="{{ route('admin.motors.update', $motor->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="mb-3">
            <label>Nama Motor</label>
            <input type="text" name="nama_motor" value="{{ $motor->nama_motor }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga Sewa</label>
            <input type="number" name="harga_sewa" value="{{ $motor->harga_sewa }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection