<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    blog: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <div class="bg-gray-200 rounded-3xl p-4">
        <Link :href="route('dashboard.blogs.edit', blog)">
            <h1>{{ blog.title }}</h1>
            <p>{{ blog.content }}</p>
        </Link>
    </div>
</template>
