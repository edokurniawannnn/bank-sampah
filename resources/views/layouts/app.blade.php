<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="adminHMD professional admin dashboard template">
	<title>Dashboard | Bank Sampah</title>

	<link rel="stylesheet" href="{{ asset('adminhmd/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('adminhmd/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('adminhmd/assets/css/style.css') }}">

	@yield('css')
</head>

<body>
	<div class="admin-shell">
		@include('layouts.components.sidebar')

		<div class="admin-main">
			@include('layouts.components.navbar')


			@yield('content')


			@include('layouts.components.footer')
		</div>
	</div>

	@yield('js')
	<script src="{{ asset('adminhmd/assets/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('adminhmd/assets/js/main.js') }}"></script>
</body>

</html>