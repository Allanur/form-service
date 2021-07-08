<template>
	<div class="grid grid-cols-12 gap-2 items-center">
		<input type="hidden" :name="'properties['+propertyIndex+'][values]['+valueIndex+'][id]'" :value="modelValue.id" v-if="modelValue.id !== null">
		<input type="hidden" :name="'properties['+propertyIndex+'][values]['+valueIndex+'][order]'" :value="valueIndex+1">
		<input type="hidden" :name="'properties['+propertyIndex+'][values]['+valueIndex+'][goto_id]'" :value="modelValue.goto_id">
		<div class="col-span-7 flex items-center">
			<MenuAlt4Icon class="w-5 h-5 cursor-move mr-4"/>
			<c-text class="flex-grow" :name="'properties['+propertyIndex+'][values]['+valueIndex+'][value]'" v-model="modelValue.value"/>
		</div>
		<div class="col-span-1 mx-auto">
			<button type="button" class="btn-action bg-red-600 hover:bg-red-400 transition-all text-white has-tooltip" @click="$emit('removeClicked', valueIndex)">
				<XIcon/>
				<span class='tooltip -mt-20'>Remove</span>
			</button>
		</div>

		<div class="col-span-1" v-if="!showGotoSelection">
			<button type="button" class="btn-action bg-gray-300 hover:bg-gray-400 hover:text-blue-600 transition-all text-blue-400 has-tooltip"
							@click="showGotoSelection = true">
				<ArrowNarrowRightIcon/>
				<span class='tooltip -mt-20'>Go to property selection</span>
			</button>
		</div>

		<div class="col-span-4" v-if="showGotoSelection">
			<vue-select
				v-model="modelValue.goto_id"
				:reduce="property => property.id"
				:options="this.$store.getters.properties"
				label="name"
				placeholder="Select goto property"
			/>
		</div>
		<div class="col-span-10 col-start-2 text-xs text-red-400" v-if="v$.modelValue.value.$error">
			{{ v$.modelValue.value.$errors[0].$message }}
		</div>
	</div>

</template>

<script>
import {XIcon, MenuAlt4Icon, ArrowNarrowRightIcon} from '@heroicons/vue/solid'
import CText from "./fields/Text";
import useVuelidate from "@vuelidate/core";
import {required} from "@vuelidate/validators";
import VueSelect from 'vue-select/src/components/Select';

export default {
	name: "Value",
	components: {
		CText,
		XIcon,
		MenuAlt4Icon,
		ArrowNarrowRightIcon,
		VueSelect,
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
	data() {
		return {
			showGotoSelection: false,
		}
	},
	mounted() {
		if (this.modelValue.goto_id !== null && this.modelValue.goto_id !== undefined) {
			this.showGotoSelection = true;
		}
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
