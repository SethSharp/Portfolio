<script setup>
import { onMounted, ref } from 'vue'
import InputLabel from '@/Components/Inputs/InputLabel.vue'

defineProps({
    label: {
        type: String,
        default: '',
    },
    type: {
        type: String,
        default: 'text',
    },
    options: {
        type: Array,
        default: [],
    },
})

const model = defineModel({
    type: [null, String, Number],
    required: true,
})

const input = ref(null)
</script>

<template>
    <div>
        <InputLabel :value="label" />

        <select
            :type="type"
            v-model="model"
            class="w-full !border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        >
            <option v-for="option in options" :value="option.value">
                {{ option.label }}
            </option>
        </select>
    </div>
</template>
