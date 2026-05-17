<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Form Edit Data Mahasiswa</h2>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $mahasiswa->nama) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label fw-bold">NIM</label>
                            <input type="text" name="nim" id="nim" class="form-control" value="{{ old('nim', $mahasiswa->nim) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="file_dokumen" class="form-label fw-bold">Unggah Dokumen Baru (Opsional)</label>
                            <input type="file" name="file_dokumen" id="file_dokumen" class="form-control">
                            <div class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah dokumen. Format: JPEG, PNG, PDF (Maks 2MB).</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-success px-5">Perbarui Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>