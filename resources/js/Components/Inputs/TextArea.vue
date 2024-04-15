<script setup>
import { onMounted, ref } from 'vue'
import InputLabel from '@/Components/Inputs/InputLabel.vue'
import InputError from '@/Components/Inputs/InputError.vue'

defineProps({
    label: String,
    description: {
        type: String,
        default: null,
    },
    error: {
        type: String,
        default: null,
    },
})

const model = defineModel({
    type: String,
    required: true,
})

const input = ref(null)

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus()
    }
})

defineExpose({ focus: () => input.value.focus() })
</script>

<template>
    <div>
        <InputLabel :value="label" />

        <textarea
            type="text"
            class="w-full focus:border-indigo-500 !border-gray-300 focus:ring-indigo-500 rounded-md shadow-sm"
            v-model="model"
            ref="input"
        />

        <span class="text-gray-400 text-sm"> {{ description }} </span>

        <InputError :message="error" />
    </div>
</template>
