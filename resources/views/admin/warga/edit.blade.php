@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="mb-4">
			<a href="{{ route('admin.warga.index') }}" class="text-decoration-none text-muted">
				<i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Warga
			</a>
		</div>

		<form action="{{ route('admin.warga.update', $warga->id) }}" method="POST" class="panel needs-validation"
			novalidate>
			@csrf
			@method('PUT')

			<div class="panel-header">
				<div>
					<h2 class="h5 mb-1 section-title">
						<i class="bi bi-pencil-square" aria-hidden="true"></i>
						<span>Ubah Data Warga</span>
					</h2>
					<p class="text-muted mb-0">Perbarui informasi kontak atau alamat tempat tinggal warga.</p>
				</div>
			</div>

			<div class="row g-3">
				<div class="col-md-12">
					<label class="form-label fw-semibold" for="nama">Nama Lengkap <span
							class="text-danger">*</span></label>
					<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
						value="{{ old('nama', $warga->nama) }}" required>

					@error('nama')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>

				<div class="col-md-12">
					<label class="form-label fw-semibold" for="kontak">Nomor HP / WhatsApp</label>
					<input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak"
						name="kontak" value="{{ old('kontak', $warga->kontak) }}" placeholder="Contoh: 081234567890">

					@error('kontak')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>

				<div class="col-12">
					<label class="form-label fw-semibold" for="alamat">Alamat Lengkap / RT RW</label>
					<textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
						rows="3"
						placeholder="Masukkan alamat domisili saat ini...">{{ old('alamat', $warga->alamat) }}</textarea>

					@error('alamat')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
			</div>

			<div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
				<a href="{{ route('admin.warga.index') }}" class="btn btn-light text-muted">Batal</a>
				<button class="btn btn-primary" type="submit">
					<i class="bi bi-save me-1" aria-hidden="true"></i> Perbarui Profil Warga
				</button>
			</div>
		</form>
	</div>
</main>
@endsection

@section('js')
<script>
	(() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection