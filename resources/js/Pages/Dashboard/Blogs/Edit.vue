<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditForm from '@/Components/Blogs/CreateEditForm.vue'

defineProps({
    blog: {
        type: Object,
        required: false,
        default: {},
    },
})
</script>

<template>
    <AuthenticatedLayout>
        <CreateEditForm :blog="blog" />
    </AuthenticatedLayout>
</template>
