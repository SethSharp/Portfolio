<script setup>
import { router, Link } from '@inertiajs/vue3'
import { PrimaryButton, Tabs, Pagination } from '@sethsharp/ui'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
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
                    <PrimaryButton @click="create"> Create Blog</PrimaryButton>
                </div>
            </div>

            <Tabs :as="Link" :tabs="tabs" :data="data">
                <slot />
            </Tabs>

            <Pagination :data="data" />
        </div>
    </AuthenticatedLayout>
</template>
