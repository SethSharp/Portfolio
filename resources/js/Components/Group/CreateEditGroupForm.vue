<script setup>
import { useForm, router } from '@inertiajs/vue3'
import Form from '@/Components/Form/Form.vue'
import TextArea from '@/Components/Inputs/TextArea.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import FormElement from '@/Components/Form/FormElement.vue'
import InputError from '@/Components/Inputs/InputError.vue'
import DangerButton from '@/Components/Buttons/DangerButton.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import { ArrowLongUpIcon, ArrowLongDownIcon } from '@heroicons/vue/16/solid/index.js'

const props = defineProps({
    group: {
        type: Object,
        default: null,
    },
})

const emits = defineEmits(['close'])

const form = useForm({
    title: props.group?.title ? props.group.title : '',
    description: props.group?.description ? props.group.description : '',
    blogs: props.group?.blogs ? props.group.blogs : [],
})

const submit = () => {
    if (props.group) {
        form.put(route('dashboard.group.update', props.group), {
            onSuccess: () => emits('close'),
        })
    } else {
        form.post(route('dashboard.group.store'), {
            onSuccess: () => emits('close'),
        })
    }
}

const destroyGroup = () => {
    router.delete(route('dashboard.group.destroy', props.group), {
        onBefore: () => confirm('Are you sure you want to permanently delete this group?'),
        onSuccess: () => emits('close'),
    })
}

const shiftBlog = (from, to) => {
    props.group.blogs.splice(to, 0, props.group.blogs.splice(from, 1)[0])
}
</script>

<template>
    <Form>
        <FormElement>
            <TextInput v-model="form.title" autofocus label="Title" />
            <InputError :message="form.errors.title" />
        </FormElement>

        <FormElement>
            <TextArea v-model="form.description" label="Description" />
            <InputError :message="form.errors.description" />
        </FormElement>

        <FormElement>
            <div class="h-56 overflow-y-scroll">
                <div
                    v-for="(blog, key) in group.blogs"
                    :key="key"
                    class="bg-gray-100 p-2 rounded-lg my-2 flex transition"
                >
                    <div>
                        <div>
                            {{ blog.title }}
                        </div>

                        <span class="text-black font-medium"> delete </span>
                    </div>
                    <div class="flex ml-auto my-auto">
                        <ArrowLongDownIcon
                            v-if="key !== group.blogs.length - 1"
                            class="size-5 hover:text-gray-500 transition"
                            @click="shiftBlog(key, key + 1)"
                        />
                        <ArrowLongUpIcon
                            v-if="key !== 0"
                            class="size-5 hover:text-gray-500 transition"
                            @click="shiftBlog(key, key - 1)"
                        />
                    </div>
                </div>
            </div>
        </FormElement>

        <div class="gap-x-2 flex">
            <DangerButton @click.prevent="destroyGroup"> Delete</DangerButton>

            <PrimaryButton @click.prevent="submit"> Save</PrimaryButton>
        </div>
    </Form>
</template>
