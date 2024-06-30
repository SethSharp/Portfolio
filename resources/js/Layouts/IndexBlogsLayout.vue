<script setup>
import { router, Link } from '@inertiajs/vue3'
import { PrimaryButton, Tabs } from '@sethsharp/ui'
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

console.log(props.tabs)

const create = () => router.post(route('dashboard.blogs.create'))
</script>

<template>
    <AuthenticatedLayout title="Blogs">
        <div class="p-3 sm:p-6">
            <div class="sm:flex mb-4">
                <h1 class="text-lg sm:text-xl md:text-2xl font-medium">
                    {{ status }} Blogs ({{ count }})
                </h1>
                <div class="flex ml-auto">
                    <PrimaryButton @click="create"> Create Blog</PrimaryButton>
                </div>
            </div>

            <Tabs :as="Link" :tabs="tabs" :data="data">
                <slot />
            </Tabs>
        </div>
    </AuthenticatedLayout>
</template>
