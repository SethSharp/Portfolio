<script setup>
import { Link } from '@inertiajs/vue3'
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/solid/index.js'

const props = defineProps({
    data: {
        type: Object,
        default: null,
        required: false,
    },
})

const getStartingNumber = () => {
    if (props.data.current_page === 1) {
        if (props.data.data.length === 0) {
            return 0
        }

        return 1
    }

    if (props.data.current_page === props.data.last_page) {
        return props.data.total - props.data.data.length
    }

    return props.data.current_page * props.data.per_page - props.data.per_page
}

const getTotalNumber = () => {
    if (props.data.current_page === 1) {
        return props.data.data.length
    }

    if (props.data.current_page === props.data.last_page) {
        return props.data.total
    }

    return props.data.current_page * props.data.per_page
}

const generateNext = (index) => {
    return props.data.links[index].url
}

const linkClasses =
    'px-4 py-2 flex border bg-gray-50 hover:text-primary-600 font-medium transition '
</script>

<template>
    <div class="mt-12 flex">
        <div class="text-gray-500 my-auto">
            Showing {{ getStartingNumber() }} to {{ getTotalNumber() }} of {{ data.total }} results
        </div>

        <div class="ml-auto border border-gray-200 flex">
            <Link v-if="data.prev_page_url" :href="data.prev_page_url" :class="linkClasses">
                <ChevronLeftIcon class="size-5 my-auto" />
            </Link>
            <Link
                v-for="index in data.last_page"
                :href="generateNext(index)"
                class="px-4 py-2 flex border bg-gray-50 hover:text-primary-600 font-medium transition"
                :class="{ '!text-primary-500': props.data.current_page === index }"
            >
                <span class="my-auto">{{ index }}</span>
            </Link>
            <Link v-if="data.next_page_url" :href="data.next_page_url" :class="linkClasses">
                <ChevronRightIcon class="size-5 my-auto" />
            </Link>
        </div>
    </div>
</template>
