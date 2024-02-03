<script setup>
defineProps({
    active: Boolean,
})
</script>

<template>
    <button
        class="border border-gray-400 bg-white h-10 p-2 hover:bg-gray-300 transition"
        :class="{ 'bg-gray-300': active }"
    >
        <slot />
    </button>
</template>
