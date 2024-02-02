<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: String,
});
</script>

<template>
    <button
        class="inline-flex items-center px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-yellow-600 focus:bg-yellow-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
