@extends('layouts.app')

@section('content')
	<div class="bg-white rounded-lg px-4 py-3 mb-3 font-bold text-lg">
		Form Edit
	</div>

	<div id="app">
		<c-form :form="{{ $form }}"/>
	</div>

{{--	<div class="my-5 font-bold text-lg">Steps:</div>

	<div class="grid grid-cols-3 gap-4">
		@foreach($form->steps as $step)
			<div class="card w-full">
				<div class="flex justify-between items-start">
					<div class="font-medium">{{ $loop->iteration }}. {{ $step->title }}</div>

					<div class="flex items-center justify-center">
						<div class=" relative inline-block text-left dropdown">
							<button class="btn btn-icon" type="button" aria-haspopup="true" aria-expanded="true">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
									<path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
								</svg>
							</button>
							<div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
								<div class="absolute right-0 mt-2 py-1 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg outline-none" role="menu">
									<a href="{{ route('forms.steps.edit', [$form, $step]) }}" tabindex="0"
										 class="text-gray-700 hover:bg-gray-100 flex w-full px-4 py-2 text-sm leading-5" role="menuitem">Edit</a>
									<form action="{{ route('forms.steps.destroy', [$form, $step]) }}" method="post">
										@csrf
										@method('delete')
										<button class="text-gray-700 hover:bg-gray-100 focus:outline-none w-full px-4 py-2 text-sm leading-5">
											Delete
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="text-sm mt-3">
					<div class="text-gray-500 font-bold">Properties:</div>
					<ol class="list-decimal ml-4 space-y-1 mt-2">
						@foreach($step->properties as $property)
							<li class="text-gray-600">
								{{ $property->name }}
							</li>
						@endforeach
					</ol>
				</div>
			</div>
		@endforeach
	</div>--}}
@endsection
