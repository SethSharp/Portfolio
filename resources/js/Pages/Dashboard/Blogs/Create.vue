<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditForm from '@/Components/Blogs/CreateEditForm.vue'

defineProps({
    tags: {
        type: Array,
        required: true,
    },
})
</script>

<template>
    <AuthenticatedLayout>
        <CreateEditForm :tags="tags" />
    </AuthenticatedLayout>
</template>
