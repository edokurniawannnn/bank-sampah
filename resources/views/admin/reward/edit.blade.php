@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="mb-4">
			<a href="{{ route('admin.reward.index') }}" class="text-decoration-none text-muted">
				<i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Reward
			</a>
		</div>

		<form action="{{ route('admin.reward.update', $reward->id) }}" method="POST" class="panel needs-validation"
			novalidate>
			@csrf
			@method('PUT')

			<div class="panel-header">
				<div>
					<h2 class="h5 mb-1 section-title">
						<i class="bi bi-pencil-square" aria-hidden="true"></i>
						<span>Ubah Data Reward</span>
					</h2>
					<p class="text-muted mb-0">Perbarui informasi barang, stok, atau poin yang diperlukan.</p>
				</div>
			</div>

			<input type="hidden" name="aktif" value="0">

			<div class="row g-3">
				<div class="col-md-12">
					<label class="form-label fw-semibold" for="nama">Nama Reward / Barang <span
							class="text-danger">*</span></label>
					<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
						value="{{ old('nama', $reward->nama) }}" placeholder="Contoh: Beras Premium 5kg / Pulsa 10rb"
						required>

					@error('nama')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Nama reward wajib diisi.</div>
					@enderror
				</div>

				<div class="col-md-4">
					<label class="form-label fw-semibold" for="mitra_id">Penyedia (Mitra) <span
							class="text-danger">*</span></label>
					<select class="form-select @error('mitra_id') is-invalid @enderror" id="mitra_id" name="mitra_id"
						required>
						<option value="" disabled>-- Pilih Mitra --</option>
						@foreach($mitra as $m)
						<option value="{{ $m->id }}" {{ old('mitra_id', $reward->mitra_id) == $m->id ? 'selected' : ''
							}}>
							{{ $m->nama }}
						</option>
						@endforeach
					</select>

					@error('mitra_id')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Pilih mitra penyedia reward.</div>
					@enderror
				</div>

				<div class="col-md-4">
					<label class="form-label fw-semibold" for="poin_diperlukan">Poin Diperlukan <span
							class="text-danger">*</span></label>
					<div class="input-group has-validation">
						<input type="number" class="form-control @error('poin_diperlukan') is-invalid @enderror"
							id="poin_diperlukan" name="poin_diperlukan"
							value="{{ old('poin_diperlukan', $reward->poin_diperlukan) }}" min="1" required>
						<span class="input-group-text">Poin</span>

						@error('poin_diperlukan')
						<div class="invalid-feedback">{{ $message }}</div>
						@else
						<div class="invalid-feedback">Masukkan nominal poin yang valid.</div>
						@enderror
					</div>
				</div>

				<div class="col-md-4">
					<label class="form-label fw-semibold" for="stok">Stok Barang <span
							class="text-danger">*</span></label>
					<div class="input-group has-validation">
						<input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok"
							name="stok" value="{{ old('stok', $reward->stok) }}" min="0" required>
						<span class="input-group-text">Unit</span>

						@error('stok')
						<div class="invalid-feedback">{{ $message }}</div>
						@else
						<div class="invalid-feedback">Stok wajib diisi (minimal 0).</div>
						@enderror
					</div>
				</div>

				<div class="col-12 mt-4">
					<div class="form-check form-switch p-0 d-flex align-items-center gap-3">
						<label class="form-check-label fw-semibold m-0" for="aktif">Status Reward</label>
						<input class="form-check-input m-0" type="checkbox" role="switch" id="aktif" name="aktif"
							value="1" {{ old('aktif', $reward->aktif) ? 'checked' : '' }}
						style="width: 2.5em; height: 1.25em;">
						<span class="text-muted small">Aktifkan agar reward ini muncul di katalog warga.</span>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
				<a href="{{ route('admin.reward.index') }}" class="btn btn-light text-muted">
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