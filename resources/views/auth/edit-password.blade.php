@extends('layouts.app')

@section('content')
	@if(session('success'))
		<div id="alert" class="bg-green-200 border-l-4 border-green-600 text-green-800 font-bold p-4 rounded absolute right-8" role="alert">
			{{ session('success') }}
		</div>
	@endif

	<form action="{{ route('password.edit') }}" method="post" autocomplete="off">
		@csrf
		<div class="bg-white p-8 rounded-xl w-1/2 max-w-3xl shadow-xl">

			<div class="text-xl text-blue-500 font-bold">Change password</div>

			<div class="mt-6">
				<label for="oldPassword" class="text-gray-600">Current password</label>
				<input type="text" id="oldPassword" name="old_password" placeholder="Current password" value="{{ old('old_password') }}"
							 class="mt-1 w-full rounded-lg bg-gray-50 border py-3 px-4 focus:shadow-lg focus:outline-none transition-shadow">
				@error('old_password')
				<div class="text-xs text-red-400">{{ $message }}</div>
				@enderror
			</div>

			<div class="mt-6">
				<label for="newPassword" class="text-gray-600">New password</label>
				<input type="password" id="newPassword" name="password" placeholder="Password"
							 class="mt-1 w-full rounded-lg bg-gray-50 border py-3 px-4 focus:shadow-lg focus:outline-none transition-shadow">
				@error('password')
				<div class="text-xs text-red-400">{{ $message }}</div>
				@enderror
			</div>

			<div class="mt-6">
				<label for="passwordConfirmation" class="text-gray-600">New password</label>
				<input type="password" id="passwordConfirmation" name="password_confirmation" placeholder="Password confirmation"
							 class="mt-1 w-full rounded-lg bg-gray-50 border py-3 px-4 focus:shadow-lg focus:outline-none transition-shadow">
				@error('password_confirmation')
				<div class="text-xs text-red-400">{{ $message }}</div>
				@enderror
			</div>

			<div class="flex mt-6">
				<button class="w-1/2 btn btn-blue h-12">
					Change
				</button>
			</div>
		</div>
	</form>
@endsection

@push('js')
	<script>
		setTimeout(function () {
			document.getElementById('alert').remove();
		}, 7000);
	</script>
@endpush
