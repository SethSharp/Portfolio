<script setup>
import { Link, router } from '@inertiajs/vue3'
import {
    PencilSquareIcon,
    EyeIcon,
    TrashIcon,
    ArrowLeftStartOnRectangleIcon,
} from '@heroicons/vue/16/solid/index.js'
import { getBlogCoverImage } from '@/Helpers/helpers.js'

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

const restoreBlog = () => {
    router.put(
        route('dashboard.blogs.restore'),
        {
            blog_id: props.blog,
        },
        {
            onBefore: () => confirm('Are you sure you want to restore this blog?'),
        }
    )
}
</script>

<template>
    <div class="group h-full rounded-3xl relative overflow-hidden">
        <div class="sm:flex h-full gap-2">
            <div class="sm:w-1/2 p-4">
                <img
                    :src="getBlogCoverImage(blog.cover)"
                    class="rounded-lg h-full object-cover object-left max-h-64 mx-auto aspect-square"
                />
            </div>

            <div class="sm:w-1/2 p-2">
                <h3>
                    {{ blog.title }}
                </h3>
                <div class="line-clamp-4 text-xs text-gray-400">
                    {{ blog.meta_description }}
                </div>
            </div>
        </div>

        <div
            class="absolute inset-0 flex w-full h-full bg-black bg-opacity-10 opacity-0 transition group-hover:opacity-100"
        >
            <div class="w-full h-full flex gap-2 p-2">
                <div
                    v-if="!blog.deleted_at"
                    class="text-center bg-white hover:bg-gray-100 transition size-10 rounded-lg"
                >
                    <Link :href="route('dashboard.blogs.edit', blog)" class="size-full">
                        <PencilSquareIcon
                            class="text-gray-500 hover:text-gray-700 transition p-1"
                        />
                    </Link>
                </div>

                <div
                    v-if="!blog.deleted_at"
                    class="text-center bg-white hover:bg-gray-100 transition size-10 rounded-lg"
                >
                    <a :href="route('blogs.show', blog)" class="size-full">
                        <EyeIcon class="text-gray-500 hover:text-gray-700 transition p-1" />
                    </a>
                </div>

                <div
                    v-if="!blog.deleted_at"
                    class="text-center bg-white hover:bg-gray-100 transition size-10 rounded-lg"
                >
                    <button @click.prevent="deleteBlog" class="size-full">
                        <TrashIcon class="text-gray-500 hover:text-gray-700 transition p-1" />
                    </button>
                </div>

                <div
                    v-else
                    class="text-center bg-white hover:bg-gray-100 transition size-10 rounded-lg"
                >
                    <button @click.prevent="restoreBlog" class="size-full">
                        <ArrowLeftStartOnRectangleIcon
                            class="text-gray-500 hover:text-gray-700 transition p-1"
                        />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
