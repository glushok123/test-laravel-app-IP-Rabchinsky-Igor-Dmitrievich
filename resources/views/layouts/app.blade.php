
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('description')">
	<meta name="keywords" content="@yield('keywords')">
	<meta name="title" content="@yield('title')" />
	<meta name="robots" content="index,follow" />
	<meta name="revisit-after" content="2 days">
	<meta name="coverage" content="Worldwide">
	<meta name="distribution" content="Global">
	<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title')</title>

	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="{{ asset('js/bootstrap/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('js/toastr/toastr.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
	integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<script src="{{ asset('js/jquery/jquery.js') }}" ></script>
	<script src="{{ asset('js/bootstrap/bootstrap.js') }}" ></script>
	<script src="{{ asset('js/toastr/toastr.js') }}" ></script>
	<script src="https://kit.fontawesome.com/6a4e5ddf0a.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>
</head>

<body class='d-flex flex-column min-vh-100'>
	<div id="app">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
			  <a class="navbar-brand" href="{{ url('/') }}">AMISAMI</a>
			  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				  <!--li class="nav-item"><a class="nav-link" href="{{ url('/searchProduct') }}">Поиск товаров</a></li-->

				  @if (backpack_auth()->guest())
						<!--li class="nav-item"><a class="nav-link" href="{{ backpack_url('login') }}">Авторизация</a> </!--li--> 
					@endif

					@if (backpack_auth()->check())
						<!--li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> {{ backpack_user()->name }}</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">Личный кабинет</a></li>
								<li><a class="dropdown-item" href="#">Заказы</a></li>
								<li><a class="dropdown-item" href="#">Настройки</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >Выйти из аккаунта</a><form id="logout-form" action="{{ backpack_url('logout') }}" method="POST" class="d-none"> @csrf </form></li>
							</ul>
						</li-->
					@endif

				</ul>
			  </div>
			</div>
		  </nav>
	</div>

	<br>
	@yield('content')

	@yield('before_scripts')

	@yield('after_scripts')

	<hr>
	<div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
		Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
	</div>
	<hr>

</body>

</html>