<template>
	<div class="grid grid-cols-12 gap-2 items-center">
		<input type="hidden" :name="'properties['+propertyIndex+'][values]['+valueIndex+'][id]'" :value="modelValue.id" v-if="modelValue.id !== null">
		<input type="hidden" :name="'properties['+propertyIndex+'][values]['+valueIndex+'][order]'" :value="valueIndex+1">
		<div class="col-span-1 mx-auto cursor-move">
			<MenuAlt4Icon class="w-5 h-5"/>
		</div>
		<div class="col-span-10">
			<c-text :name="'properties['+propertyIndex+'][values]['+valueIndex+'][value]'" v-model="modelValue.value"/>
		</div>
		<div class="col-span-1 ml-auto">
			<button type="button" class="btn-action bg-red-600 hover:bg-red-400 transition-all text-white" @click="$emit('removeClicked', valueIndex)">
				<XIcon/>
			</button>
		</div>
		<div class="col-span-10 col-start-2 text-xs text-red-400" v-if="v$.modelValue.value.$error">
			{{ v$.modelValue.value.$errors[0].$message }}
		</div>
	</div>
</template>

<script>
import {XIcon, MenuAlt4Icon} from '@heroicons/vue/solid'
import CText from "./fields/Text";
import useVuelidate from "@vuelidate/core";
import {required} from "@vuelidate/validators";

export default {
	name: "Value",
	components: {
		CText,
		XIcon,
		MenuAlt4Icon,
	},
	emits: ['removeClicked'],
	setup() {
		return {
			v$: useVuelidate(),
		};
	},
	props: {
		modelValue: Object,
		label: {
			type: String,
			required: false,
		},
		propertyIndex: String,
		valueIndex: String,
		placeholder: {
			type: String,
			required: false
		},
	},
	validations() {
		return {
			modelValue: {
				value: {
					required,
				}
			},
		}
	}
}
</script>
