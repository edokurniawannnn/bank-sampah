@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
			<div class="page-heading mb-0">
				<div class="page-heading-copy">
					<span class="page-icon"><i class="bi bi-gift" aria-hidden="true"></i></span>
					<div>
						<h1 class="h3 mb-1">Katalog Penukaran</h1>
						<p class="text-muted mb-0">Tukar saldo poin Anda dengan sembako atau hadiah menarik lainnya.</p>
					</div>
				</div>
			</div>

			<div class="bg-white border rounded-pill px-4 py-2 shadow-sm d-inline-flex align-items-center gap-2">
				<span class="text-muted small fw-semibold">Saldo Anda:</span>
				<span class="fw-bold text-primary fs-5">{{ number_format(Auth::user()->poin_saldo) }} <i
						class="bi bi-p-circle-fill"></i></span>
			</div>
		</div>

		@if(session('success'))
		<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
			<i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		@if(session('error'))
		<div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
			<i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		@endif

		<div class="row g-4">
			@forelse($reward as $item)
			<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
				<div class="card h-100 border-0 shadow-sm panel hover-lift">
					<div class="bg-light d-flex align-items-center justify-content-center border-bottom position-relative"
						style="height: 180px;">
						<i class="bi bi-bag-heart text-secondary opacity-50" style="font-size: 4rem;"></i>

						<span class="position-absolute top-0 end-0 m-2 badge bg-primary text-white shadow-sm">
							{{ $item->mitra->nama_mitra ?? 'Sistem' }}
						</span>
					</div>

					<div class="card-body d-flex flex-column">
						<h3 class="h6 fw-bold mb-1 text-dark">{{ $item->nama_reward }}</h3>
						<p class="text-muted small mb-3 line-clamp-2">{{ $item->deskripsi }}</p>

						<div class="mt-auto d-flex justify-content-between align-items-end mb-3">
							<div>
								<span class="d-block text-muted" style="font-size: 0.7rem;">DIBUTUHKAN</span>
								<span class="fw-bold text-primary fs-5">{{ number_format($item->poin_diperlukan) }}
									<small class="text-muted fs-6 fw-normal">Poin</small></span>
							</div>
							<div class="text-end">
								<span class="d-block text-muted" style="font-size: 0.7rem;">SISA STOK</span>
								<span class="fw-semibold {{ $item->stok > 5 ? 'text-success' : 'text-danger' }}">{{
									$item->stok }} Unit</span>
							</div>
						</div>

						<form action="{{ route('warga.reward.tukar', $item->id) }}" method="POST">
							@csrf
							@php
							$poinCukup = Auth::user()->poin_saldo >= $item->poin_dibutuhkan;
							$stokAda = $item->stok > 0;
							$bisaTukar = $poinCukup && $stokAda && $item->aktif;
							@endphp

							<button type="submit"
								class="btn w-100 fw-semibold {{ $bisaTukar ? 'btn-outline-primary' : 'btn-light text-muted' }}"
								{{ $bisaTukar ? '' : 'disabled' }}
								onclick="return confirm('Tukar {{ number_format($item->poin_dibutuhkan) }} Poin Anda dengan {{ $item->nama_reward }}?')">

								@if(!$item->aktif)
								<i class="bi bi-slash-circle me-1"></i> Tidak Tersedia
								@elseif(!$stokAda)
								<i class="bi bi-box-seam-fill me-1"></i> Stok Habis
								@elseif(!$poinCukup)
								<i class="bi bi-lock-fill me-1"></i> Poin Kurang
								@else
								<i class="bi bi-cart-plus me-1"></i> Tukar Sekarang
								@endif
							</button>
						</form>
					</div>
				</div>
			</div>
			@empty
			<div class="col-12">
				<div class="panel p-5 text-center text-muted">
					<i class="bi bi-gift fs-1 d-block mb-3 text-black-50"></i>
					<h4 class="h5">Katalog Sedang Kosong</h4>
					<p class="mb-0">Saat ini belum ada hadiah atau sembako yang tersedia untuk ditukarkan.</p>
				</div>
			</div>
			@endforelse
		</div>

	</div>
</main>
@endsection