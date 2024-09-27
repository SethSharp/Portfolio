<script setup>
import { computed, onMounted, ref, watch } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import { Button, Input, Datatable, Dropdown, BaseDropdownMenuItem } from '@sethsharp/lumuix'
import {
    ArrowLeftStartOnRectangleIcon,
    EyeIcon,
    PencilSquareIcon,
    TrashIcon,
    EllipsisVerticalIcon,
} from '@heroicons/vue/16/solid/index.js'
import IndexBlogsLayout from '@/Layouts/IndexBlogsLayout.vue'
import { formatDate, getBlogCoverImage } from '@/Helpers/helpers.js'

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
            value: 'deleted_at',
            name: 'Deleted At',
        },
    ],
    rows: props.blogs.data,
}))

const deleteBlog = (blog) =>
    router.delete(route('dashboard.blogs.delete', blog), {
        onBefore: () => confirm('Are you sure you want to delete this blog?'),
    })

const restoreBlog = (blog) =>
    router.put(
        route('dashboard.blogs.restore'),
        {
            blog_id: blog,
        },
        {
            onBefore: () => confirm('Are you sure you want to restore this blog?'),
        }
    )

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
        <div class="flex my-4">
            <div class="ml-auto flex gap-2">
                <Input type="search" v-model="search" placeholder="Search for Blogs" />
                <Button variant="primary" @click="visitSearch"> search</Button>
            </div>
        </div>

        <Datatable v-if="blogs.data.length" v-bind="dataTableConfig">
            <template #cell_cover="{ item }">
                <div class="">
                    <img
                        :src="getBlogCoverImage(item.cover)"
                        alt="Blog cover image"
                        class="rounded-lg h-full object-cover object-left max-h-64 mx-auto aspect-square"
                    />
                </div>
            </template>

            <template #cell_created_at="{ item }">
                {{ formatDate(item.created_at) }}
            </template>

            <template #cell_updated_at="{ item }">
                {{ formatDate(item.updated_at) }}
            </template>

            <template #cell_deleted_at="{ item }">
                <div v-if="item.deleted_at">
                    {{ formatDate(item.deleted_at) }}
                </div>
                <div v-else>-</div>
            </template>

            <template #row_actions="{ item }">
                <Dropdown width-class="w-fit">
                    <template #trigger>
                        <Button variant="secondary">
                            <EllipsisVerticalIcon class="size-5" />
                        </Button>
                    </template>

                    <template #content>
                        <BaseDropdownMenuItem v-if="!item.deleted_at">
                            <Link
                                :href="route('dashboard.blogs.edit', item)"
                                class="justify-center flex size-full gap-2"
                            >
                                <PencilSquareIcon
                                    class="text-gray-500 dark:text-slate-300 transition size-7"
                                />
                                <span class="my-auto text-gray-600 dark:text-slate-300"> Edit</span>
                            </Link>
                        </BaseDropdownMenuItem>

                        <BaseDropdownMenuItem v-if="!item.deleted_at">
                            <a
                                :href="route('blogs.show', item)"
                                class="justify-center flex size-full gap-2"
                            >
                                <EyeIcon
                                    class="text-gray-500 dark:text-slate-300 transition size-7"
                                />
                                <span class="my-auto text-gray-600 dark:text-slate-300">
                                    View
                                </span>
                            </a>
                        </BaseDropdownMenuItem>

                        <BaseDropdownMenuItem v-if="!item.deleted_at">
                            <button
                                @click.prevent="deleteBlog(item)"
                                class="justify-center flex size-full gap-2"
                            >
                                <TrashIcon
                                    class="text-gray-500 dark:text-slate-300 transition size-7"
                                />
                                <span class="my-auto text-gray-600 dark:text-slate-300">
                                    Delete
                                </span>
                            </button>
                        </BaseDropdownMenuItem>

                        <BaseDropdownMenuItem v-else>
                            <button
                                @click.prevent="restoreBlog(item)"
                                class="justify-center flex size-full"
                            >
                                <ArrowLeftStartOnRectangleIcon
                                    class="text-gray-500 dark:text-slate-300 transition size-7"
                                />
                                <span class="my-auto text-gray-600 dark:text-slate-300">
                                    Restore
                                </span>
                            </button>
                        </BaseDropdownMenuItem>
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
                    <Button variant="primary" :as="Link" @click="create"> Create a Blog</Button>
                </div>
            </div>
        </div>
    </IndexBlogsLayout>
</template>
