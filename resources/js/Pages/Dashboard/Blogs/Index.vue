<script setup>
import {Link} from '@inertiajs/vue3'
import Blog from '@/Components/Cards/Blog.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
    blogs: Array,
})
</script>

<template>
    <AuthenticatedLayout title="Blogs">
        <div class="flex justify-end">
            <Link
                class="bg-primary-500 rounded-xl p-2 text-white font-medium"
                :href="route('dashboard.blogs.create')"
            >
                Create Blog
            </Link>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6">
            <Blog v-for="blog in blogs" :blog="blog"/>
        </div>
    </AuthenticatedLayout>
</template>
