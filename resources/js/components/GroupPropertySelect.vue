<template>
	<vue-select
		multiple
		v-model="selectedProperties"
		:reduce="property => property.id"
		:options="properties"
		label="name"
		placeholder="Select properties"
	>
		<template #search="{attributes, events}">
			<input
				class="vs__search"
				:required="selectedProperties.length === 0"
				v-bind="attributes"
				v-on="events"
			/>
		</template>
	</vue-select>

	<input type="hidden" name="properties[]" :value="selectedProperty" v-for="selectedProperty in selectedProperties">
</template>

<script>
import VueSelect from 'vue-select/src/components/Select';

export default {
	name: "GroupPropertySelect",
	props: {
		properties: {
			required: true,
			type: Array
		},
		selectedProperties: {
			required: false,
			type: Array,
			default: [],
		}
	},
	components: {
		VueSelect,
	},
	mounted() {
		console.log(this.properties);
		console.log(this.selectedProperties);
	},
}
</script>

<style scoped>

</style>
