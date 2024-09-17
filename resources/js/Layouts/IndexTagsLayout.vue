<script setup>
import { onMounted, onUpdated } from 'vue'
import { Pagination, Tabs } from '@sethsharp/lumuix'
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

            <Tabs :tabs="tabs">
                <slot />

                <Pagination :data="data" />
            </Tabs>
        </div>
    </AuthenticatedLayout>
</template>
