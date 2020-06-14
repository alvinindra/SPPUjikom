<!doctype html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Language" content="en" />
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="theme-color" content="#4188c9">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<link rel="manifest" href="{{ asset('manifest.json') }}">
	<link rel="icon" href="{{ asset('favicon.ico')}} " type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico')}}" />
	
	<title>SPPUjikom | @yield('page-name')</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
	<script src="{{ asset('js/require.min.js')}}"></script>
	<script>
		requirejs.config({
			baseUrl: '.'
		});
	</script>
	<script>
	// REGISTER SERVICE WORKER
	if ('serviceWorker' in navigator) {
		window.addEventListener('load', function() {
			navigator.serviceWorker.register('{{ asset('service-worker.js') }}')
			.then(function() {
				console.log('Pendaftaran ServiceWorker berhasil');
			})
			.catch(function(){
				console.log('Pendaftaran ServiceWorker gagal');
			});
		})
	} else {
		console.log("ServiceWorker belum didukung browser ini.")
	}    
	</script>
	<!-- Dashboard Core -->
	<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
	<script src="{{ asset('js/dashboard.js')}}"></script>
	<!-- c3.js Charts Plugin -->
	<link href="{{ asset('plugins/charts-c3/plugin.css')}}" rel="stylesheet" />
	<script src="{{ asset('plugins/charts-c3/plugin.js')}}"></script>
	<!-- Google Maps Plugin -->
	<link href="{{ asset('plugins/maps-google/plugin.css')}}" rel="stylesheet" />
	<script src="{{ asset('plugins/maps-google/plugin.js')}}"></script>
	<!-- Input Mask Plugin -->
	<script src="{{ asset('plugins/input-mask/plugin.js')}}"></script>
	<style>
		body {
			overflow: auto;
		}
	</style>
	<!-- Custom CSS -->
	@yield('css')
</head>
<body class="">
    <div class="page">
        <div class="flex-fill">
			<div class="header py-4">
				<div class="container">
					<div class="d-flex justify-content-center">
						<a class="header-brand" href="{{ route('users.dashboard') }}">
							<img src="/images/sppujikom-web-logo.svg" class="header-brand-img" alt="sppujikom logo" />
						</a>
					</div>
				</div>
			</div>
			<div class="my-3 my-md-5">
				<div class="container">
					@yield('content')
				</div>
			</div>
		</div>
		<footer class="footer">
			<div class="container">
				<div class="row align-items-center flex-row-reverse">
					<div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
						Copyright © {{ date('Y') }} - By
                        <a href="https://alvinindra.me" target="_blank">Alvin Indra Pratama</a> All rights reserved.
					</div>
				</div>
			</div>
		</footer>
    </div>
</body>
</html>