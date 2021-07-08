@extends('layouts.app')

@section('content')
	<div class="text-2xl font-bold">{{ $form->title }}</div>
	<div class="text-gray-600">{{ $form->description }}</div>

	<form action="{{ route('forms.groups.update', [$form, $group]) }}" method="post" autocomplete="off" class="mt-12">
		@csrf
		@method('put')

		<div class="w-1/2 mb-6">
			@include('fields.text', ['label' => 'Title', 'name' => 'title', 'placeholder' => 'Group title here', 'value' => old('title', $group->title)])
		</div>

		<div id="app" class="w-1/2 mb-6 bg-white">
			<gp-select :properties="{{ $properties }}" :selected-properties="{{ $group->properties()->pluck('properties.id')}}"/>
		</div>

		<button class="btn btn-blue mt-6">Update</button>
	</form>
@endsection
