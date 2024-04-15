<script setup>
import { onMounted, ref } from 'vue'
import InputLabel from '@/Components/Inputs/InputLabel.vue'
import InputError from '@/Components/Inputs/InputError.vue'

defineProps({
    id: String,
    label: String,
    description: String,
    type: {
        type: String,
        default: 'text',
    },
    error: {
        type: String,
        default: null,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
})

const model = defineModel({
    type: [String, Number, null],
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
        <InputLabel :for-input="id" :value="label" />

        <input
            :id="id"
            ref="input"
            :type="type"
            :disabled="disabled"
            v-model="model"
            class="w-full !border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        />

        <span class="text-gray-400 text-sm"> {{ description }} </span>

        <InputError :message="error" />
    </div>
</template>
