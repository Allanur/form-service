@extends('layouts.app')

@section('content')
	<div class="flex justify-between items-center bg-white rounded-lg px-4 py-3 mb-3">
		<div class="font-bold text-lg">
			Forms list
		</div>
		<div>
			<a href="{{ route('forms.create') }}" class="btn btn-blue">+ Add</a>
		</div>
	</div>

	<div class="flex flex-col">
		<div class="overflow-x-auto">
			<div class="py-2 align-middle inline-block min-w-full">
				<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
					<table class="min-w-full divide-y divide-gray-200">
						<thead class="bg-gray-50">
						<tr class="text-gray-500 text-xs text-left uppercase font-medium">
							<th scope="col" class="px-6 py-3 tracking-wider">
								Title
							</th>
							<th scope="col" class="px-6 py-3 tracking-wider">
								Description
							</th>
							<th scope="col" class="px-6 py-3 tracking-wider">
								Properties
							</th>
							<th scope="col" class="px-6 py-3 tracking-wider">
								Created at
							</th>
							<th scope="col" class="relative px-6 py-3">
								<span class="sr-only">Edit</span>
							</th>
						</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
						@foreach($forms as $form)
							<tr class="text-sm">
								<td class="px-6 py-4 align-top">
									{{ $form->title }}
								</td>
								<td class="px-6 py-4">
									{{ $form->description }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                  {{ $form->properties()->count() }}
                </span>
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
									{{ $form->created_at->translatedFormat('d M Y - H:i') }}
								</td>
								<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
									<a href="{{ route('forms.groups.index', $form) }}" class="text-green-500 hover:text-green-700 mr-2">Groups</a>
									<a href="{{ route('forms.edit', $form) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
									<button class="text-red-500 hover:text-red-600 font-medium ml-2" form="delete-form-{{ $form->id }}">Delete</button>
									<form action="{{ route('forms.destroy', $form) }}" method="post" id="delete-form-{{ $form->id }}">
										@csrf
										@method('delete')
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
