<template>
	<div class="mx-auto bg-white rounded-md shadow-md px-4 pb-4">
		<input type="hidden" :name="'properties['+propertyIndex+'][id]'" :value="modelValue.id" v-if="modelValue.id !== null">

		<div class="py-2 cursor-move">
			<SelectorIcon class="w-5 h-4 mx-auto"/>
		</div>

		<div class="grid grid-cols-7 gap-6 justify-between">
			<div class="col-span-4">
				<c-text :name="'properties['+propertyIndex+'][name]'" v-model="modelValue.name" label="Property name" placeholder="..." class="py-0"/>
				<div class="text-xs text-red-400 mt-1" v-if="v$.modelValue.name.$error">
					{{ v$.modelValue.name.$errors[0].$message }}
				</div>
				<div class="text-xs text-red-400 mt-1" v-if="v$.modelValue.values.$error">
					{{ v$.modelValue.values.$errors[0].$message }}
				</div>
			</div>
			<div class="col-span-2">
				<c-select v-model="modelValue.type" :index="propertyIndex"/>
			</div>
			<div class="col-span-1" v-if="valuesRequired">
				<button type="button" class="btn-action-big bg-gray-100 hover:bg-gray-300 mt-8" @click="show = !show">
					<ChevronDownIcon/>
				</button>
			</div>
		</div>

		<transition name="fade">
			<div v-if="valuesRequired" v-show="show">
				<draggable
					v-model="modelValue.values"
					item-key="valueOrder"
					class="space-y-4 mt-5"
					:animation="200"
					ghost-class="opacity-50"
					type="transition-group"
					@start="dragging = true"
					@end="dragging = false"
				>
					<template #item="{element, index}">
						<value v-model="modelValue.values[index]" :value-index="index.toString()" :property-index="propertyIndex" v-on:removeClicked="removeValue"
									 placeholder="Value here"/>
					</template>
				</draggable>
			</div>
		</transition>

		<div class="mt-6">
			<button type="button" class="btn-action btn-red has-tooltip mr-3" @click="$emit('propertyRemoved', propertyIndex)">
				<TrashIcon/>
				<span class='tooltip -mt-20'>Remove property</span>
			</button>
			<button type="button" class="btn-action btn-blue has-tooltip" @click="addValue" v-if="valuesRequired">
				<PlusIcon/>
				<span class='tooltip -mt-20'>Add value</span>
			</button>
		</div>
	</div>
</template>

<script>
import CText from "./fields/Text";
import {PlusIcon, SelectorIcon, ChevronDownIcon, TrashIcon} from '@heroicons/vue/solid'
import CSelect from "./fields/Select";
import Value from "./Value";
import useVuelidate from "@vuelidate/core";
import {required, requiredIf, helpers} from "@vuelidate/validators";
import draggable from "vuedraggable";

export default {
	name: "Property",
	components: {
		Value,
		CSelect,
		CText,
		PlusIcon,
		SelectorIcon,
		ChevronDownIcon,
		TrashIcon,
		draggable,
	},
	setup() {
		return {
			v$: useVuelidate(),
		};
	},
	emits: ['propertyRemoved'],
	props: {
		modelValue: Object,
		propertyIndex: String,
	},
	data() {
		return {
			show: false,
			dragging: false,
		}
	},
	computed: {
		valuesRequired() {
			return ['select', 'multiple_choice'].includes(this.modelValue.type);
		}
	},
	methods: {
		addValue() {
			this.show = true;
			this.modelValue.values.push({
				id: null,
				value: '',
			});
		},
		removeValue(index) {
			this.modelValue.values.splice(index, 1);
		}
	},
	watch: {
		modelValue: {
			handler(val) {
				// console.log(val.values);
			},
			deep: true,
		}
	},
	validations() {
		return {
			modelValue: {
				name: {
					required: helpers.withMessage('Property name is required', required),
				},
				type: {
					required,
				},
				values: {
					required: helpers.withMessage('Property must contain at least one value', requiredIf(this.valuesRequired)),
				}
			},
		}
	}
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
	transition: opacity 100ms ease;
}

.fade-enter-from,
.fade-leave-to {
	opacity: 0;
}
</style>
