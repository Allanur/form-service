@extends('layouts.app')

@section('content')
	<div class="bg-white rounded-lg px-4 py-3 mb-3 font-bold text-lg">
		Form Create
	</div>

	<form action="{{ route('forms.store') }}" method="post">
		@csrf
		<div class="card border-t-8 border-blue-500">
			@include('fields.text', ['label' => 'Title', 'placeholder' => 'Form title goes here', 'name' => 'title'])
			@include('fields.textarea', ['label' => 'Description', 'placeholder' => 'Form description goes here', 'name' => 'description'])

			<div class="text-right">
				<button class="btn btn-blue btn-icon-text">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
						<path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
					</svg>
					Create
				</button>
			</div>
		</div>
	</form>
@endsection

