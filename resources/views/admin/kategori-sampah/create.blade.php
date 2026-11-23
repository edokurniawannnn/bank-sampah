@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="mb-4">
			<a href="{{ route('admin.kategori-sampah.index') }}" class="text-decoration-none text-muted">
				<i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Kategori
			</a>
		</div>

		<form action="{{ route('admin.kategori-sampah.store') }}" method="POST" class="panel needs-validation"
			novalidate>
			@csrf

			<div class="panel-header">
				<div>
					<h2 class="h5 mb-1 section-title">
						<i class="bi bi-ui-checks-grid" aria-hidden="true"></i>
						<span>Tambah Kategori Sampah</span>
					</h2>
				</div>
			</div>

			<div class="row g-3">
				<div class="col-md-12">
					<label class="form-label fw-semibold" for="nama">Nama Kategori <span
							class="text-danger">*</span></label>
					<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
						value="{{ old('nama') }}" placeholder="Contoh: Plastik PET / Kertas Kardus" required>

					@error('nama')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Nama kategori wajib diisi.</div>
					@enderror
				</div>

				<div class="col-md-6">
					<label class="form-label fw-semibold" for="nilai_poin_per_kg">Nilai Poin <span
							class="text-danger">*</span></label>
					<input type="number" class="form-control @error('nilai_poin_per_kg') is-invalid @enderror"
						id="nilai_poin_per_kg" name="nilai_poin_per_kg" value="{{ old('nilai_poin_per_kg') }}" min="1"
						placeholder="Contoh: 50" required>

					@error('nilai_poin_per_kg')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Masukkan nilai poin yang valid (minimal 1).</div>
					@enderror
				</div>

				<div class="col-md-6">
					<label class="form-label fw-semibold" for="satuan">Satuan <span class="text-danger">*</span></label>
					<input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan"
						name="satuan" value="{{ old('satuan', 'kg') }}" placeholder="Contoh: kg" required>

					@error('satuan')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Satuan wajib diisi.</div>
					@enderror
				</div>

				<div class="col-12">
					<label class="form-label fw-semibold" for="deskripsi">Deskripsi</label>
					<textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
						name="deskripsi" rows="4"
						placeholder="Jelaskan spesifikasi atau syarat sampah yang bisa diterima (opsional)...">{{ old('deskripsi') }}</textarea>

					@error('deskripsi')
					<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>

				<div class="col-12 mt-4">
					<div class="form-check form-switch p-0 d-flex align-items-center gap-3">
						<label class="form-check-label fw-semibold m-0" for="aktif">Status Kategori</label>
						<input class="form-check-input m-0" type="checkbox" role="switch" id="aktif" name="aktif"
							value="1" {{ old('aktif', '1' )=='1' ? 'checked' : '' }}
							style="width: 2.5em; height: 1.25em;">
						<span class="text-muted small">Aktifkan agar bisa dipilih saat input setoran.</span>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
				<a href="{{ route('admin.kategori-sampah.index') }}" class="btn btn-light text-muted">
					<i class="bi bi-x-lg me-1"></i> Batal
				</a>
				<button class="btn btn-primary" type="submit">
					<i class="bi bi-save me-1" aria-hidden="true"></i> Simpan Data
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