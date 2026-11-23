<div class="sidebar-backdrop" data-sidebar-close></div>

<aside class="admin-sidebar" id="adminSidebar" aria-label="Main navigation">
	<div class="sidebar-header">
		<a class="brand-mark" href="{{ route('login') }}" aria-label="Bank Sampah Digital">
			<span class="brand-icon"><i class="bi bi-trash2-fill" aria-hidden="true"></i></span>
			<span class="brand-copy">
				<span class="brand-title">Bank Sampah Digital</span>
				<span class="brand-subtitle">Tukar Sampahmu Dengan Hadiah</span>
			</span>
		</a>
	</div>

	<nav class="sidebar-nav">

		@if(auth()->user()->role === 'admin')

		<a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
			href="{{ route('admin.dashboard') }}">
			<span class="nav-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
			<span class="nav-text">Dashboard</span>
		</a>

		<h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted text-uppercase" style="font-size:0.75rem;font-weight:600;">
			<span>Master Data</span>
		</h6>

		@php
		$isMasterActive = request()->routeIs(['admin.warga.*', 'admin.kategori-sampah.*', 'admin.mitra.*',
		'admin.reward.*']);
		@endphp

		<a class="nav-link {{ $isMasterActive ? 'active' : 'collapsed' }}" data-bs-toggle="collapse"
			href="#collapseMasterData" role="button" aria-expanded="{{ $isMasterActive ? 'true' : 'false' }}"
			aria-controls="collapseMasterData">
			<span class="nav-icon"><i class="bi bi-database" aria-hidden="true"></i></span>
			<span class="nav-text">Kelola Data Master</span>
			<span class="ms-auto"><i class="bi bi-chevron-down"></i></span>
		</a>

		<div class="collapse {{ $isMasterActive ? 'show' : '' }}" id="collapseMasterData">
			<ul class="nav flex-column ms-3 mt-1">
				<li class="nav-item mb-1">
					<a class="nav-link {{ request()->routeIs('admin.warga.*') ? 'active' : '' }}"
						href="{{ route('admin.warga.index') }}" style="font-size:0.9rem;">
						<span class="nav-icon"><i class="bi bi-people"></i></span>
						<span class="nav-text">Data Warga</span>
					</a>
				</li>
				<li class="nav-item mb-1">
					<a class="nav-link {{ request()->routeIs('admin.kategori-sampah.*') ? 'active' : '' }}"
						href="{{ route('admin.kategori-sampah.index') }}" style="font-size:0.9rem;">
						<span class="nav-icon"><i class="bi bi-recycle"></i></span>
						<span class="nav-text">Kategori Sampah</span>
					</a>
				</li>
				<li class="nav-item mb-1">
					<a class="nav-link {{ request()->routeIs('admin.mitra.*') ? 'active' : '' }}"
						href="{{ route('admin.mitra.index') }}" style="font-size:0.9rem;">
						<span class="nav-icon"><i class="bi bi-shop"></i></span>
						<span class="nav-text">Data Mitra</span>
					</a>
				</li>
				<li class="nav-item mb-1">
					<a class="nav-link {{ request()->routeIs('admin.reward.*') ? 'active' : '' }}"
						href="{{ route('admin.reward.index') }}" style="font-size:0.9rem;">
						<span class="nav-icon"><i class="bi bi-gift"></i></span>
						<span class="nav-text">Katalog Reward</span>
					</a>
				</li>
			</ul>
		</div>

		@elseif(auth()->user()->role === 'petugas')

		<a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}"
			href="{{ route('petugas.dashboard') }}">
			<span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
			<span class="nav-text">Dashboard</span>
		</a>
		<a class="nav-link {{ request()->routeIs('petugas.setoran.*') ? 'active' : '' }}"
			href="{{ route('petugas.setoran.index') }}">
			<span class="nav-icon"><i class="bi bi-truck"></i></span>
			<span class="nav-text">Riwayat Setoran</span>
		</a>

		@else {{-- warga --}}

		<a class="nav-link {{ request()->routeIs('warga.dashboard') ? 'active' : '' }}"
			href="{{ route('warga.dashboard') }}">
			<span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
			<span class="nav-text">Dashboard</span>
		</a>
		<a class="nav-link {{ request()->routeIs('warga.riwayat') ? 'active' : '' }}"
			href="{{ route('warga.riwayat') }}">
			<span class="nav-icon"><i class="bi bi-truck"></i></span>
			<span class="nav-text">Riwayat Setoran</span>
		</a>
		<a class="nav-link {{ request()->routeIs('warga.reward.*') ? 'active' : '' }}"
			href="{{ route('warga.reward.index') }}">
			<span class="nav-icon"><i class="bi bi-gift"></i></span>
			<span class="nav-text">Tukar Reward</span>
		</a>

		@endif

		<a href="{{ route('logout') }}" class="nav-link"
			onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin Logout?')) { document.getElementById('logout-form').submit(); }">
			<i class="nav-icon bi bi-box-arrow-right"></i>
			<p>
				Logout
			</p>
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" style="display: none;">
			@csrf
		</form>
	</nav>
</aside>