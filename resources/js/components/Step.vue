<template>
	<div class="mb-5 font-bold text-lg">{{ formTitle }}</div>

<!--
	This is just dropdown menu example
	<div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
		<div class="absolute right-0 mt-2 py-1 origin-top-right bg-white border border-gray-200 rounded-md shadow-lg outline-none" role="menu">
			<a :href="stepsEditRoute(step.id)" tabindex="0" class="text-gray-700 hover:bg-gray-100 flex w-full px-4 py-2 text-sm leading-5" role="menuitem">Edit</a>
			<form :action="stepsDestroyRoute(step.id)" method="post">
				<input type="hidden" name="_token" :value="routes.csrf">
				<input type="hidden" name="_method" value="delete">
				<button class="text-gray-700 hover:bg-gray-100 focus:outline-none w-full px-4 py-2 text-sm leading-5">
					Delete
				</button>
			</form>
		</div>
	</div>
	-->

	<form :action="routes.formAction" method="post">
		<input type="hidden" name="_token" :value="routes.csrf">
		<input type="hidden" name="_method" value="put" v-if="step.id !== undefined">
		<div class="grid grid-cols-3 gap-4">
			<div class="col-span-1">
				<div class="p-4 shadow-md rounded-md bg-white sticky top-6">
					<label class="block text-sm font-medium text-gray-700">Step title</label>
					<input class="mt-2 shadow-sm focus:outline-none focus:border-blue-600 transition-colors w-full sm:text-sm border border-gray-300 rounded-md p-2.5"
								 name="title" v-model="title"/>
					<div class="text-xs text-red-400 mt-1" v-if="v$.title.$error">
						{{ v$.title.$errors[0].$message }}
					</div>
					<hr class="my-4">
					<div class="flex items-center justify-end">
						<button type="button" class="btn btn-blue btn-icon-text" @click="addProperty">
							<PlusIcon class="h-5 w-5 text-white"/>
							Property
						</button>
					</div>
					<button class="btn btn-blue w-full mt-4" @click="submitForm">Submit</button>
				</div>
			</div>
			<draggable
				v-model="properties"
				item-key="order"
				class="col-span-2 space-y-4"
				:animation="200"
				ghost-class="opacity-50"
				type="transition-group"
				@start="dragging = true"
				@end="dragging = false"
			>
				<template #item="{element, index}">
					<property v-model="properties[index]" :property-index="index.toString()"></property>
				</template>
			</draggable>
		</div>
	</form>
</template>

<script>
import CText from "./fields/Text";
import CSelect from "./fields/Select";
import Property from "./Property";
import {PlusIcon, XIcon} from "@heroicons/vue/solid";
import useVuelidate from '@vuelidate/core';
import {required, helpers, minLength} from '@vuelidate/validators';
import draggable from "vuedraggable";

export default {
	name: "Step",
	components: {
		PlusIcon,
		XIcon,
		CText,
		CSelect,
		Property,
		draggable,
	},
	props: {
		form: {
			required: true,
		},
		step: {
			required: false,
			default: {
				title: '',
				properties: [
					{
						id: null,
						name: '',
						type: 'text',
						values: [{
							id: null,
							value: ''
						}],
					},
				]
			}
		}
	},
	setup() {
		return {
			v$: useVuelidate(),
		};
	},
	methods: {
		submitForm: function (e) {
			this.v$.$validate();
			if (this.v$.$error) {
				e.preventDefault();
			}
		},
		addProperty() {
			this.properties.push({
				id: null,
				name: '',
				type: 'text',
				values: [{
					id: null,
					value: ''
				}],
			});
		},
	},
	data() {
		return {
			routes: {
				formAction: this.step.id !== undefined ? route('forms.steps.update', [this.form.id, this.step.id]) : route('forms.steps.store', this.form.id),
				csrf: window.Laravel.csrf,
			},
			formTitle: this.form.title,
			title: this.step.title,
			properties: this.step.properties,
			order: this.step.properties.length,
			dragging: false,
		}
	},
	validations() {
		return {
			title: {
				required: helpers.withMessage('Step title required', required),
			},
			properties: {
				required,
				minLength: helpers.withMessage('Step must contain at least one property', minLength(1)),
			},
		}
	}
}
</script>
