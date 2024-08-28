<script setup>
import { computed, onMounted, ref, watch } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import { SecondaryButton, PrimaryButton, Text, Datatable, Dropdown } from '@sethsharp/ui'
import Blog from '@/Components/Cards/Blog.vue'
import IndexBlogsLayout from '@/Layouts/IndexBlogsLayout.vue'
import {
    ArrowLeftStartOnRectangleIcon,
    EyeIcon,
    PencilSquareIcon,
    TrashIcon,
} from '@heroicons/vue/16/solid/index.js'
import { getBlogCoverImage } from '@/Helpers/helpers.js'

const props = defineProps({
    blogs: Object,
    tabs: Object,
    status: String,
})

const routeStatus =
    route().params.filter && route().params.filter.status ? route().params.filter.status : ''
const query = route().params.filter && route().params.filter.q ? route().params.filter.q : ''
const search = ref(query)

const create = () => {
    router.post(route('dashboard.blogs.create'))
}

const visitSearch = () => {
    router.visit(
        route('dashboard.blogs.index', {
            filter: { q: search.value, status: routeStatus ?? null },
        })
    )
}

const dataTableConfig = computed(() => ({
    headers: [
        {
            value: 'cover',
            name: 'Cover',
        },
        {
            value: 'title',
            name: 'Title',
        },
        {
            value: 'meta_description',
            name: 'Meta Description',
        },
        {
            value: 'created_at',
            name: 'Created At',
        },
        {
            value: 'updated_at',
            name: 'Updated At',
        },
        {
            value: 'deleted_at',
            name: 'Deleted At',
        },
    ],
    rows: props.allCollections,
}))

const deleteBlog = (blog) => {
    router.delete(route('dashboard.blogs.delete', blog), {
        onBefore: () => confirm('Are you sure you want to delete this blog?'),
    })
}

const restoreBlog = (blog) => {
    router.put(
        route('dashboard.blogs.restore'),
        {
            blog_id: blog,
        },
        {
            onBefore: () => confirm('Are you sure you want to restore this blog?'),
        }
    )
}

watch(search, (newSearch) => {
    if (!newSearch) {
        visitSearch()
    }
})

onMounted(() => {
    props.blogs.links.shift()
    props.blogs.links.pop()
})
</script>

<template>
    <IndexBlogsLayout :status="status" :count="blogs.data.length" :tabs="tabs" :data="blogs">
        <div class="flex">
            <div class="ml-auto flex gap-2">
                <Text type="search" v-model="search" placeholder="Search for Blogs" />
                <SecondaryButton @click="visitSearch"> search </SecondaryButton>
            </div>
        </div>

        <div v-if="blogs.data.length > 0" class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-6">
            <Blog v-for="blog in blogs.data" :blog="blog" />
        </div>

        <Datatable v-bind="dataTableConfig">
            <template #cell_cover="{ item }">
                <div class="sm:w-1/2 p-4">
                    <img
                        :src="getBlogCoverImage(item.cover)"
                        alt="Blog cover image"
                        class="rounded-lg h-full object-cover object-left max-h-64 mx-auto aspect-square"
                    />
                </div>
            </template>

            <template #cell_deleted_at="{ item }">
                <div v-if="item">
                    {{ item }}
                </div>
            </template>

            <template #row-actions="{ item }">
                <Dropdown>
                    <template #trigger>
                        <SecondaryButton> Actions </SecondaryButton>
                    </template>

                    <template #trigger>
                        <div
                            v-if="!item.deleted_at"
                            class="text-center bg-white hover:bg-gray-100 transition size-10 rounded-lg"
                        >
                            <Link :href="route('dashboard.blogs.edit', item)" class="size-full">
                                <PencilSquareIcon
                                    class="text-gray-500 hover:text-gray-700 transition p-1"
                                />
                            </Link>
                        </div>

                        <div
                            v-if="!item.deleted_at"
                            class="text-center bg-white hover:bg-gray-100 transition size-10 rounded-lg"
                        >
                            <a :href="route('blogs.show', item)" class="size-full">
                                <EyeIcon class="text-gray-500 hover:text-gray-700 transition p-1" />
                            </a>
                        </div>

                        <div
                            v-if="!item.deleted_at"
                            class="text-center bg-white hover:bg-gray-100 transition size-10 rounded-lg"
                        >
                            <button @click.prevent="deleteBlog(item)" class="size-full">
                                <TrashIcon
                                    class="text-gray-500 hover:text-gray-700 transition p-1"
                                />
                            </button>
                        </div>

                        <div
                            v-else
                            class="text-center bg-white hover:bg-gray-100 transition size-10 rounded-lg"
                        >
                            <button @click.prevent="restoreBlog(item)" class="size-full">
                                <ArrowLeftStartOnRectangleIcon
                                    class="text-gray-500 hover:text-gray-700 transition p-1"
                                />
                            </button>
                        </div>
                    </template>
                </Dropdown>
            </template>
        </Datatable>

        <div v-else class="mt-6 flex justify-center align-middle">
            <div class="text-center">
                <h3 class="text-gray-400 text-md sm:text-xl">
                    There are currently no blogs in this state.
                </h3>

                <div v-if="status === 'published'" class="mt-4">
                    <PrimaryButton :as="Link" @click="create"> Create a Blog</PrimaryButton>
                </div>
            </div>
        </div>
    </IndexBlogsLayout>
</template>
