@extends('layouts.app')

@section('css')
@endsection

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="page-heading mb-4">
			<div class="page-heading-copy">
				<span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
				<div>
					<h1 class="h3 mb-1">Dashboard Admin</h1>
					<p class="text-muted mb-0">Ringkasan data master Bank Sampah Digital.</p>
				</div>
			</div>
		</div>

		<section class="row g-3 mt-1" aria-label="Dashboard metrics">
			<div class="col-12 col-sm-6 col-xl-3">
				<article class="metric-card metric-primary">
					<div class="metric-top">
						<span class="metric-label">Kategori Sampah</span>
						<span class="metric-icon"><i class="bi bi-recycle" aria-hidden="true"></i></span>
					</div>
					<div class="metric-value">{{ $stats['total_kategori'] }} <span class="fs-5">Jenis</span></div>
				</article>
			</div>

			<div class="col-12 col-sm-6 col-xl-3">
				<article class="metric-card metric-success">
					<div class="metric-top">
						<span class="metric-label">Mitra Aktif</span>
						<span class="metric-icon"><i class="bi bi-shop" aria-hidden="true"></i></span>
					</div>
					<div class="metric-value">{{ $stats['total_mitra'] }} <span class="fs-5">Mitra</span></div>
				</article>
			</div>

			<div class="col-12 col-sm-6 col-xl-3">
				<article class="metric-card metric-warning">
					<div class="metric-top">
						<span class="metric-label">Reward Aktif</span>
						<span class="metric-icon"><i class="bi bi-gift" aria-hidden="true"></i></span>
					</div>
					<div class="metric-value">{{ $stats['total_reward'] }} <span class="fs-5">Item</span></div>
				</article>
			</div>

			<div class="col-12 col-sm-6 col-xl-3">
				<article class="metric-card metric-primary">
					<div class="metric-top">
						<span class="metric-label">Total Warga Terdaftar</span>
						<span class="metric-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
					</div>
					<div class="metric-value">{{ $stats['total_warga'] }} <span class="fs-5">Warga</span></div>
				</article>
			</div>
		</section>

	</div>
</main>
@endsection

@section('js')
@endsection