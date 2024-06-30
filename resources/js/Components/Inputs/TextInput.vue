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
    placeholder: {
        type: String,
        default: '',
    },
    showCharacterCount: {
        type: Boolean,
        default: true,
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
            :placeholder="placeholder"
            class="w-full rounded-md border border-gray-500 px-2 py-1 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            :class="{
                'border-gray-300': !error,
                'border-red-300': error,
            }"
        />

        <div v-if="showCharacterCount" class="text-gray-400 text-xs">
            Characters: {{ model.length }}
        </div>
        <div class="text-gray-500 text-sm">{{ description }}</div>

        <InputError :message="error" />
    </div>
</template>
