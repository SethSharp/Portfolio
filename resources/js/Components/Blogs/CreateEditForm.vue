<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import {
    PrimaryButton,
    Text,
    Checkbox,
    TextArea,
    FormElement,
    Error,
    Combobox,
    FormGrid,
    Select,
    Form,
    ImageUpload,
} from '@sethsharp/ui'
import Editor from '@/Components/Editor/Editor.vue'
import { getBlogCoverImage } from '@/Helpers/helpers.js'

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
            <ImageUpload
                v-model="form.cover_image"
                :current-image="blog.cover"
                label="Cover Image"
                :default-image="getBlogCoverImage(null)"
            >
                <template #image="{ newImage, curImage }">
                    <img
                        :src="newImage ? newImage : curImage"
                        alt="Image cannot be loaded"
                        class="max-w-lg max-h-40 sm:max-h-64 object-cover object-center"
                    />
                </template>
            </ImageUpload>
            <Error :message="form.errors.cover_image" />
        </FormElement>

        <FormElement>
            <Checkbox
                v-model="form.is_draft"
                label="Is Draft"
                :error="form.errors.is_draft"
                :show-label="false"
            />
        </FormElement>

        <FormGrid>
            <Text id="title" v-model="form.title" :error="form.errors.title" label="Title" />

            <Select
                v-model="form.collection_id"
                :options="collectionOptions"
                label="Collection"
                :error="form.errors.collection_id"
            />
        </FormGrid>

        <FormGrid>
            <Text
                id="slug"
                v-model="form.slug"
                label="Slug (must be lowercase separated by '-')"
                :error="form.errors.slug"
                placeholder="a-new-blog-of-mine"
                :description="
                    'Can be left empty, title will be slugified and entered here. When viewing the blog in the web it will appear as blogs/' +
                    (form.slug ? form.slug : form.title ? form.title : 'some-value')
                "
            />

            <Combobox
                v-model="form.tags"
                :options="tagOptions"
                label="Tags"
                :error="form.errors.tags"
            />
        </FormGrid>

        <FormElement>
            <Text
                id="meta-title"
                v-model="form.meta_title"
                label="Meta Title"
                description="Serves as a SEO title for Google to read (can be the same as your regular title)"
                :error="form.errors.meta_title"
            />
        </FormElement>

        <FormElement>
            <TextArea
                id="meta-description"
                v-model="form.meta_description"
                label="Meta Description"
                description="Serves as a small blurb on the blog, used both in Google previews and within the portfolio site itself."
                :error="form.errors.meta_description"
            />
        </FormElement>

        <FormElement>
            <Text
                id="meta-tags"
                v-model="form.meta_tags"
                label="Meta Tags"
                description="Helps Google understand the content of the page - similar to how hashtags work on Instagram"
                :error="form.errors.meta_tags"
            />
        </FormElement>

        <FormElement>
            <Editor v-model="form.content" :blog="blog" />
            <Error :message="form.errors.content" />
        </FormElement>

        <PrimaryButton as="button" @click.prevent="submit">
            {{ blog ? 'Update' : 'Save' }}
        </PrimaryButton>
    </Form>
</template>
