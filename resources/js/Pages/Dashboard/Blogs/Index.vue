<script setup>
import {router} from '@inertiajs/vue3'
import Blog from '@/Components/Cards/Blog.vue'
import IndexBlogsLayout from '@/Layouts/IndexBlogsLayout.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'

defineProps({
    blogs: Object,
    tabs: Object,
    status: String,
})

const create = () => {
    router.post(route('dashboard.blogs.create'))
}
</script>

<template>
    <IndexBlogsLayout :status="status" :count="blogs.data.length" :tabs="tabs" :data="blogs">
        <div v-if="blogs.data.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
            <Blog v-for="blog in blogs.data" :blog="blog"/>
        </div>

        <div v-else class="flex justify-center align-middle">
            <div class="text-center">
                <h3 class="text-gray-400 text-md sm:text-xl">
                    There are currently no blogs in the {{ status }} state.
                </h3>

                <div v-if="status === 'published'" class="mt-4">
                    <PrimaryButton @click="create">
                        Create Blog
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </IndexBlogsLayout>
</template>
