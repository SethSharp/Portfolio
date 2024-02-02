<script setup>
import Form from "@/Components/Form/Form.vue";
import TextInput from "@/Components/Inputs/TextInput.vue";
import FormElement from "@/Components/Form/FormElement.vue";
import Checkbox from "@/Components/Inputs/Checkbox.vue";
import TextArea from "@/Components/Inputs/TextArea.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import InputError from "@/Components/Inputs/InputError.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    blog: {
        type: Object,
        default: {},
    },
});

const form = useForm({
    title: props.blog?.title ? props.blog.title : "",
    slug: props.blog?.slug ? props.blog.slug : "",
    meta_title: props.blog?.meta_title ? props.blog.meta_title : "",
    meta_description: props.blog?.meta_description
        ? props.blog.meta_description
        : "",
    meta_tags: props.blog?.meta_tags ? props.blog.meta_tags : "",
    content: props.blog?.content ? props.blog.content : "",
    is_draft: props.blog?.is_draft ? props.blog.is_draft : false,
});

const submit = () => {
    if (props.blog) {
        form.put(route("dashboard.blogs.update", props.blog));
    } else {
        form.post(route("dashboard.blogs.store"));
    }
};
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
            <TextInput v-model="form.meta_title" label="Meta Title" />
            <InputError :message="form.errors.meta_title" />
        </FormElement>

        <FormElement>
            <TextInput
                v-model="form.meta_description"
                label="Meta Description"
            />
            <InputError :message="form.errors.meta_description" />
        </FormElement>

        <FormElement>
            <TextInput v-model="form.meta_tags" label="Meta Tags" />
            <InputError :message="form.errors.meta_tags" />
        </FormElement>

        <FormElement>
            <TextArea v-model="form.content" label="Content" />
            <InputError :message="form.errors.content" />
        </FormElement>

        <FormElement>
            <Checkbox
                v-model="form.is_draft"
                :checked="form.is_draft"
                label="Is Draft"
            />
            <InputError :message="form.errors.is_draft" />
        </FormElement>

        <PrimaryButton as="submit" @click.prevent="submit">
            Publish
        </PrimaryButton>
    </Form>
</template>
