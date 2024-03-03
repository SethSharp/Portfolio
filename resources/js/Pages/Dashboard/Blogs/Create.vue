<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditForm from '@/Components/Blogs/CreateEditForm.vue'

defineProps({
    series: {
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
        <CreateEditForm :tags="tags" :series="series" />
    </AuthenticatedLayout>
</template>
