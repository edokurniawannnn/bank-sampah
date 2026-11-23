@extends('layouts.app')

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="page-heading">
			<div class="page-heading-copy">
				<span class="page-icon"><i class="bi bi-journal-text" aria-hidden="true"></i></span>
				<div>
					<h1 class="h3 mb-1">Riwayat Setoran Sampah</h1>
				</div>
			</div>

			@if(session('success'))
			<div class="alert alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
				<i class="bi bi-check-circle me-2"></i> {{ session('success') }}
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			@endif
		</div>

		<section class="panel mt-4">
			<div class="panel-header">
				<div>
					<h2 class="h5 mb-1 section-title"><i class="bi bi-table" aria-hidden="true"></i><span>Data
							Timbangan</span></h2>
					<p class="text-muted mb-0">Daftar seluruh setoran masuk baik status pending maupun terverifikasi.
					</p>
				</div>

				<input class="form-control form-control-sm table-search" type="search" placeholder="Cari nama warga..."
					data-table-search="setoranTable">

				<a href="{{ route('petugas.setoran.create') }}"
					class="btn btn-primary d-inline-flex align-items-center gap-2">
					<i class="bi bi-plus-lg"></i> Input Setoran
				</a>
			</div>

			<div class="table-responsive">
				<table class="table align-middle mb-0" id="setoranTable">
					<thead class="table-light">
						<tr>
							<th style="width: 5%">No</th>
							<th>Tanggal Timbang</th>
							<th>Nama Warga</th>
							<th>Status</th>
							<th>Catatan</th>
							<th class="text-end pe-4">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@forelse($setoran as $key => $item)
						<tr>
							<td class="fw-semibold text-muted">{{ $setoran->firstItem() + $key }}</td>

							<td>
								<span class="text-muted small fw-semibold">
									<i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->translatedFormat('d M Y,
									H:i') }}
								</span>
							</td>

							<td class="fw-bold text-dark">
								{{ $item->warga->nama ?? 'Warga Terhapus' }}
							</td>

							<td>
								@if($item->status === 'pending')
								<span class="badge text-bg-warning px-2 py-1"><i
										class="bi bi-clock me-1"></i>Pending</span>
								@else
								<span class="badge text-bg-success px-2 py-1"><i
										class="bi bi-check-circle me-1"></i>Terverifikasi</span>
								@endif
							</td>

							<td class="text-muted small">
								{{ Str::limit($item->catatan, 35, '...') ?: '-' }}
							</td>

							<td class="text-end pe-4">
								<a href="{{ route('petugas.setoran.show', $item->id) }}"
									class="btn btn-light btn-sm px-3 border" title="Lihat Detail Transaksi">
									<i class="bi bi-eye text-primary me-1"></i> Detail
								</a>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="6" class="text-center py-5 text-muted">
								<i class="bi bi-box-seam fs-1 d-block mb-3 text-black-50"></i>
								Belum ada transaksi setoran yang dicatat.
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			@if($setoran->hasPages())
			<div class="panel-footer border-top p-3 bg-white">
				{{ $setoran->links('pagination::bootstrap-5') }}
			</div>
			@endif
		</section>
	</div>
</main>
@endsection