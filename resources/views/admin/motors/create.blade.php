@extends('admin.layout')

@section('content')

<div class="mb-3">
    <a href="{{ route('admin.motors.index') }}" class="btn btn-secondary btn-sm"><- Kembali</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold">Tambah Armada Motor Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.motors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Motor</label>
                    <input type="text" name="nama_motor" class="form-control @error('nama_motor') is-invalid @enderror" placeholder="Contoh: Vario 150" required value="{{ old('nama_motor') }}">
                    @error('nama_motor') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Merk</label>
                    <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" placeholder="Contoh: Honda" required value="{{ old('merk') }}">
                    @error('merk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Sewa per Hari (Rp)</label>
                    <input type="number" name="harga_sewa" class="form-control @error('harga_sewa') is-invalid @enderror" placeholder="Contoh: 150000" required value="{{ old('harga_sewa') }}">
                    @error('harga_sewa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disewa" {{ old('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Foto Motor</label>
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                    @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    
                    <div class="mt-3">
                        <img id="img-preview" class="img-fluid rounded shadow-sm" style="max-height: 200px; display: none;">
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                <button type="reset" class="btn btn-light px-4" onclick="document.getElementById('img-preview').style.display='none'">Reset</button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('img-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection