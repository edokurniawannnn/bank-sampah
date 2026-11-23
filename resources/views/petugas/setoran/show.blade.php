@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="mb-4 d-flex justify-content-between align-items-center">
			<a href="{{ route('petugas.setoran.index') }}" class="text-decoration-none text-muted">
				<i class="bi bi-arrow-left me-1"></i> Kembali ke Riwayat
			</a>
			<span class="text-muted small">ID Setoran: #{{ $setoran->id }}</span>
		</div>

		<div class="row g-4">
			<div class="col-12 col-xl-4">
				<div class="panel h-100">
					<div class="panel-header border-bottom pb-2 mb-3">
						<h3 class="h6 fw-bold mb-0">Ringkasan Nota</h3>
					</div>

					<div class="mb-3">
						<label class="text-muted small d-block">Nama Warga / Nasabah</label>
						<span class="fw-bold text-dark fs-5">{{ $setoran->warga->nama ?? 'Warga Terhapus' }}</span>
					</div>

					<div class="mb-3">
						<label class="text-muted small d-block">Tanggal Timbang</label>
						<span class="fw-semibold text-dark"><i class="bi bi-calendar-event me-2 text-muted"></i>{{
							$setoran->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
					</div>

					<div class="mb-3">
						<label class="text-muted small d-block">Petugas Pencatat</label>
						<span class="fw-semibold text-dark"><i class="bi bi-person-badge me-2 text-muted"></i>{{
							Auth::user()->nama ?? 'Sistem' }}</span>
					</div>

					<div class="mb-3">
						<label class="text-muted small d-block">Status Validasi</label>
						@if($setoran->status === 'pending')
						<span class="badge text-bg-warning px-3 py-2 mt-1"><i class="bi bi-clock me-1"></i>Menunggu
							Verifikasi</span>
						@else
						<span class="badge text-bg-success px-3 py-2 mt-1"><i
								class="bi bi-check-all me-1"></i>Terverifikasi & Selesai</span>
						@endif
					</div>

					<div class="mb-3 border-top pt-3">
						<label class="text-muted small d-block">Catatan Nota</label>
						<span class="text-muted fst-italic small">{{ $setoran->catatan ?: 'Tidak ada catatan tambahan.'
							}}</span>
					</div>
				</div>
			</div>

			<div class="col-12 col-xl-8">
				<div class="panel h-100 d-flex flex-column justify-content-between">
					<div>
						<div class="panel-header border-bottom pb-2 mb-3">
							<h3 class="h6 fw-bold mb-0"><i class="bi bi-list-check me-2 text-muted"></i>Rincian Berat
								Kategori</h3>
						</div>

						<div class="table-responsive">
							<table class="table align-middle">
								<thead class="table-light">
									<tr>
										<th>Kategori Sampah</th>
										<th class="text-center">Berat (Kg)</th>
										<th class="text-end">Estimasi Perolehan Poin</th>
									</tr>
								</thead>
								<tbody>
									@php $totalBerat = 0; $totalPoin = 0; @endphp
									@foreach($setoran->detailSetoran as $detail)
									@php
									$totalBerat += $detail->berat_kg;
									$totalPoin += $detail->poin_didapat;
									@endphp
									<tr>
										<td class="fw-semibold text-dark">{{ $detail->kategoriSampah->nama ??
											'Kategori Terhapus' }}</td>
										<td class="text-center fw-bold text-muted">{{ $detail->berat_kg }} Kg</td>
										<td class="text-end text-success fw-bold">+{{
											number_format($detail->poin_didapat) }} Poin</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot class="table-light border-top-2">
									<tr class="fw-bold fs-6">
										<td>TOTAL TIMBANGAN:</td>
										<td class="text-center text-dark">{{ $totalBerat }} Kg</td>
										<td class="text-end text-primary">{{ number_format($totalPoin) }} Poin</td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>

					<div class="pt-3 border-top mt-4">
						@if($setoran->status === 'pending')
						<form action="{{ route('petugas.setoran.verifikasi', $setoran->id) }}" method="POST"
							onsubmit="return confirm('Apakah Anda sudah memeriksa timbangan fisik dengan benar? Poin akan langsung dikirimkan ke saldo warga setelah diverifikasi.');">
							@csrf
							@method('PATCH')
							<button type="submit" class="btn btn-success w-100 py-2.5 fw-bold text-white shadow-sm">
								<i class="bi bi-shield-check me-2"></i> Verifikasi Timbangan & Cairkan Poin Warga
							</button>
						</form>
						@else
						<div class="alert alert-light border text-center text-muted small mb-0 p-2 rounded-3">
							<i class="bi bi-lock-fill me-1"></i> Transaksi ini sudah terkunci karena status telah
							Terverifikasi.
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>

	</div>
</main>
@endsection