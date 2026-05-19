@extends('admin.layout')

@section('content')

<div class="mb-3">
    <a href="{{ route('admin.motors.index') }}" class="btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
</div>

<!-- Error Messages -->
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-exclamation me-2"></i>
        <strong>Terjadi Kesalahan:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0 fw-bold"><i class="fa-solid fa-plus-circle me-2"></i>Tambah Armada Motor Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.motors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Motor <span class="text-danger">*</span></label>
                    <input type="text" name="nama_motor" class="form-control @error('nama_motor') is-invalid @enderror" placeholder="Contoh: Vario 150" required value="{{ old('nama_motor') }}">
                    @error('nama_motor') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Merk <span class="text-danger">*</span></label>
                    <input type="text" name="merk" class="form-control @error('merk') is-invalid @enderror" placeholder="Contoh: Honda" required value="{{ old('merk') }}">
                    @error('merk') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Harga Sewa per Hari (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga_sewa" class="form-control @error('harga_sewa') is-invalid @enderror" placeholder="Contoh: 150000" required value="{{ old('harga_sewa') }}">
                    @error('harga_sewa') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="disewa" {{ old('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                    </select>
                    @error('status') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label fw-semibold">Foto Motor</label>
                    <input type="file" id="foto-input" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="handleFileSelect(this)">
                    
                    <div class="alert alert-info mt-2 mb-0" role="alert">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        <small>
                            <strong>Format:</strong> JPG, JPEG, PNG, WEBP | 
                            <strong>Maksimal:</strong> 5MB |
                            <strong>Catatan:</strong> Gambar akan otomatis dikompres untuk performa lebih baik.
                        </small>
                    </div>
                    @error('foto') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    
                    <!-- File Info -->
                    <div id="file-info" style="display: none;" class="mt-2 p-2 bg-light rounded">
                        <small>
                            <span class="d-block"><strong>File:</strong> <span id="file-name"></span></span>
                            <span class="d-block"><strong>Ukuran:</strong> <span id="file-size"></span> KB</span>
                            <span class="d-block"><strong>Estimasi setelah kompresi:</strong> <span id="file-estimate"></span> KB</span>
                        </small>
                    </div>

                    <!-- Preview Foto -->
                    <div class="mt-3">
                        <img id="img-preview" class="img-fluid rounded shadow-sm" style="max-height: 250px; display: none;">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fa-solid fa-save me-2"></i>Simpan Data
                </button>
                <button type="reset" class="btn btn-light px-4" onclick="resetPreview()">
                    <i class="fa-solid fa-rotate-left me-2"></i>Reset
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB

    function handleFileSelect(input) {
        const preview = document.getElementById('img-preview');
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const fileEstimate = document.getElementById('file-estimate');

        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Validasi ukuran
            if (file.size > MAX_FILE_SIZE) {
                showError(`Ukuran file terlalu besar. Max 5MB, Anda upload ${formatFileSize(file.size)}`);
                input.value = '';
                fileInfo.style.display = 'none';
                preview.style.display = 'none';
                return;
            }

            // Validasi tipe file
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                showError('Format file tidak didukung. Gunakan JPG, PNG, atau WEBP.');
                input.value = '';
                fileInfo.style.display = 'none';
                preview.style.display = 'none';
                return;
            }

            // Tampilkan info file
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);

            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            fileEstimate.textContent = estimateCompressedSize(file.size);
            fileInfo.style.display = 'block';

            // Hapus error message jika ada
            const errorAlert = document.querySelector('.alert-danger');
            if (errorAlert) {
                errorAlert.remove();
            }
        }
    }

    function resetPreview() {
        document.getElementById('img-preview').style.display = 'none';
        document.getElementById('file-info').style.display = 'none';
        document.getElementById('foto-input').value = '';
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 KB';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round((bytes / Math.pow(k, i)) * 100) / 100 + ' ' + sizes[i];
    }

    function estimateCompressedSize(bytes) {
        // Estimasi kompresi 70% (tersisa 30%)
        const estimatedBytes = bytes * 0.3;
        return Math.round(estimatedBytes / 1024);
    }

    function showError(message) {
        alert(message);
    }
</script>

@endsection