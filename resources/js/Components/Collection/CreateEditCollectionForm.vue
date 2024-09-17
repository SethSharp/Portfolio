<script setup>
import { useForm, router } from '@inertiajs/vue3'
import { ArrowLongUpIcon, ArrowLongDownIcon } from '@heroicons/vue/16/solid/index.js'
import { Form, TextArea, Text, FormElement, DangerButton, PrimaryButton } from '@sethsharp/lumuix'

const props = defineProps({
    collection: {
        type: Object,
        default: null,
    },
})

const emits = defineEmits(['close'])

const form = useForm({
    title: props.collection?.title ? props.collection.title : '',
    description: props.collection?.description ? props.collection.description : '',
    blogs: props.collection?.blogs ? props.collection.blogs : [],
})

const submit = () => {
    if (props.collection) {
        form.put(route('dashboard.collection.update', props.collection), {
            onSuccess: () => emits('close'),
        })
    } else {
        form.post(route('dashboard.collection.store'), {
            onSuccess: () => emits('close'),
        })
    }
}

const destroyCollection = () => {
    router.delete(route('dashboard.collection.destroy', props.collection), {
        onBefore: () => confirm('Are you sure you want to permanently delete this collection?'),
        onSuccess: () => emits('close'),
    })
}

const shiftBlog = (from, to) => {
    form.blogs.splice(to, 0, form.blogs.splice(from, 1)[0])
}
</script>

<template>
    <Form>
        <FormElement>
            <Text
                autofocus
                v-model="form.title"
                label="Title"
                :error="form.errors.title"
                description="Something that will catch the users attention"
            />
        </FormElement>

        <FormElement>
            <TextArea
                v-model="form.description"
                label="Description"
                :error="form.errors.description"
                description="Rough overview of the collection to help users understand what is included."
            />
        </FormElement>

        <FormElement>
            <div class="h-56 overflow-y-scroll">
                <div
                    v-for="(blog, key) in form.blogs"
                    :key="key"
                    class="bg-gray-100 p-2 rounded-lg my-2 flex transition"
                >
                    <div>
                        {{ blog.title }}

                        <span class="text-black text-xs font-medium">
                            {{ blog.published_at_for_humans ?? 'draft' }}
                        </span>
                    </div>
                    <div class="flex ml-auto my-auto">
                        <ArrowLongDownIcon
                            v-if="key !== collection.blogs.length - 1"
                            class="size-5 hover:text-slate-500 transition"
                            @click="shiftBlog(key, key + 1)"
                        />
                        <ArrowLongUpIcon
                            v-if="key !== 0"
                            class="size-5 hover:text-slate-500 transition"
                            @click="shiftBlog(key, key - 1)"
                        />
                    </div>
                </div>
            </div>
        </FormElement>

        <div class="flex gap-4">
            <DangerButton v-if="collection" @click.prevent="destroyCollection">
                Delete
            </DangerButton>
            <PrimaryButton @click.prevent="submit">
                {{ collection ? 'Update' : 'Create' }}
            </PrimaryButton>
        </div>
    </Form>
</template>
