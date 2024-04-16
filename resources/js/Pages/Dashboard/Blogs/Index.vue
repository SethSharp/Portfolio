<script setup>
import { router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import Blog from '@/Components/Cards/Blog.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import IndexBlogsLayout from '@/Layouts/IndexBlogsLayout.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'

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
            filter: { q: search.value, status: routeStatus },
        })
    )
}

watch(search, (newSearch) => {
    if (!newSearch) {
        visitSearch()
    }
})
</script>

<template>
    <IndexBlogsLayout :status="status" :count="blogs.data.length" :tabs="tabs" :data="blogs">
        <div class="flex">
            <div class="ml-auto flex gap-2">
                <TextInput type="search" @reset="reset()" v-model="search" />
                <SecondaryButton @click="visitSearch"> search</SecondaryButton>
            </div>
        </div>

        <div v-if="blogs.data.length > 0" class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-6">
            <Blog v-for="blog in blogs.data" :blog="blog" />
        </div>

        <div v-else class="flex justify-center align-middle">
            <div class="text-center">
                <h3 class="text-gray-400 text-md sm:text-xl">
                    There are currently no blogs in this state.
                </h3>

                <div v-if="status === 'published'" class="mt-4">
                    <PrimaryButton @click="create"> Create a Blog</PrimaryButton>
                </div>
            </div>
        </div>
    </IndexBlogsLayout>
</template>
