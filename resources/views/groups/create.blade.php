@extends('layouts.app')

@section('content')
	<div class="text-2xl font-bold">{{ $form->title }}</div>
	<div class="text-gray-600">{{ $form->description }}</div>

	<form action="{{ route('forms.groups.store', $form) }}" method="post" autocomplete="off" class="mt-12">
		@csrf
		<div class="w-1/2 mb-6">
			@include('fields.text', ['label' => 'Title', 'name' => 'title', 'placeholder' => 'Group title here'])
		</div>

		<div id="app" class="w-1/2 mb-6 bg-white">
			<gp-select :properties="{{ $properties }}"/>
		</div>

		<button class="btn btn-blue mt-6">Submit</button>
	</form>
@endsection
