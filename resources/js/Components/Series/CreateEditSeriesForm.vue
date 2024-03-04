<script setup>
import { ref } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import Form from '@/Components/Form/Form.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import FormElement from '@/Components/Form/FormElement.vue'
import InputError from '@/Components/Inputs/InputError.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import DangerButton from '@/Components/Buttons/DangerButton.vue'
import TextArea from '@/Components/Inputs/TextArea.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'

const props = defineProps({
    series: {
        type: Object,
        default: null,
    },
})

const emits = defineEmits(['close'])
const findANewBlog = ref(false)
const search = ref(null)
const blogs = ref([])

const form = useForm({
    title: props.series?.title ? props.series.title : '',
    description: props.series?.description ? props.series.description : '',
    blogs: props.series?.blogs ? props.series.blogs : [],
})

const submit = () => {
    if (props.series) {
        form.put(route('dashboard.series.update', props.series), {
            onSuccess: () => emits('close'),
        })
    } else {
        form.post(route('dashboard.series.store'), {
            onSuccess: () => emits('close'),
        })
    }
}

const destroySeries = () => {
    router.delete(route('dashboard.series.destroy', props.series), {
        onBefore: () => confirm('Are you sure you want to permanently delete this series?'),
        onSuccess: () => emits('close'),
    })
}

const findBlogs = (search) => {
    axios.get(route('dashboard.search.blogs') + '?search=' + search).then((res) => {
        blogs.value = res.data.blogs
    })
}

const addBlog = (newBlog) => {
    if (!form.blogs.find((blog) => blog.id === newBlog.id)) {
        form.blogs.push(newBlog)
        blogs.value = blogs.value.filter((blog) => blog.id !== newBlog.id)
    } else {
        alert('This blog has already been added to the series.')
    }
}

const removeBlog = (blog) => {
    if (confirm('Are you sure to want to remove the blog from this series?')) {
        form.blogs = form.blogs.filter((formBlog) => formBlog.id !== blog.id)
    }
}

const cancel = () => {
    findANewBlog.value = false
    blogs.value = []
}
</script>

<template>
    <Form>
        <FormElement>
            <TextInput v-model="form.title" autofocus label="Name" />
            <InputError :message="form.errors.title" />
        </FormElement>

        <FormElement>
            <TextArea v-model="form.description" label="Description" />
            <InputError :message="form.errors.description" />
        </FormElement>

        <FormElement v-if="form.blogs">
            <div>
                <div class="flex">
                    <TextInput
                        v-if="findANewBlog"
                        type="text"
                        v-model="search"
                        @keyup.enter="findBlogs(search)"
                        class="w-full"
                    />

                    <div class="my-auto ml-2">
                        <PrimaryButton v-if="!findANewBlog" @click="findANewBlog = true">
                            Search for a new blog
                        </PrimaryButton>
                        <SecondaryButton v-if="findANewBlog" @click="cancel()">
                            Cancel
                        </SecondaryButton>
                    </div>
                </div>

                <div
                    v-if="blogs && findANewBlog"
                    v-for="blog in blogs"
                    class="bg-gray-300 rounded-xl p-2 text-sm mt-3 hover:bg-gray-200 hover:cursor-pointer"
                    @click="addBlog(blog)"
                >
                    <div>
                        {{ blog.title }}
                    </div>
                </div>
            </div>

            <div v-if="!findANewBlog" class="space-y-2 overflow-scroll h-52 mt-6">
                <h1>Current Blogs</h1>
                <div v-for="blog in form.blogs" class="bg-gray-200 rounded-xl p-2 text-sm">
                    <div>
                        {{ blog.title }}
                    </div>

                    <div @click="removeBlog(blog)" class="text-black font-bold cursor-pointer">
                        remove
                    </div>
                </div>
            </div>
        </FormElement>

        <div class="gap-x-2 flex">
            <DangerButton @click.prevent="destroySeries"> Delete</DangerButton>

            <PrimaryButton @click.prevent="submit"> Save</PrimaryButton>
        </div>
    </Form>
</template>
