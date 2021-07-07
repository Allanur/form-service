<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Form service</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-50">
<form action="{{ route('login') }}" method="post" autocomplete="off">
	@csrf
	<div class="bg-white p-8 rounded-xl w-5/12 max-w-3xl mx-auto mt-40 shadow-xl">

		<div class="text-xl text-blue-500 font-bold text-center">Login Page</div>

		<div class="mt-8">
			<input type="text" name="username" placeholder="Username"
						 class="w-full rounded-lg bg-gray-50 border py-3 px-4 focus:shadow-lg focus:outline-none transition-shadow">
		</div>

		<div class="mt-6">
			<input type="password" name="password" placeholder="Password"
						 class="w-full rounded-lg bg-gray-50 border py-3 px-4 focus:shadow-lg focus:outline-none transition-shadow">
		</div>

		<div class="flex mt-6">
			<button class="w-1/2 btn btn-blue mx-auto h-12">
				Login
			</button>
		</div>
	</div>
</form>
</body>
</html>
