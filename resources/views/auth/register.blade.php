<!doctype html>
<html lang="id">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Halaman Pendaftaran Warga Bank Sampah" />
	<title>Daftar Akun | Bank Sampah Digital</title>

	<link rel="stylesheet" href="{{ asset('adminhmd/assets/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('adminhmd/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}" />
	<link rel="stylesheet" href="{{ asset('adminhmd/assets/css/style.css') }}" />
</head>

<body class="auth-body">
	<button class="icon-button theme-toggle auth-theme-toggle" type="button" data-theme-toggle
		aria-label="Switch color theme" title="Switch color theme">
		<i class="bi bi-moon-stars" data-theme-icon aria-hidden="true"></i>
	</button>

	<main class="auth-page">
		<section class="auth-card">
			<a class="auth-brand text-decoration-none" href="{{ url('/') }}">
				<span class="brand-icon"><i class="bi bi-recycle" aria-hidden="true"></i></span>
				<span>
					<strong>Bank Sampah Digital</strong>
					<small>Buat akun nasabah / warga baru.</small>
				</span>
			</a>

			<form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
				@csrf

				<div class="mb-4">
					<p class="eyebrow mb-1">Akses Terlindungi</p>
					<h1 class="h3 mb-1">Daftar Akun</h1>
					<p class="text-muted mb-0">Lengkapi data diri untuk mulai menabung sampah.</p>
				</div>

				<div class="mb-3">
					<label class="form-label fw-semibold" for="name">Nama Lengkap <span
							class="text-danger">*</span></label>
					<input class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" type="text"
						value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autofocus />

					@error('nama')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Nama lengkap wajib diisi.</div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label fw-semibold" for="email">Alamat Email <span
							class="text-danger">*</span></label>
					<input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
						type="email" value="{{ old('email') }}" placeholder="contoh@email.com" required />

					@error('email')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Masukkan alamat email yang valid.</div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label fw-semibold" for="password">Password <span
							class="text-danger">*</span></label>
					<input class="form-control @error('password') is-invalid @enderror" id="password" name="password"
						type="password" minlength="8" placeholder="Minimal 8 karakter" required />

					@error('password')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Password wajib diisi (minimal 8 karakter).</div>
					@enderror
				</div>

				<div class="mb-3">
					<label class="form-label fw-semibold" for="password_confirmation">Konfirmasi Password <span
							class="text-danger">*</span></label>
					<input class="form-control" id="password_confirmation" name="password_confirmation" type="password"
						minlength="8" placeholder="Ketik ulang password" required />
					<div class="invalid-feedback">Konfirmasi password wajib diisi.</div>
				</div>

				<div class="form-check mb-4">
					<input class="form-check-input" type="checkbox" id="terms" name="terms" required />
					<label class="form-check-label text-muted" for="terms">
						Saya setuju dengan <a href="#" class="text-decoration-none">syarat dan ketentuan</a> yang
						berlaku.
					</label>
					<div class="invalid-feedback">Anda harus menyetujui syarat & ketentuan sebelum melanjutkan.</div>
				</div>

				<button class="btn btn-primary w-100 fw-semibold" type="submit">
					<i class="bi bi-person-plus me-1" aria-hidden="true"></i> Buat Akun Warga
				</button>
			</form>

			<div class="auth-footer mt-4 text-center">
				Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Masuk di
					sini</a>
			</div>
		</section>
	</main>

	<script src="{{ asset('adminhmd/assets/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('adminhmd/assets/js/main.js') }}"></script>
	<script>
		(() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
	</script>
</body>

</html>