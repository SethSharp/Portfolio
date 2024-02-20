<script setup>
import { ref, watch } from 'vue'
import { Listbox, ListboxButton, ListboxOptions, ListboxOption } from '@headlessui/vue'
import { ChevronUpDownIcon, CheckIcon } from '@heroicons/vue/16/solid/index.js'
import InputLabel from '@/Components/Inputs/InputLabel.vue'

const props = defineProps({
    modelValue: {
        type: Array,
        default: null,
    },
    options: {
        type: Array,
        required: true,
    },
    label: {
        type: String,
        default: '',
    },
})

const emits = defineEmits(['update:modelValue'])

const selectedOptions = ref(props.modelValue ? props.modelValue : [])

watch(selectedOptions, (newVal) => {
    if (newVal) {
        emits('update:modelValue', newVal)
    }
})
</script>

<template>
    <div>
        <InputLabel :value="label" />

        <Listbox v-model="selectedOptions" multiple>
            <ListboxButton
                class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 h-10 pr-10 text-left shadow-md focus:outline-none focus-visible:border-primary-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
            >
                <div class="flex">
                    {{ selectedOptions.map((option) => option.name).join(', ') }}
                </div>

                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                    <ChevronUpDownIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                </span>
            </ListboxButton>

            <transition
                leave-active-class="transition duration-100 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <ListboxOptions>
                    <ListboxOption
                        v-slot="{ active, selected }"
                        v-for="option in options"
                        :key="option.name"
                        :value="option"
                        as="template"
                    >
                        <li
                            :class="[
                                active ? 'bg-primary-100 text-primary-900' : 'text-gray-900',
                                'relative cursor-default select-none py-2 pl-10 pr-4',
                            ]"
                        >
                            <span
                                :class="[
                                    selected ? 'font-medium' : 'font-normal',
                                    'block truncate',
                                ]"
                                >{{ option.name }}</span
                            >
                            <span
                                v-if="selected"
                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-primary-600"
                            >
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </Listbox>
    </div>
</template>
