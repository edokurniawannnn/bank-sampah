@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="mb-4">
			<a href="{{ route('petugas.setoran.index') }}" class="text-decoration-none text-muted">
				<i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
			</a>
		</div>

		@if($errors->any())
		<div class="alert alert-danger p-3 mb-4 rounded-3 border-0">
			<h5 class="h6 fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i>Gagal Menyimpan:</h5>
			<ul class="mb-0 small ps-3">
				@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
			</ul>
		</div>
		@endif

		<form action="{{ route('petugas.setoran.store') }}" method="POST" class="panel needs-validation" novalidate>
			@csrf

			<div class="panel-header border-bottom pb-3 mb-4">
				<div>
					<h2 class="h5 mb-1 section-title"><i class="bi bi-plus-circle-dotted"
							aria-hidden="true"></i><span>Form
							Catat
							Timbangan</span></h2>
					<p class="text-muted mb-0">Pilih akun warga dan timbang berat jenis sampahnya.</p>
				</div>
			</div>

			<div class="row g-3 mb-4">
				<div class="col-md-6">
					<label class="form-label fw-semibold" for="user_id">Pilih Warga / Nasabah <span
							class="text-danger">*</span></label>
					<select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id"
						required>
						<option value="" selected disabled>-- Pilih Akun Warga --</option>
						@foreach($warga as $warga)
						<option value="{{ $warga->id }}" {{ old('user_id')==$warga->id ? 'selected' : '' }}>
							{{ $warga->nama }} ({{ $warga->no_hp ?? 'Tidak ada No.HP' }})
						</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-6">
					<label class="form-label fw-semibold" for="catatan">Catatan Tambahan (Opsional)</label>
					<input type="text" class="form-control" id="catatan" name="catatan" value="{{ old('catatan') }}"
						placeholder="Contoh: Kondisi sampah bersih kering">
				</div>
			</div>

			<div class="border-top pt-4">
				<div class="d-flex justify-content-between align-items-center mb-3">
					<h3 class="h6 fw-bold mb-0 text-dark"><i class="bi bi-trash3 me-2 text-muted"></i>Item Kategori
						Sampah</h3>
					<button type="button" class="btn btn-outline-primary btn-sm fw-semibold" id="btnTambahItem">
						<i class="bi bi-plus-lg me-1"></i> Tambah Kategori Sampah
					</button>
				</div>

				<div id="wrapperItemSampah">
					<div class="row g-2 baris-sampah mb-2 align-items-end">
						<div class="col-md-7">
							<label class="form-label small fw-semibold text-muted mb-1">Kategori Sampah</label>
							<select class="form-select form-select-sm" name="items[0][kategori_id]" required>
								<option value="" selected disabled>-- Pilih Jenis Sampah --</option>
								@foreach($kategori as $kat)
								<option value="{{ $kat->id }}">{{ $kat->nama_kategori }} ({{
									number_format($kat->nilai_poin_per_kg) }} Poin/Kg)</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-4">
							<label class="form-label small fw-semibold text-muted mb-1">Berat Timbangan (Kg)</label>
							<div class="input-group input-group-sm">
								<input type="number" step="0.1" min="0.1" class="form-control" name="items[0][berat_kg]"
									placeholder="0.0" required>
								<span class="input-group-text bg-light text-muted">Kg</span>
							</div>
						</div>
						<div class="col-md-1 text-end">
							<button type="button" class="btn btn-light btn-sm text-danger border w-100 disabled"
								style="padding: 0.4rem;"><i class="bi bi-trash"></i></button>
						</div>
					</div>
				</div>
			</div>

			<div class="d-flex justify-content-end gap-2 mt-5 pt-3 border-top">
				<a href="{{ route('petugas.setoran.index') }}" class="btn btn-light text-muted">Batal</a>
				<button class="btn btn-primary px-4" type="submit">
					<i class="bi bi-check-lg me-1"></i> Simpan Setoran
				</button>
			</div>
		</form>
	</div>
</main>
@endsection

@section('js')
<script>
	document.addEventListener('DOMContentLoaded', function() {
        let indexItem = 1;
        const wrapper = document.getElementById('wrapperItemSampah');
        const btnTambah = document.getElementById('btnTambahItem');

        btnTambah.addEventListener('click', function() {
            let templateHTML = `
            <div class="row g-2 baris-sampah mb-2 align-items-end dynamic-row animate__animated animate__fadeIn">
                <div class="col-md-7">
                    <select class="form-select form-select-sm" name="items[${indexItem}][kategori_id]" required>
                        <option value="" selected disabled>-- Pilih Jenis Sampah --</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }} ({{ number_format($kat->nilai_poin_per_kg) }} Poin/Kg)</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <input type="number" step="0.1" min="0.1" class="form-control" name="items[${indexItem}][berat_kg]" placeholder="0.0" required>
                        <span class="input-group-text bg-light text-muted">Kg</span>
                    </div>
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-light btn-sm text-danger border w-100 btnHapusRow" style="padding: 0.4rem;"><i class="bi bi-trash"></i></button>
                </div>
            </div>`;
            
            wrapper.insertAdjacentHTML('beforeend', templateHTML);
            indexItem++;
        });

        // Event Hapus Baris Dinamis
        wrapper.addEventListener('click', function(e) {
            if (e.target.classList.contains('btnHapusRow') || e.target.closest('.btnHapusRow')) {
                const row = e.target.closest('.baris-sampah');
                row.remove();
            }
        });
    });
</script>
@endsection