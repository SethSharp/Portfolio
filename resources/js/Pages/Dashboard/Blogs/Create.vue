<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditForm from '@/Components/Blogs/CreateEditForm.vue'

defineProps({
    groups: {
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
        <CreateEditForm :tags="tags" :groups="groups" />
    </AuthenticatedLayout>
</template>
