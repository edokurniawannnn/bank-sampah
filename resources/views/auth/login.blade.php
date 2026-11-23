<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Halaman Login Bank Sampah">
	<title>Login | Bank Sampah Digital</title>

	<link rel="stylesheet" href="{{ asset('adminhmd/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{ asset('adminhmd/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
	<link rel="stylesheet" href="{{ asset('adminhmd/assets/css/style.css')}}">
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
				<span><strong>Bank Sampah Digital</strong></span>
			</a>

			<form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
				@csrf

				<div class="mb-4">
					<p class="h3 mb-1">Login Admin</p>
				</div>

				@if ($errors->any())
				<div
					class="alert alert-danger p-3 small mb-4 rounded-3 border-0 border-start border-danger border-4 shadow-sm">
					<ul class="mb-0 ps-3">
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				<div class="mb-3">
					<label class="form-label fw-semibold" for="email">Alamat Email</label>
					<input class="form-control @error('email') is-invalid @enderror" id="email" type="email"
						name="email" value="{{ old('email') }}" required autofocus>

					@error('email')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Masukkan alamat email yang valid.</div>
					@enderror
				</div>

				<div class="mb-3">
					<div class="d-flex justify-content-between">
						<label class="form-label fw-semibold" for="password">Password</label>
						@if (Route::has('password.request'))
						<a class="small fw-semibold text-decoration-none" href="{{ route('password.request') }}">Lupa
							Password?</a>
						@endif
					</div>
					<input class="form-control @error('password') is-invalid @enderror" id="password" type="password"
						name="password" minlength="6" required>

					@error('password')
					<div class="invalid-feedback">{{ $message }}</div>
					@else
					<div class="invalid-feedback">Password wajib diisi (minimal 6 karakter).</div>
					@enderror
				</div>

				<div class="form-check mb-4">
					<input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember')
						? 'checked' : '' }}>
					<label class="form-check-label text-muted" for="remember">Ingat Saya</label>
				</div>

				<button class="btn btn-primary w-100 fw-semibold" type="submit">
					<i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i> Masuk Sekarang
				</button>
			</form>

			<div class="auth-footer mt-4 text-center">
				Belum punya akun?
				@if (Route::has('register'))
				<a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar sebagai warga</a>
				@else
				<a href="#" class="text-decoration-none fw-semibold">Hubungi Pengurus</a>
				@endif
			</div>
		</section>
	</main>

	<script src="{{ asset('adminhmd/assets/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{ asset('adminhmd/assets/js/main.js')}}"></script>
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