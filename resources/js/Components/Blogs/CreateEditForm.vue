<script setup>
import { computed, ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import {
    Button,
    Input,
    Checkbox,
    TextArea,
    FormElement,
    Error,
    Combobox,
    FormGrid,
    Form,
    ImageUpload,
    Label,
    Description,
} from '@sethsharp/lumuix'
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

const blogTags = computed(() =>
    props.blog?.tags
        ? props.blog.tags.map((tag) => {
              return {
                  id: tag.id,
                  name: tag.name,
              }
          })
        : []
)

const content = ref('')

const form = useForm({
    cover_image: null,
    title: props.blog?.title ? props.blog.title : '',
    slug: props.blog?.slug ? props.blog.slug : '',
    collection_id: props.blog?.collection_id ? props.blog.collection_id : null,
    tags: blogTags.value,
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

        const error = 'Are you sure you want to leave? There are unsaved changes.'

        e.returnValue = error

        return error
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
            <Error :error="form.errors.cover_image" />
        </FormElement>

        <FormElement>
            <Checkbox
                id="is_draft"
                v-model="form.is_draft"
                text="Is Draft"
                :error="form.errors.is_draft"
            />
        </FormElement>

        <FormGrid>
            <FormElement>
                <Input id="title" v-model="form.title" :error="form.errors.title" label="Title" />
            </FormElement>

            <FormElement class="flex flex-col space-y-2">
                <Combobox
                    id="collection"
                    label="Collection"
                    v-model="form.collection_id"
                    :options="collectionOptions"
                    allow-search
                    width-class="w-full md:w-96"
                    :error="form.errors.collection_id"
                />
            </FormElement>
        </FormGrid>

        <FormGrid>
            <FormElement>
                <Input
                    id="slug"
                    label="Slug (must be lowercase separated by '-')"
                    v-model="form.slug"
                    placeholder="a-new-blog-of-mine"
                />
                <Description>
                    {{
                        'Can be left empty, title will be slugified and entered here. When viewing the blog in the web it will appear as blogs/' +
                        (form.slug ? form.slug : form.title ? form.title : 'some-value')
                    }}
                </Description>
                <Error :error="form.errors.slug" />
            </FormElement>

            <FormElement class="flex flex-col space-y-2">
                <Combobox
                    v-model="form.tags"
                    label="Tags"
                    :options="tagOptions"
                    width-class="w-full md:w-96"
                    multiple
                    allow-search
                    :error="form.errors.tags"
                />
            </FormElement>
        </FormGrid>

        <FormElement>
            <Input
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
                label="Meta Description"
                description="Serves as a small blurb on the blog, used both in Google previews and within the portfolio site itself."
                v-model="form.meta_description"
                :error="form.errors.meta_description"
            />
        </FormElement>

        <FormElement>
            <Input
                id="meta-tags"
                label="Meta Tags"
                description="Helps Google understand the content of the page - similar to how hashtags work on Instagram"
                v-model="form.meta_tags"
                :error="form.errors.meta_tags"
            />
        </FormElement>

        <FormElement>
            <Editor v-model="form.content" :blog="blog" :error="form.errors.content" />
        </FormElement>

        <Button variant="primary" @click.prevent="submit">
            {{ blog ? 'Update' : 'Save' }}
        </Button>
    </Form>
</template>
