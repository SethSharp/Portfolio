<script setup>
import { Link } from '@inertiajs/vue3'
import Blog from '@/Components/Cards/Blog.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
    draftBlogs: Array,
    publishedBlogs: Array,
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

        <div>
            <h1 class="text-2xl">Draft Blogs</h1>
            <div
                v-if="draftBlogs.length"
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6"
            >
                <Blog v-for="blog in draftBlogs" :blog="blog" />
            </div>
            <div v-else class="text-gray-400">No blogs in draft status</div>
        </div>

        <div class="mt-8">
            <h1 class="text-2xl">Published Blogs</h1>
            <div
                v-if="publishedBlogs"
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6"
            >
                <Blog v-for="blog in publishedBlogs" :blog="blog" />
            </div>
            <div v-else class="text-gray-400">No published blogs</div>
        </div>
    </AuthenticatedLayout>
</template>
