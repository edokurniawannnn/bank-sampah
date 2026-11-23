@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="mb-4">
			<a href="{{ route('admin.mitra.index') }}" class="text-decoration-none text-muted">
				<i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Mitra
			</a>
		</div>

		<form action="{{ route('admin.mitra.update', $mitra->id) }}" method="POST" class="panel needs-validation"
			novalidate>
			@csrf
			@method('PUT')

			<div class="panel-header">
				<div>
					<h2 class="h5 mb-1 section-title">
						<i class="bi bi-pencil-square" aria-hidden="true"></i>
						<span>Ubah Data Mitra</span>
					</h2>
					<p class="text-muted mb-0">Perbarui informasi toko atau agen lokal penyedia reward di bawah ini.</p>
				</div>
			</div>

			<input type="hidden" name="aktif" value="0">

			<div class="row g-3">
				<div class="col-md-12">
					<label class="form-label fw-semibold" for="nama">Nama Mitra / Toko <span
							class="text-danger">*</span></label>
					<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
						value="{{ old('nama', $mitra->nama) }}" placeholder="Contoh: Warung Sembako Makmur" required>

					@error('nama')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Nama mitra wajib diisi.</div>
					@enderror
				</div>

				<div class="col-md-12">
					<label class="form-label fw-semibold" for="kontak">Nomor Kontak (Opsional)</label>
					<input type="text" class="form-control @error('kontak') is-invalid @enderror" id="kontak"
						name="kontak" value="{{ old('kontak', $mitra->kontak) }}" placeholder="Contoh: 081234567890">

					@error('kontak')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>

				<div class="col-12">
					<label class="form-label fw-semibold" for="alamat">Alamat Lengkap (Opsional)</label>
					<textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
						rows="4"
						placeholder="Masukkan alamat fisik toko... ">{{ old('alamat', $mitra->alamat) }}</textarea>

					@error('alamat')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>

				<div class="col-12 mt-4">
					<div class="form-check form-switch p-0 d-flex align-items-center gap-3">
						<label class="form-check-label fw-semibold m-0" for="aktif">Status Kemitraan</label>
						<input class="form-check-input m-0" type="checkbox" role="switch" id="aktif" name="aktif"
							value="1" {{ old('aktif', $mitra->aktif) ? 'checked' : '' }}
						style="width: 2.5em; height: 1.25em;">
						<span class="text-muted small">Aktifkan agar reward dari mitra ini bisa ditukarkan oleh
							warga.</span>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
				<a href="{{ route('admin.mitra.index') }}" class="btn btn-light text-muted">
					<i class="bi bi-x-lg me-1"></i> Batal
				</a>
				<button class="btn btn-primary" type="submit">
					<i class="bi bi-save me-1" aria-hidden="true"></i> Perbarui Data
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