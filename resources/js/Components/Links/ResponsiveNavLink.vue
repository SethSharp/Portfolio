<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    external: {
        type: Boolean,
    },
})

const classes = computed(() =>
    props.active
        ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-primary-400 text-start text-base font-medium text-primary-700 bg-primary-50 focus:outline-none focus:text-primary-800 focus:bg-primary-100 focus:border-primary-700 transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-secondary-600 hover:text-secondary-800 hover:bg-secondary-50 hover:border-secondary-300 focus:outline-none focus:text-secondary-800 focus:bg-secondary-50 focus:border-secondary-300 transition duration-150 ease-in-out'
)
</script>

<template>
    <Link v-if="!external" :href="href" :class="classes">
        <slot />
    </Link>
    <a v-else :href="href" :class="classes">
        <slot />
    </a>
</template>
