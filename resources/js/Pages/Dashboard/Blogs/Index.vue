<script setup>
import { Link, router } from '@inertiajs/vue3'
import Blog from '@/Components/Cards/Blog.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
    draftBlogs: Array,
    publishedBlogs: Array,
})

const create = () => {
    router.post(route('dashboard.blogs.create'))
}
</script>

<template>
    <AuthenticatedLayout title="Blogs">
        <div class="flex justify-end">
            <button class="bg-primary-500 rounded-xl p-2 text-white font-medium" @click="create">
                Create Blog
            </button>
        </div>

        <div>
            <h1 class="text-2xl">Draft Blogs</h1>
            <div v-if="draftBlogs.length" class="grid md:grid-cols-2 gap-y-4 gap-x-4 mt-6">
                <Blog v-for="blog in draftBlogs" :blog="blog" />
            </div>
            <div v-else class="text-gray-400">No blogs in draft status</div>
        </div>

        <div class="mt-8">
            <h1 class="text-2xl">Published Blogs</h1>
            <div v-if="publishedBlogs" class="grid md:grid-cols-2 gap-4 mt-6">
                <Blog v-for="blog in publishedBlogs" :blog="blog" />
            </div>
            <div v-else class="text-gray-400">No published blogs</div>
        </div>
    </AuthenticatedLayout>
</template>
