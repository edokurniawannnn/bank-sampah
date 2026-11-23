@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="mb-4">
			<a href="{{ route('admin.warga.index') }}" class="text-decoration-none text-muted">
				<i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Warga
			</a>
		</div>

		<div class="row g-4">
			<div class="col-12 col-xl-4">
				<div class="panel h-100 text-center py-5">
					<div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold mx-auto mb-3 display-4"
						style="width: 120px; height: 120px;">
						{{ strtoupper(substr($warga->nama, 0, 2)) }}
					</div>
					<h3 class="h4 mb-1 fw-bold">{{ $warga->nama }}</h3>
					<p class="text-muted mb-3"><i class="bi bi-telephone"></i> {{ $warga->no_hp ?? 'Tidak ada kontak'
						}}</p>

					@if($warga->is_active)
					<span class="badge text-bg-success px-3 py-2 rounded-pill fs-6">Status Akun: Aktif</span>
					@else
					<span class="badge text-bg-secondary px-3 py-2 rounded-pill fs-6">Status Akun: Nonaktif</span>
					@endif

					<div class="mt-4 pt-4 border-top px-4 text-start">
						<p class="text-muted small mb-1">Tanggal Bergabung</p>
						<p class="fw-semibold"><i class="bi bi-calendar-check me-2"></i>{{
							$warga->created_at->translatedFormat('d F Y') }}</p>
					</div>
				</div>
			</div>

			<div class="col-12 col-xl-8">
				<div class="panel h-100">
					<div class="panel-header border-bottom pb-3 mb-4">
						<h2 class="h5 mb-0 section-title"><i class="bi bi-person-lines-fill me-2"></i>Informasi Warga
						</h2>
					</div>

					<div class="px-3 pb-3">
						<div class="row mb-4">
							<div class="col-sm-4 text-muted">Nama Lengkap</div>
							<div class="col-sm-8 fw-semibold">{{ $warga->nama }}</div>
						</div>
						<div class="row mb-4">
							<div class="col-sm-4 text-muted">Alamat Lengkap / RT RW</div>
							<div class="col-sm-8 fw-semibold">{{ $warga->alamat ?? 'Belum diisi' }}</div>
						</div>

						<div class="d-flex gap-2 mt-5 pt-4 border-top">
							<a href="{{ route('admin.warga.edit', $warga->id) }}"
								class="btn btn-warning text-dark px-4">
								<i class="bi bi-pencil-square me-1"></i> Ubah Data
							</a>

							<form action="{{ route('admin.warga.toggle-status', $warga->id) }}" method="POST">
								@csrf
								@method('PATCH')
								@if($warga->is_active)
								<button type="submit" class="btn btn-outline-danger px-4"
									onclick="return confirm('Nonaktifkan akun warga ini? Mereka tidak akan bisa login atau menukar poin.')">
									<i class="bi bi-slash-circle me-1"></i> Nonaktifkan Akun
								</button>
								@else
								<button type="submit" class="btn btn-outline-success px-4"
									onclick="return confirm('Aktifkan kembali akun warga ini?')">
									<i class="bi bi-check-circle me-1"></i> Aktifkan Akun
								</button>
								@endif
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>
@endsection