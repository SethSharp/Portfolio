<script setup>
import { Link, router } from '@inertiajs/vue3'
import { PencilSquareIcon, EyeIcon, TrashIcon } from '@heroicons/vue/16/solid/index.js'

const props = defineProps({
    blog: {
        type: Object,
        required: true,
    },
})

const deleteBlog = () => {
    router.delete(route('dashboard.blogs.delete', props.blog), {
        onBefore: () => confirm('Are you sure you want to delete this blog?'),
    })
}
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
                <div class="text-center bg-white hover:bg-gray-100 transition m-4 rounded-lg">
                    <Link :href="route('dashboard.blogs.edit', blog)" class="size-full">
                        <span class="flex p-4">
                            <PencilSquareIcon class="w-6 h-6 mx-auto my-auto" />
                        </span>
                    </Link>
                </div>

                <div class="text-center bg-white hover:bg-gray-100 transition m-4 rounded-lg">
                    <a :href="route('blogs.show', blog)" class="size-full">
                        <span class="flex p-4">
                            <EyeIcon class="size-6 mx-auto my-auto" />
                        </span>
                    </a>
                </div>

                <div class="text-center bg-white hover:bg-gray-100 transition m-4 rounded-lg">
                    <button @click.prevent="deleteBlog" class="size-full">
                        <span class="flex p-4">
                            <TrashIcon class="size-6 mx-auto my-auto" />
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
