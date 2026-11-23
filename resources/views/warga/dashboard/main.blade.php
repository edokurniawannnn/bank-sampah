@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="page-heading mb-4">
			<div class="page-heading-copy">
				<div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm"
					style="width: 48px; height: 48px; font-size: 1.2rem;">
					{{ strtoupper(substr(Auth::user()->nama, 0, 2)) }}
				</div>
				<div>
					<h1 class="h3 mb-1">Halo, {{ explode(' ', Auth::user()->nama)[0] }}!</h1>
					<p class="text-muted mb-0">Selamat datang di tabungan Bank Sampah Digital Anda.</p>
				</div>
			</div>
		</div>

		<section class="row g-3 mt-1" aria-label="Dashboard metrics">
			<div class="col-12 col-md-6 col-xl-4">
				<article class="metric-card metric-primary bg-primary bg-gradient text-white shadow-sm border-0 h-100">
					<div class="metric-top">
						<span class="metric-label text-white-50 fw-semibold">Saldo Poin Aktif</span>
						<span class="metric-icon "><i class="bi bi-wallet2" aria-hidden="true"></i></span>
					</div>
					<div class="metric-value text-white">{{ number_format(Auth::user()->poin_saldo) }} <span
							class="fs-6 fw-normal">Poin</span></div>
					<div class="metric-meta text-white-50 mt-3 pt-3 border-top border-light border-opacity-25">
						<a href="{{ route('warga.reward.index') }}" class="text-white text-decoration-none fw-semibold">
							Tukar Poin Sekarang <i class="bi bi-arrow-right ms-1"></i>
						</a>
					</div>
				</article>
			</div>

			<div class="col-12 col-md-6 col-xl-4">
				<article class="metric-card metric-success h-100">
					<div class="metric-top">
						<span class="metric-label">Total Sampah Disetor</span>
						<span class="metric-icon"><i class="bi bi-recycle" aria-hidden="true"></i></span>
					</div>
					<div class="metric-value">{{ $stats['total_berat'] ?? 0 }} <span class="fs-6">Kg</span></div>
					<div class="metric-meta">
						<span class="text-muted">Sejak bergabung</span>
					</div>
				</article>
			</div>

			<div class="col-12 col-xl-4">
				<article class="metric-card metric-info h-100"
					style="background-color: #f8f9fa; border-left: 4px solid #0dcaf0;">
					<div class="metric-top">
						<span class="metric-label">Status Keanggotaan</span>
						<span class="metric-icon text-info"><i class="bi bi-person-badge" aria-hidden="true"></i></span>
					</div>
					<div class="mt-2">
						<span class="badge text-bg-success px-3 py-2 fs-6 rounded-pill"><i
								class="bi bi-check-circle me-1"></i> Akun Warga Aktif</span>
					</div>
					<div class="metric-meta mt-3">
						<span class="text-muted small"><i class="bi bi-geo-alt me-1"></i> {{ Auth::user()->rt_rw ??
							'Alamat belum lengkap' }}</span>
					</div>
				</article>
			</div>
		</section>

		<div class="row mt-4">
			<div class="col-12">
				<div class="panel border-0 shadow-sm bg-primary-subtle bg-opacity-25">
					<div class="p-4 d-flex align-items-center gap-3">
						<i class="bi bi-info-circle text-primary fs-2"></i>
						<div>
							<h4 class="h6 fw-bold text-dark mb-1">Cara Menyetor Sampah</h4>
							<p class="text-muted mb-0 small">Bawa sampah anorganik Anda yang sudah dipilah (Plastik,
								Kertas, Logam, Kaca) ke Posko Bank Sampah terdekat pada hari Sabtu atau Minggu. Petugas
								kami akan menimbang dan otomatis menambahkan poin ke akun Anda.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</main>
@endsection