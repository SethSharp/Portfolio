<script setup>
import { useForm } from '@inertiajs/vue3'
import Form from '@/Components/Form/Form.vue'
import Checkbox from '@/Components/Inputs/Checkbox.vue'
import TextArea from '@/Components/Inputs/TextArea.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import FormElement from '@/Components/Form/FormElement.vue'
import InputError from '@/Components/Inputs/InputError.vue'
import MultiSelect from '@/Components/Inputs/MultiSelect.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import Editor from '@/Components/Editor/Editor.vue'
import { onMounted, ref, watch } from 'vue'

const props = defineProps({
    blog: {
        type: Object,
        default: null,
    },
    tags: {
        type: Array,
        required: true,
    },
})

const tagOptions = props.tags.map((tag) => {
    return {
        id: tag.id,
        name: tag.name,
    }
})

const content = ref('')

const form = useForm({
    title: props.blog?.title ? props.blog.title : '',
    slug: props.blog?.slug ? props.blog.slug : '',
    tags: props.blog?.tags ? props.blog.tags : [],
    meta_title: props.blog?.meta_title ? props.blog.meta_title : '',
    meta_description: props.blog?.meta_description ? props.blog.meta_description : '',
    meta_tags: props.blog?.meta_tags ? props.blog.meta_tags : '',
    content: props.blog?.content ? props.blog.content : '',
    is_draft: props.blog?.is_draft ? props.blog.is_draft : false,
})

const submit = () => {
    if (props.blog) {
        form.put(route('dashboard.blogs.update', props.blog))
    } else {
        form.post(route('dashboard.blogs.store'))
    }
}
</script>

<template>
    <Form>
        <FormElement>
            <TextInput v-model="form.title" autofocus label="Title" />
            <InputError :message="form.errors.title" />
        </FormElement>

        <FormElement>
            <TextInput v-model="form.slug" label="Slug" />
            <InputError :message="form.errors.slug" />
        </FormElement>

        <FormElement>
            <MultiSelect v-model="form.tags" :options="tagOptions" label="Tags" />
            <InputError :message="form.errors.tags" />
        </FormElement>

        <FormElement>
            <TextInput v-model="form.meta_title" label="Meta Title" />
            <InputError :message="form.errors.meta_title" />
        </FormElement>

        <FormElement>
            <TextInput
                v-model="form.meta_description"
                label="Meta Description"
                description="What users will see in google or in the portfolio to see what each blog entails."
            />
            <InputError :message="form.errors.meta_description" />
        </FormElement>

        <FormElement>
            <TextInput v-model="form.meta_tags" label="Meta Tags" />
            <InputError :message="form.errors.meta_tags" />
        </FormElement>

        <FormElement>
            <Editor v-model="form.content" />
            <InputError :message="form.errors.content" />
        </FormElement>

        <FormElement>
            <Checkbox v-model="form.is_draft" :checked="form.is_draft" label="Is Draft" />
            <InputError :message="form.errors.is_draft" />
        </FormElement>

        <PrimaryButton as="submit" @click.prevent="submit">
            {{ blog ? 'Update' : 'Save' }}
        </PrimaryButton>
    </Form>
</template>
