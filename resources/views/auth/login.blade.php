<!doctype html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Language" content="en" />
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="theme-color" content="#5eba00">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<link rel="manifest" href="{{ asset('manifest.json') }}">
	<link rel="icon" href="{{ asset('favicon.ico')}} " type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico')}}" />
	<!-- Generated: 2018-04-16 09:29:05 +0200 -->
	<title>SPPUjikom | Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
	
	<!-- NProgress Plugin -->
	<link href="{{ asset('plugins/nprogress/nprogress.min.css')}}" rel="stylesheet" />
	<script src="{{ asset('plugins/nprogress/nprogress.min.js')}}"></script>
	
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
	<!-- Input Mask Plugin -->
	<script src="{{ asset('plugins/input-mask/plugin.js')}}"></script>
	<!-- Custom CSS -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
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
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <div class="text-center mb-6">
							<img
								height="300px"
								src="/images/sppujikom-web-logo.svg"
								class="h-6"
								alt=""
							/>
						</div>
                        <form class="card" action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="card-body p-6">
                                <div class="card-title text-center"><h3>Login</h3></div>
                                <div class="form-group">
                                    <label class="form-label">Username</label>
									<input type="text" name="username" id="username" class="form-control {{ ($errors->has('username')) ? 'is-invalid' : '' }}" placeholder="Masukan username" value="{{ old('username') }}">
                                    @if($errors->has('username'))
                                        <small class="form-text invalid-feedback" style="display: block !important">{{ $errors->first('username') }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" id="exampleInputPassword1" placeholder="Password">
                                    @if($errors->has('password'))
                                            <small class="form-text invalid-feedback">{{ $errors->first('password') }}</small>
                                    @endif
								</div>
								@if (session('error'))
									<div class="alert alert-danger">{{ session('error') }}</div>
								@endif
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>
	
	<script>
		require(['jquery', 'moment'], function ($, moment) {
			NProgress.start();
			$(window).bind("load", function() {
				NProgress.done();
			});
		});
	</script>
</body>
</html>