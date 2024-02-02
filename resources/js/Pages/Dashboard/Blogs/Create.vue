<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateEditForm from "@/Components/Blogs/CreateEditForm.vue";
</script>

<template>
    <AuthenticatedLayout>
        <CreateEditForm />
    </AuthenticatedLayout>
</template>
