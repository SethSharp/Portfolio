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

const props = defineProps({
    series: {
        type: Object,
        default: null,
    },
})

const emits = defineEmits(['close'])
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
        console.log(res)
    })
}

const removeBlog = (blog) => {
    if (confirm('Are you sure to want to remove the blog from this series?')) {
        form.blogs = form.blogs.filter((formBlog) => formBlog.id !== blog.id)
    }
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
            <input type="text" v-model="search" @keyup.enter="findBlogs(search)" />
            <div class="space-y-2 overflow-scroll h-44">
                <div v-for="blog in form.blogs" class="bg-gray-300 rounded-xl p-2 text-sm">
                    <div>
                        {{ blog.title }}
                    </div>

                    <div @click="removeBlog(blog)" class="text-black font-medium cursor-pointer">
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
