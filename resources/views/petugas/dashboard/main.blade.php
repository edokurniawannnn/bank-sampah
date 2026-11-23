@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="page-heading mb-4">
			<div class="page-heading-copy">
				<span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
				<div>
					<h1 class="h3 mb-1">Dashboard Petugas</h1>
					<p class="text-muted mb-0">Selamat bekerja! Pantau dan catat setoran sampah warga hari ini.</p>
				</div>
			</div>
		</div>

		<section class="row g-3 mt-1" aria-label="Dashboard metrics">
			<div class="col-12 col-sm-6 col-xl-4">
				<article class="metric-card metric-primary">
					<div class="metric-top">
						<span class="metric-label">Setoran Masuk Hari Ini</span>
						<span class="metric-icon"><i class="bi bi-box-seam" aria-hidden="true"></i></span>
					</div>
					<div class="metric-value">12 <span class="fs-5">Transaksi</span></div>
				</article>
			</div>

			<div class="col-12 col-sm-6 col-xl-4">
				<article class="metric-card metric-warning">
					<div class="metric-top">
						<span class="metric-label">Menunggu Verifikasi (Pending)</span>
						<span class="metric-icon"><i class="bi bi-clock-history" aria-hidden="true"></i></span>
					</div>
					<div class="metric-value">3 <span class="fs-5">Setoran</span></div>
				</article>
			</div>

			<div class="col-12 col-sm-6 col-xl-4">
				<article class="metric-card metric-success">
					<div class="metric-top">
						<span class="metric-label">Total Timbangan Hari Ini</span>
						<span class="metric-icon"><i class="bi bi-scale" aria-hidden="true"></i></span>
					</div>
					<div class="metric-value">148.5 <span class="fs-5">Kg</span></div>
				</article>
			</div>
		</section>

		<div class="row g-3 mt-3">
			<div class="col-12">
				<div class="panel text-center py-4">
					<h3 class="h5 mb-2">Mulai Pencatatan Timbangan Warga?</h3>
					<p class="text-muted mb-3">Pastikan sampah sudah dipilah sesuai kategori sebelum diinput.</p>
					<a href="{{ route('petugas.setoran.create') }}" class="btn btn-primary px-4 py-2">
						<i class="bi bi-plus-circle me-1"></i> Input Setoran Baru
					</a>
				</div>
			</div>
		</div>

	</div>
</main>
@endsection