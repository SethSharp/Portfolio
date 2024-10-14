<script setup>
import { Link } from '@inertiajs/vue3'
import { computed, onMounted, onUpdated } from 'vue'
import { LumuixPagination, LumuixTabs } from '@sethsharp/lumuix'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
    count: Number,
    data: {
        type: Object,
        default: null,
        required: false,
    },
})

const statuses = ['active', 'deleted']
const computedStatus = computed(() =>
    route().params.filter && route().params.filter.status ? route().params.filter.status : 'active'
)

const computedTabs = computed(() => [
    ...statuses.map((status) => {
        return {
            name: status.charAt(0).toUpperCase() + status.slice(1).toLowerCase(),
            active: status === computedStatus.value,
            href: route('dashboard.tags.index', { filter: { status: status } }),
            is: Link,
        }
    }),
])

onUpdated(() => {
    props.data.links.shift()
    props.data.links.pop()
})

onMounted(() => {
    props.data.links.shift()
    props.data.links.pop()
})
</script>

<template>
    <AuthenticatedLayout title="Tags">
        <div class="p-3 sm:p-6">
            <div class="sm:flex mb-4">
                <slot name="header" />
            </div>

            <LumuixTabs :tabs="computedTabs">
                <slot />

                <LumuixPagination :as="Link" :data="data" />
            </LumuixTabs>
        </div>
    </AuthenticatedLayout>
</template>
