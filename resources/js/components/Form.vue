<template>
	<form :action="routes.formAction" method="post">
		<input type="hidden" name="_token" :value="routes.csrf">
		<input type="hidden" name="_method" value="put">

		<div class="card border-t-8 border-blue-500">
			<c-text v-model="title" name="title" label="Title" :error-message="v$.title.$errors[0]?.$message"/>
			<c-textarea v-model="description" name="description" label="Description" class="mt-4" :error-message="v$.description.$errors[0]?.$message"/>

			<div class="text-right mt-4">
				<button type="button" class="btn btn-light btn-icon-text mr-2" @click="addProperty">
					<CollectionIcon class="h-5 w-5"/>
					Add property
				</button>
				<button class="btn btn-blue btn-icon-text" @click="submitForm">
					<PencilIcon class="h-5 w-5"/>
					Update
				</button>
			</div>
		</div>

		<div class="my-5 font-bold text-lg">Properties:</div>

		<div class="w-4/5 mx-auto mb-32" ref="propContainer">
			<draggable
				v-model="properties"
				item-key="propertyOrder"
				class="space-y-4 scrollable"
				:animation="200"
				ghost-class="opacity-50"
				type="transition-group"
				@start="dragging = true"
				@end="dragging = false"
			>
				<template #item="{element, index}">
					<property v-model="properties[index]" :property-index="index.toString()" v-on:propertyRemoved="removeProperty"/>
				</template>
			</draggable>
		</div>
	</form>
</template>

<script>
import CTextarea from "./fields/Textarea";
import Property from "./Property";
import CText from "./fields/Text";
import {DotsVerticalIcon, PencilIcon, CollectionIcon} from '@heroicons/vue/solid'
import draggable from "vuedraggable";
import useVuelidate from "@vuelidate/core";
import {helpers, required} from "@vuelidate/validators";

export default {
	name: "CForm",
	props: {
		form: {
			required: true,
		},
	},
	components: {
		CText,
		CTextarea,
		Property,
		DotsVerticalIcon,
		PencilIcon,
		CollectionIcon,
		draggable,
	},
	setup() {
		return {
			v$: useVuelidate(),
		};
	},
	data() {
		return {
			routes: {
				formAction: route('forms.update', this.form.id),
				csrf: window.Laravel.csrf,
			},
			title: this.form.title,
			description: this.form.description,
			properties: this.form.properties,
			order: this.form.properties.length,
			dragging: false,
		};
	},
	created() {
		this.$store.commit('setFormProperties', this.properties);
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
				values: [],
			});

			const el = this.$refs.propContainer;

			this.$nextTick(function () {
				if (el) {
					el.scrollIntoView({
						behavior: 'smooth',
						block: 'end',
						inline: 'nearest'
					});
				}
			});
		},
		removeProperty(i) {
			this.properties.splice(i, 1);
		}
	},
	validations() {
		return {
			title: {
				required: helpers.withMessage('Form title required', required),
			},
			description: {
				required: helpers.withMessage('Form description required', required),
			},
		}
	},
}
</script>
