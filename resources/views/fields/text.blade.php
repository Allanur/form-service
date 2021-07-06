<div class="mb-4">
	<label class="block text-sm font-medium text-gray-700">
		{{ $label }}
	</label>
	<input placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ $value ?? null }}"
				 class="mt-2 shadow-sm focus:outline-none focus:border-blue-600 transition-colors w-full sm:text-sm border {{ $errors->has($name) ? 'border-red-400' : 'border-gray-300' }} rounded-md p-2.5"/>
	@error($name)
	<div class="text-xs text-red-400 mt-0.5">{{ $message }}</div>
	@enderror
</div>
