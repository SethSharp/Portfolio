<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditForm from '@/Components/Blogs/CreateEditForm.vue'

defineProps({
    blog: {
        type: Object,
        required: false,
        default: {},
    },
    groups: {
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
        <CreateEditForm :blog="blog" :tags="tags" :groups="groups" />
    </AuthenticatedLayout>
</template>
