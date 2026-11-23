@extends('layouts.app')

@section('css')
@endsection

@section('content')
<main class="dashboard-content">
	<div class="container-fluid px-3 px-lg-4 py-4">

		<div class="page-heading">
			<div class="page-heading-copy">
				<span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
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
						<span>Daftar Warga / Nasabah</span>
					</h2>
					<p class="text-muted mb-0">Kelola data keanggotaan warga yang berpartisipasi dalam tabungan bank
						sampah.</p>
				</div>

				<input class="form-control form-control-sm table-search" type="search"
					placeholder="Cari nama atau nomor HP..." data-table-search="wargaTable" aria-label="Cari warga">

				{{-- <a href="{{ route('admin.warga.create') }}"
					class="btn btn-primary d-inline-flex align-items-center gap-2">
					<i class="bi bi-plus-lg"></i> Tambah Warga
				</a> --}}
			</div>

			<div class="table-responsive">
				<table class="table align-middle mb-0" id="wargaTable" data-searchable-table>
					<thead>
						<tr>
							{{-- <th style="width: 5%">No</th> --}}
							<th>Nama Warga</th>
							<th>Alamat / RT-RW</th>
							<th>Status Akun</th>
							<th>Tanggal Terdaftar</th>
							<th class="text-end">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@forelse($warga as $key => $item)
						<tr>
							{{-- <td class="fw-semibold text-muted">{{ $warga->firstItem() + $key }}</td> --}}
							<td>
								<div class="d-flex align-items-center gap-3">
									<div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold"
										style="width: 40px; height: 40px; min-width: 40px;">
										{{ strtoupper(substr($item->nama, 0, 2)) }}
									</div>
									<div>
										<p class="fw-bold mb-0 text-dark">{{ $item->nama }}</p>
										<p class="text-muted small mb-0">
											<i class="bi bi-telephone text-muted me-1"></i>{{ $item->no_hp ?? '-' }}
										</p>
									</div>
								</div>
							</td>
							<td>
								<span class="d-inline-block text-truncate text-muted" style="max-width: 250px;"
									title="{{ $item->alamat }}">
									<i class="bi bi-geo-alt me-1"></i> {{ $item->alamat ?? '-' }}
								</span>
							</td>
							<td>
								@if($item->is_active == 1)
								<span class="badge text-bg-primary">Aktif</span>
								@else
								<span class="badge text-bg-secondary">Nonaktif</span>
								@endif
							</td>
							<td>
								<span class="text-muted small">
									<i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->translatedFormat('d M Y')
									}}
								</span>
							</td>
							<td class="text-end">
								<div class="d-inline-flex gap-1">
									<a href="{{ route('admin.warga.show', $item->id) }}" class="btn btn-light btn-sm"
										title="Lihat Profil">
										<i class="bi bi-eye text-primary"></i>
									</a>

									<a href="{{ route('admin.warga.edit', $item->id) }}" class="btn btn-light btn-sm"
										title="Edit Profil">
										<i class="bi bi-pencil-square text-warning"></i>
									</a>

									<form action="{{ route('admin.warga.toggle-status', $item->id) }}" method="POST"
										onsubmit="return confirm('Apakah Anda yakin ingin mengubah status warga {{ $item->nama }}?');">
										@csrf
										@method('PATCH')
										<button type="submit" class="btn btn-light btn-sm" title="Ubah Status">
											@if($item->aktif)
											<i class="bi bi-slash-circle text-danger"></i>
											@else
											<i class="bi bi-check-circle text-success"></i>
											@endif
										</button>
									</form>
								</div>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="6" class="text-center py-5 text-muted">
								<i class="bi bi-people fs-1 d-block mb-2 text-black-50"></i>
								Belum ada data warga yang terdaftar dalam sistem.
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>

			@if($warga->hasPages())
			<div class="panel-footer border-top p-3 bg-white">
				{{ $warga->links('pagination::bootstrap-5') }}
			</div>
			@endif
		</section>
	</div>
</main>
@endsection

@section('js')
@endsection