<script setup>
import Tabs from '@/Components/Tabs.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
    status: String,
    tabs: Object,
    count: Number,
    data: {
        type: Object,
        default: null,
        required: false,
    }
})
</script>

<template>
    <AuthenticatedLayout title="Tags">
        <div class="p-3 sm:p-6">
            <div class="sm:flex mb-4">
                <slot name="header"/>
            </div>

            <Tabs :tabs="tabs" :data="data">
                <slot/>
            </Tabs>
        </div>
    </AuthenticatedLayout>
</template>
