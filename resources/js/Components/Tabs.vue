<script setup>
import { Link } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue'

defineProps({
    tabs: {
        type: Object,
        required: true,
    },
    data: {
        type: Object,
        default: null,
        required: false,
    },
})
</script>

<template>
    <div>
        <div class="w-full bg-white rounded-t-lg">
            <div class="flex gap-4 border-b p-1.5">
                <div v-for="tab in tabs" class="">
                    <Link
                        :href="tab.href"
                        class="hover:text-indigo-500 text-gray-600 transition p-2 border-b-2 border-b-gray-300"
                        :class="{ 'text-indigo-600 !border-b-indigo-600': tab.active }"
                    >
                        {{ tab.name }}
                    </Link>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <slot />
        </div>

        <div v-if="data" class="mt-12">
            <Pagination :data="data" />
        </div>
    </div>
</template>
