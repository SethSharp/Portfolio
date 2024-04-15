<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Form/Form.vue'
import Editor from '@/Components/Editor/Editor.vue'
import Select from '@/Components/Inputs/Select.vue'
import FormGrid from '@/Components/Form/FormGrid.vue'
import Checkbox from '@/Components/Inputs/Checkbox.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import FormElement from '@/Components/Form/FormElement.vue'
import InputError from '@/Components/Inputs/InputError.vue'
import MultiSelect from '@/Components/Inputs/MultiSelect.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import BlogCoverUpload from '@/Components/Inputs/BlogCoverUpload.vue'

const props = defineProps({
    blog: {
        type: Object,
        default: null,
    },
    collections: {
        type: Array,
        required: true,
    },
    tags: {
        type: Array,
        required: true,
    },
})

const collectionOptions = props.collections.map((collection) => {
    return {
        id: collection.id,
        name: collection.title,
    }
})

const tagOptions = props.tags.map((tag) => {
    return {
        id: tag.id,
        name: tag.name,
    }
})

const content = ref('')

const form = useForm({
    cover_image: null,
    title: props.blog?.title ? props.blog.title : '',
    slug: props.blog?.slug ? props.blog.slug : '',
    collection_id: props.blog?.collection_id ? props.blog.collection_id : null,
    tags: props.blog?.tags ? props.blog.tags : [],
    meta_title: props.blog?.meta_title ? props.blog.meta_title : '',
    meta_description: props.blog?.meta_description ? props.blog.meta_description : '',
    meta_tags: props.blog?.meta_tags ? props.blog.meta_tags : '',
    content: props.blog?.content ? props.blog.content : '',
    is_draft: !props.blog.is_published,
})

const submit = async () => {
    form.transform((data) => ({
        ...data,
        _method: 'put',
    })).post(route('dashboard.blogs.update', props.blog))
}

const confirmLeave = (e) => {
    if (form.isDirty) {
        e.returnValue = ''

        const message = 'Are you sure you want to leave? There are unsaved changes.'

        e.returnValue = message

        return message
    }
}

window.addEventListener('beforeunload', confirmLeave)
</script>

<template>
    <Form>
        <FormElement>
            <BlogCoverUpload
                v-model="form.cover_image"
                :current-image="blog.cover"
                label="Cover Image"
            />
            <InputError :message="form.errors.cover_image" />
        </FormElement>

        <FormElement>
            <Checkbox v-model="form.is_draft" label="Is Draft" :error="form.errors.is_draft" />
        </FormElement>

        <FormGrid>
            <TextInput autofocus v-model="form.title" :error="form.errors.title" label="Title" />

            <Select
                v-model="form.collection_id"
                :options="collectionOptions"
                label="Collection"
                :error="form.errors.collection_id"
            />
        </FormGrid>

        <FormGrid>
            <TextInput
                v-model="form.slug"
                label="Slug"
                :error="form.errors.slug"
                description="When viewing the blog in the web it will appear as blogs/slug"
            />

            <MultiSelect
                v-model="form.tags"
                :options="tagOptions"
                label="Tags"
                :error="form.errors.tags"
            />
        </FormGrid>

        <FormElement>
            <TextInput
                v-model="form.meta_title"
                label="Meta Title"
                :error="form.errors.meta_title"
            />
        </FormElement>

        <FormElement>
            <TextInput
                v-model="form.meta_description"
                label="Meta Description"
                description="Serves as a small blurb on the blog, used both in Google previews and within the portfolio site itself."
                :error="form.errors.meta_description"
            />
        </FormElement>

        <FormElement>
            <TextInput
                v-model="form.meta_tags"
                label="Meta Tags"
                description="Helps Google understand the content of the page - similar to how hashtags work on Instagram"
                :error="form.errors.meta_tags"
            />
        </FormElement>

        <FormElement>
            <Editor v-model="form.content" :blog="blog" />
            <InputError :message="form.errors.content" />
        </FormElement>

        <PrimaryButton as="submit" @click.prevent="submit">
            {{ blog ? 'Update' : 'Save' }}
        </PrimaryButton>
    </Form>
</template>
