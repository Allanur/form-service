@extends('layouts.app')

@section('content')
	<div class="flex justify-between mb-10">
		<div>
			<div class="text-2xl font-bold">{{ $form->title }}</div>
			<div class="text-gray-600">{{ $form->description }}</div>
		</div>
		<div class="flex-shrink-0 ml-4">
			<a href="{{ route('forms.groups.create', $form) }}" class="btn btn-blue">Create new group</a>
		</div>
	</div>

	<div class="grid grid-cols-3 gap-4">
		@foreach($form->groups as $group)
			<div class="card w-full">
				<div class="flex justify-between items-center">
					<div class="font-medium">{{ $loop->iteration }}. {{ $group->title }}</div>

					<div class="flex items-center justify-center">
						<div class="relative inline-block text-left dropdown">
							<button class="btn-action bg-gray-100 hover:bg-gray-300" type="button" aria-haspopup="true" aria-expanded="true">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
									<path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
								</svg>
							</button>
							<div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
								<div class="absolute right-0 mt-2 py-1 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg outline-none" role="menu">
									<a href="{{ route('forms.groups.edit', [$form, $group]) }}" tabindex="0" class="text-gray-700 hover:bg-gray-100 flex w-full px-4 py-2 text-sm leading-5" role="menuitem">Edit</a>
									<form action="{{ route('forms.groups.destroy', [$form, $group]) }}" method="post">
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
						@foreach($group->properties as $property)
							<li class="text-gray-600">
								{{ $property->name }}
							</li>
						@endforeach
					</ol>
				</div>
			</div>
		@endforeach
	</div>
@endsection
