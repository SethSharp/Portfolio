<script setup>
import { router, Link } from '@inertiajs/vue3'
import { Button, Tabs, Pagination } from '@sethsharp/lumuix'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
    status: String,
    tabs: Object,
    count: Number,
    data: {
        type: Object,
        default: null,
        required: false,
    },
})

const create = () => router.post(route('dashboard.blogs.create'))
</script>

<template>
    <AuthenticatedLayout title="Blogs">
        <div class="p-3 sm:p-6">
            <div class="sm:flex mb-4">
                <div class="rounded py-2 text-3xl text-black dark:text-gray-300">
                    {{ status }} Blogs ({{ count }})
                </div>
                <div class="flex ml-auto">
                    <Button variant="primary" @click="create"> Create Blog</Button>
                </div>
            </div>

            <Tabs :is="Link" :tabs="tabs" :data="data">
                <slot />

                <Pagination :data="data" />
            </Tabs>
        </div>
    </AuthenticatedLayout>
</template>
