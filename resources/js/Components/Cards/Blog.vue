<script setup>
import { Link } from '@inertiajs/vue3'
import { PencilSquareIcon, EyeIcon } from '@heroicons/vue/16/solid/index.js'

defineProps({
    blog: {
        type: Object,
        required: true,
    },
})
</script>

<template>
    <div class="group bg-gray-100 rounded-3xl relative w-auto h-64 overflow-hidden">
        <div class="p-4 h-full">
            <Link :href="route('dashboard.blogs.edit', blog)">
                <h1 class="font-bold text-lg">{{ blog.title }}</h1>

                <h1 class="text-md text-gray-600 font-medium">{{ blog.author.name }}</h1>

                <div class="text-gray-400">
                    {{ blog?.meta_description?.substring(1, 50) }}
                </div>
            </Link>
        </div>

        <div
            class="absolute inset-0 flex w-full h-full bg-black bg-opacity-25 opacity-0 transition group-hover:opacity-100"
        >
            <div class="w-full h-full flex-wrap gap-y-2">
                <div class="text-center bg-white hover:bg-gray-100 transition p-4 m-4 rounded-lg">
                    <Link
                        :href="route('dashboard.blogs.edit', blog)"
                        class="text-center w-full !bg-red-300"
                    >
                        <PencilSquareIcon class="w-6 h-6 mx-auto" />
                    </Link>
                </div>

                <div class="text-center bg-white hover:bg-gray-100 transition p-4 m-4 rounded-lg">
                    <Link :href="route('blogs.show', blog)" class="text-center w-full !bg-red-50">
                        <EyeIcon class="w-6 h-6 mx-auto" />
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
