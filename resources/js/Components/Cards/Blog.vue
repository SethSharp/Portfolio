<script setup>
import {Link, router} from '@inertiajs/vue3'
import {PencilSquareIcon, EyeIcon, TrashIcon, HeartIcon} from '@heroicons/vue/16/solid/index.js'

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
    <div class="group bg-gray-100 rounded-3xl relative w-auto min-h-64 overflow-hidden">
        <div class="h-full">
            <div class="rounded-xl shadow-md overflow-hidden sm:flex md:space-y-4">
                <div class="sm:h-full sm:w-1/2 p-2 md:p-4">
                    <img
                        :src="blog.cover"
                        class="rounded-lg overflow-hidden object-cover aspect-square object-left lg:size-full max-h-52 md:max-h-80 m-auto"
                    />
                </div>

                <div class="sm:w-1/2 text-left px-4 h-full md:py-2">
                    <div>
                        <div class="flex">
                            <p class="text-xs text-gray-400 font-medium my-auto">
                                {{ blog.author.name }} {{ blog.published_at }}
                            </p>

                            <div class="flex my-auto gap-0.5 ml-2 text-sm text-gray-400">
                                <HeartIcon class="size-3 my-auto"/>
                                <span> - </span>
                            </div>
                        </div>

                        <p class="text-xl font-semibold">{{ blog.title }}</p>

                        <div class="py-2 text-md text-secondary-400">
                            {{ blog?.meta_description }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="absolute inset-0 flex w-full h-full bg-black bg-opacity-25 opacity-0 transition group-hover:opacity-100"
        >
            <div class="w-full h-full flex-wrap gap-y-2">
                <div class="text-center bg-white hover:bg-gray-100 transition m-4 rounded-lg">
                    <Link :href="route('dashboard.blogs.edit', blog)" class="size-full">
                        <span class="flex p-4">
                            <PencilSquareIcon class="w-6 h-6 mx-auto my-auto"/>
                        </span>
                    </Link>
                </div>

                <div class="text-center bg-white hover:bg-gray-100 transition m-4 rounded-lg">
                    <a :href="route('blogs.show', blog)" class="size-full">
                        <span class="flex p-4">
                            <EyeIcon class="size-6 mx-auto my-auto"/>
                        </span>
                    </a>
                </div>

                <div class="text-center bg-white hover:bg-gray-100 transition m-4 rounded-lg">
                    <button @click.prevent="deleteBlog" class="size-full">
                        <span class="flex p-4">
                            <TrashIcon class="size-6 mx-auto my-auto"/>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
