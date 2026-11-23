@extends('layouts.app')

@section('css')
@endsection

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">
		<div class="page-heading">
			<div class="page-heading-copy">
				<span class="page-icon"><i class="bi bi-recycle" aria-hidden="true"></i></span>
				<div>
					<h1 class="h3 mb-1">{{ $judul }}</h1>
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

					<h2 class="h5 mb-1 section-title">
						<i class="bi bi-table" aria-hidden="true"></i>
						<span>Daftar Kategori Sampah</span>
					</h2>
				</div>
				<input class="form-control form-control-sm table-search" type="search" placeholder="Cari kategori..."
					data-table-search="kategoriTable" aria-label="Cari kategori">
				<a href="{{ route('admin.kategori-sampah.create') }}"
					class="btn btn-primary d-inline-flex align-items-center gap-2">
					<i class="bi bi-plus-lg"></i> Tambah Kategori
				</a>
			</div>

			<div class="table-responsive">
				<table class="table align-middle mb-0" id="kategoriTable" data-searchable-table>
					<thead>
						<tr>
							<th style="width: 5%">No</th>
							<th>Nama Kategori</th>
							<th>Nilai Poin</th>
							<th>Deskripsi</th>
							<th>Status</th>
							<th class="text-end">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@forelse($kategori as $key => $item)
						<tr>
							<td class="fw-semibold text-muted">{{ $kategori->firstItem() + $key }}</td>
							<td>
								<div class="table-media d-flex align-items-center gap-2">
									<div class="bg-light rounded p-2 text-success d-flex align-items-center justify-content-center"
										style="width: 40px; height: 40px;">
										<i class="bi bi-box-seam fs-5"></i>
									</div>
									<span class="fw-bold">{{ $item->nama }}</span>
								</div>
							</td>
							<td>
								<span class="badge text-bg-success fs-6">{{ $item->nilai_poin_per_kg }} Poin</span>
								<span class="text-muted ms-1">/ {{ $item->satuan }}</span>
							</td>
							<td>
								<span class="d-inline-block text-truncate" style="max-width: 200px;">
									{{ $item->deskripsi ?? '-' }}
								</span>
							</td>
							<td>
								@if($item->aktif)
								<span class="badge text-bg-primary">Aktif</span>
								@else
								<span class="badge text-bg-secondary">Nonaktif</span>
								@endif
							</td>
							<td class="text-end">
								<div class="d-inline-flex gap-1">
									<a href="{{ route('admin.kategori-sampah.edit', $item->id) }}"
										class="btn btn-light btn-sm" title="Edit">
										<i class="bi bi-pencil-square text-warning"></i>
									</a>
									<form action="{{ route('admin.kategori-sampah.destroy', $item->id) }}" method="POST"
										onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $item->nama }}?');">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-light btn-sm" title="Hapus">
											<i class="bi bi-trash text-danger"></i>
										</button>
									</form>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="6" class="text-center py-4 text-muted">
								<i class="bi bi-inbox fs-1 d-block mb-2"></i>
								Belum ada data kategori sampah yang ditambahkan.
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			@if($kategori->hasPages())
			<div class="panel-footer border-top p-3 bg-white">
				{{ $kategori->links('pagination::bootstrap-5') }}
			</div>
			@endif
		</section>
	</div>
</main>
@endsection

@section('js')
@endsection