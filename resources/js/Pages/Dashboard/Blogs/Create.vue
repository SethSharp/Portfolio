<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditForm from '@/Components/Blogs/CreateEditForm.vue'

defineProps({
    collections: {
        type: Array,
        required: true,
    },
    tags: {
        type: Array,
        required: true,
    },
})
</script>

<template>
    <AuthenticatedLayout title="Create Blog">
        <CreateEditForm :tags="tags" :collections="collections" />
    </AuthenticatedLayout>
</template>
