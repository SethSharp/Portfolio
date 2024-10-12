<script setup>
import { router, Link } from '@inertiajs/vue3'
import { Button, LumuixTabs, LumuixPagination } from '@sethsharp/lumuix'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { computed } from 'vue'

defineProps({
    status: String,
    count: Number,
    data: {
        type: Object,
        default: null,
        required: false,
    },
})

const create = () => router.post(route('dashboard.blogs.create'))
const computedStatus = computed(() =>
    route().params.filter && route().params.filter.status
        ? route().params.filter.status
        : 'published'
)

const statuses = ['published', 'drafted', 'deleted']

const computedTabs = computed(() => [
    ...statuses.map((status) => {
        return {
            name: status.charAt(0).toUpperCase() + status.slice(1).toLowerCase(),
            active: status === computedStatus.value,
            href: route('dashboard.blogs.index', { filter: { status: status } }),
            is: Link,
        }
    }),
])
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

            <LumuixTabs :tabs="computedTabs" :data="data">
                <slot />

                <LumuixPagination :data="data" />
            </LumuixTabs>
        </div>
    </AuthenticatedLayout>
</template>
