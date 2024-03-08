<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditForm from '@/Components/Blogs/CreateEditForm.vue'

defineProps({
    blog: {
        type: Object,
        required: false,
        default: {},
    },
    collections: {
        type: Array,
        required: true,
        default: [],
    },
    tags: {
        type: Array,
        required: true,
        default: [],
    },
})
</script>

<template>
    <AuthenticatedLayout title="Edit Blog">
        <CreateEditForm :blog="blog" :tags="tags" :collections="collections" />
    </AuthenticatedLayout>
</template>
