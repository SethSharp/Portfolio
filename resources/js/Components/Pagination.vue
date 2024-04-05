<script setup>
import {Link} from '@inertiajs/vue3'

const props = defineProps({
    data: {
        type: Object,
        default: null,
        required: false,
    }
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

    return (props.data.current_page * props.data.per_page) - props.data.per_page
}

const getTotalNumber = () => {
    if (props.data.current_page === 1) {
        return props.data.data.length
    }

    // most likely last page
    if (props.data.current_page === props.data.last_page) {
        return props.data.total
    }

    return props.data.current_page * props.data.per_page
}

const generateNext = (index) => {
    return props.data.links[index].url
}
</script>

<template>
    <div class="mt-12 flex">
        <div class="text-gray-500 my-auto">
            Showing {{ getStartingNumber() }} to {{ getTotalNumber() }} of {{ data.total }} results
        </div>
        <div class="ml-auto border border-gray-200 flex">
            <Link
                v-for="index in data.last_page" :href="generateNext(index)"
                class="px-4 py-2 border bg-gray-50 hover:bg-indigo-200 transition"
                :class="{'!bg-indigo-300' : index === data.current_page}"
            >
                {{ index }}
            </Link>
        </div>
    </div>
</template>
