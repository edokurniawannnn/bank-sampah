@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="page-heading mb-4">
			<div class="page-heading-copy">
				<span class="page-icon"><i class="bi bi-truck" aria-hidden="true"></i></span>
				<div>
					<h1 class="h3 mb-1">Riwayat Setoran Sampah</h1>
					<p class="text-muted mb-0">Pantau status setoran fisik sampah Anda ke petugas.</p>
				</div>
			</div>
		</div>

		<section class="panel mt-2">
			<div class="panel-header border-bottom pb-3 mb-2">
				<h2 class="h5 mb-0 section-title"><i class="bi bi-list-ul" aria-hidden="true"></i><span>Daftar Setoran
						Saya</span></h2>
			</div>

			<div class="table-responsive">
				<table class="table align-middle mb-0">
					<thead class="table-light">
						<tr>
							<th style="width: 15%">Tanggal</th>
							<th>Status Validasi</th>
							<th>Rincian Sampah</th>
							<th class="text-end">Estimasi / Total Poin</th>
						</tr>
					</thead>
					<tbody>
						@forelse($setoran as $trx)
						<tr>
							<!-- Tanggal Setoran -->
							<td>
								<span class="text-muted small fw-semibold d-block">
									{{ $trx->created_at->translatedFormat('d M Y') }}
								</span>
								<span class="text-muted" style="font-size: 0.75rem;">
									{{ $trx->created_at->format('H:i') }} WIB
								</span>
							</td>

							<!-- Status -->
							<td>
								@if($trx->status === 'pending')
								<span
									class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1">
									<i class="bi bi-clock-history me-1"></i> Menunggu
								</span>
								@elseif($trx->status === 'verified')
								<span
									class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
									<i class="bi bi-check-circle me-1"></i> Selesai
								</span>
								@else
								<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
									<i class="bi bi-x-circle me-1"></i> Ditolak
								</span>
								@endif
							</td>

							<!-- Rincian Sampah (Mengambil dari relasi detailSetoran) -->
							<td>
								<ul class="list-unstyled mb-0 small text-muted">
									@forelse($trx->detailSetoran as $detail)
									<li>
										<i class="bi bi-dot"></i>
										{{ $detail->kategoriSampah->nama_kategori ?? 'Kategori' }}
										<span class="fw-semibold">({{ $detail->berat_kg }} kg)</span>
									</li>
									@empty
									<span class="fst-italic">Detail belum tersedia</span>
									@endforelse
								</ul>
								@if($trx->catatan)
								<div class="mt-1 text-muted" style="font-size: 0.7rem;">
									<em>Catatan: {{ $trx->catatan }}</em>
								</div>
								@endif
							</td>

							<!-- Total Poin -->
							<td
								class="text-end fw-bold {{ $trx->status === 'verified' ? 'text-success' : 'text-secondary' }}">
								+{{ number_format($trx->total_poin) }} Poin
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="4" class="text-center py-5 text-muted">
								<i class="bi bi-inboxes fs-1 d-block mb-3 text-black-50"></i>
								Anda belum memiliki riwayat setoran sampah.
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			<!-- Pagination -->
			@if($setoran->hasPages())
			<div class="panel-footer border-top p-3 bg-white">
				{{ $setoran->links('pagination::bootstrap-5') }}
			</div>
			@endif
		</section>

	</div>
</main>
@endsection