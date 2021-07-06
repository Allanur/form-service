<template>
	<input type="hidden" :name="'properties['+index+'][type]'" v-model="modelValue">
	<div class="w-full mx-auto">
		<Listbox
			as="div"
			class="space-y-2"
			v-model="modelValue"
			v-slot="{ open }"
		>
			<ListboxLabel class="block text-sm leading-5 font-medium text-gray-700">
				Property Type
			</ListboxLabel>
			<div class="relative">
          <span class="inline-block w-full rounded-md shadow-sm">
            <ListboxButton
							class="cursor-default relative w-full rounded-md border border-gray-300 bg-white pl-3 pr-10 py-2.5 text-left focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              <span class="block truncate">
                {{ typeLabel[modelValue] }}
              </span>
              <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
								<selector-icon class="h-5 w-5 text-gray-400"/>
              </span>
            </ListboxButton>
          </span>

				<transition
					leave-active-class="transition ease-in duration-100"
					leave-from-class="opacity-100"
					leave-to-class="opacity-0">
					<div v-if="open" class="absolute mt-1 w-full rounded-md bg-white shadow-lg z-10 border">
						<ListboxOptions static class="max-h-60 rounded-md py-1 text-base leading-6 shadow-xs overflow-auto focus:outline-none sm:text-sm sm:leading-5">
							<ListboxOption
								v-for="type in formTypes"
								:key="type"
								:value="type"
								v-slot="{ selected, active }">
								<div :class="`${
                      active ? 'text-white bg-blue-600' : 'text-gray-900'
                    } cursor-default select-none relative py-2 pl-8 pr-4`">
                    <span :class="`${
                        selected ? 'font-semibold' : 'font-normal'
                      } block truncate`">
                      {{ typeLabel[type] }}
                    </span>
									<span v-if="selected" :class="`${
                        active ? 'text-white' : 'text-blue-600'
                      } absolute inset-y-0 left-0 flex items-center pl-1.5`">
										<CheckIcon class="w-5 h-5"/>
                    </span>
								</div>
							</ListboxOption>
						</ListboxOptions>
					</div>
				</transition>
			</div>
		</Listbox>
	</div>
</template>

<script>
import {
	Listbox,
	ListboxLabel,
	ListboxButton,
	ListboxOptions,
	ListboxOption,
} from "@headlessui/vue";
import {CheckIcon, SelectorIcon} from '@heroicons/vue/solid'

export default {
	name: "CSelect",
	components: {
		Listbox,
		ListboxLabel,
		ListboxButton,
		ListboxOptions,
		ListboxOption,
		CheckIcon,
		SelectorIcon,
	},
	watch: {
		modelValue: {
			handler(val) {
				this.$emit('update:modelValue', val);
			},
		}
	},
	props: {
		modelValue: {
			type: String,
			default: 'text',
			required: false,
		},
		index: String,
	},
	data() {
		return {
			formTypes: ['text', 'number', 'select', 'multiple_choice'],
			typeLabel: {
				text: 'Text',
				number: 'Number',
				select: 'Select',
				multiple_choice: 'Multiple choice',
			},
		};
	}
};
</script>
