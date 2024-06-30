<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    href: {
        type: String,
        required: true,
    },
    external: {
        type: Boolean,
        default: false,
    },
})

const classes =
    'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out'
</script>

<template>
    <Link v-if="!external" :href="href" :class="classes">
        <slot />
    </Link>
    <a v-else :href="href" :class="classes">
        <slot />
    </a>
</template>
