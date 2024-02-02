<script setup>
import { Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Blog from "@/Components/Cards/Blog.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";

defineProps({
    blogs: Array,
});
</script>

<template>
    <AuthenticatedLayout>
        <Link :href="route('dashboard.blogs.create')"> Create Blog </Link>

        <div class="grid grid-cols-5">
            <Blog v-for="blog in blogs" :blog="blog" />
        </div>
    </AuthenticatedLayout>
</template>
