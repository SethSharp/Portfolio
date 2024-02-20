<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditForm from '@/Components/Blogs/CreateEditForm.vue'

defineProps({
    blog: {
        type: Object,
        required: false,
        default: {},
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
        <CreateEditForm :blog="blog" :tags="tags" />
    </AuthenticatedLayout>
</template>
