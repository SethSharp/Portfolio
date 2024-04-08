<script setup>
import { ref, watch } from 'vue'
import { Listbox, ListboxButton, ListboxOptions, ListboxOption } from '@headlessui/vue'
import InputLabel from '@/Components/Inputs/InputLabel.vue'
import { CheckIcon, ChevronDownIcon } from '@heroicons/vue/16/solid/index.js'
import InputError from '@/Components/Inputs/InputError.vue'

const props = defineProps({
    modelValue: Number,
    label: String,
    options: {
        type: Array,
        default: [],
    },
    error: {
        type: String,
        default: null,
    },
})

const emits = defineEmits(['update:modelValue'])

const selectedOption = ref(
    props.modelValue !== undefined
        ? props.options.find((option) => option.id === props.modelValue)
        : null
)

const input = ref(null)

watch(selectedOption, (newVal) => {
    if (newVal) {
        emits('update:modelValue', newVal.id)
    }
})
</script>

<template>
    <div class="relative">
        <InputLabel :value="label" />

        <Listbox v-model="selectedOption">
            <ListboxButton
                v-slot="{ open }"
                class="relative w-full cursor-default rounded-lg bg-white py-2 pl-3 h-10 pr-10 text-left shadow-md focus:outline-none focus-visible:border-primary-500 focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
            >
                {{ selectedOption?.name }}
                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                    <ChevronDownIcon
                        class="size-5 text-gray-400 transition"
                        :class="{ 'rotate-180': open }"
                        aria-hidden="true"
                    />
                </span>
            </ListboxButton>

            <transition
                leave-active-class="transition duration-100 ease-in"
                leave-from-class="opacity-100"
                leave-to-class="opacity-0"
            >
                <ListboxOptions class="absolute z-10 bg-white w-full shadow-md">
                    <ListboxOption key="null" :value="null">
                        <li
                            :class="[
                                active ? 'bg-primary-100 text-primary-900' : 'text-gray-900',
                                'relative cursor-default select-none py-2 pl-10 pr-4',
                            ]"
                        >
                            Clear Selection
                        </li>
                    </ListboxOption>

                    <ListboxOption
                        v-slot="{ active, selected }"
                        v-for="option in options"
                        :key="option.id"
                        :value="option"
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
                                <CheckIcon class="size-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ListboxOption>
                </ListboxOptions>
            </transition>
        </Listbox>

        <InputError :message="error" />
    </div>
</template>
