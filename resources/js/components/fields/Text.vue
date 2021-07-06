<template>
	<div>
		<label :for="fieldId" class="block text-sm font-medium text-gray-700">
			{{ label }}
		</label>
		<input :class="{'mt-2': label !== undefined}"
					 class="shadow-sm focus:outline-none focus:border-blue-600 transition-colors w-full sm:text-sm border border-gray-300 rounded-md p-2.5"
					 :placeholder="placeholder" :name="name" :value="modelValue" @input='$emit("update:modelValue", $event.target.value)'/>
	</div>
</template>

<script>
export default {
	name: "CText",
	props: {
		modelValue: String,
		label: {
			type: String,
			required: false,
		},
		name: {
			type: String,
			required: false,
		},
		placeholder: {
			type: String,
			required: false
		},
	},
	computed: {
		fieldId() {
			return this.label?.toLowerCase();
		},
	},
}
</script>
