<script setup>
import { computed } from 'vue'
import InputLabel from '@/Components/Inputs/InputLabel.vue'
import InputError from '@/Components/Inputs/InputError.vue'

const emit = defineEmits(['update:modelValue'])

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: null,
    },
    label: String,
    error: {
        type: String,
        default: null,
    },
})

const proxyChecked = computed({
    get() {
        return props.modelValue
    },

    set(val) {
        emit('update:modelValue', val)
    },
})
</script>

<template>
    <div>
        <InputLabel :value="label" />

        <input
            type="checkbox"
            :value="modelValue"
            v-model="proxyChecked"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
        />

        <InputError :message="error" />
    </div>
</template>
