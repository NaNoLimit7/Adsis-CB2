<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Form Tambah Data Mahasiswa</h2>
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
                    <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama mahasiswa" value="{{ old('nama') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label fw-bold">NIM (Nomor Induk Mahasiswa)</label>
                            <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan NIM mahasiswa" value="{{ old('nim') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="file_dokumen" class="form-label fw-bold">Unggah Dokumen (Scan Ijazah / Foto Profil)</label>
                            <input type="file" name="file_dokumen" id="file_dokumen" class="form-control" required>
                            <div class="form-text text-muted">Format file yang didukung: JPEG, PNG, PDF (Maksimal ukuran file 2MB).</div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary px-5">Simpan Data Mahasiswa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>