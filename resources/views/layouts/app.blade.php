<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Form service</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	@stack('css')
</head>
<body class="font-sans antialiased">
<script>
	window.Laravel = {!!json_encode([
               'isLoggedin' => true,
               'user' => 'bba',
               'csrf' => csrf_token(),
           ])!!}
</script>

<div class="flex flex-row min-h-screen bg-gray-100 text-gray-800">
	@include('partials.sidebar')
	<main class="main flex flex-col flex-grow -ml-64 md:ml-0 transition-all duration-150 ease-in">
		@include('partials.header')
		<div class="main-content flex flex-col flex-grow p-4">
			@yield('content')

		</div>
	</main>
</div>
<!--
<div id="app" class="mt-6">
	<form-title></form-title>
</div>-->

@routes
<script src="{{ asset('js/app.js') }}"></script>
@stack('js')
</body>
</html>