<script setup>
defineProps({
    forInput: {
        type: String,
    },
    value: {
        type: String,
    },
})
</script>

<template>
    <label :for="forInput" class="block font-medium text-md text-gray-700">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
