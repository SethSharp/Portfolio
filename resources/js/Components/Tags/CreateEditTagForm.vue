<script setup>
import { useForm, router } from '@inertiajs/vue3'
import { Button, FormElement, Input, Form, Label, Error, Description } from '@sethsharp/lumuix'

const props = defineProps({
    tag: {
        type: Object,
        default: null,
    },
})

const emits = defineEmits(['close'])

const form = useForm({
    name: props.tag?.name ? props.tag.name : '',
})

const submit = () => {
    if (props.tag) {
        form.put(route('dashboard.tags.update', props.tag), {
            onSuccess: () => emits('close'),
        })
    } else {
        form.post(route('dashboard.tags.store'), {
            onSuccess: () => emits('close'),
        })
    }
}

const removeTag = () => {
    router.delete(route('dashboard.tags.destroy', props.tag), {
        onSuccess: () => emits('close'),
    })
}

const restoreTag = () => {
    router.put(
        route('dashboard.tags.restore'),
        {
            tag_id: props.tag,
        },
        {
            onSuccess: () => emits('close'),
        }
    )
}
</script>

<template>
    <Form>
        <FormElement>
            <Label id="name"> Name </Label>
            <Input v-model="form.name" autofocus :disabled="tag?.deleted_at" />
            <Error :error="form.errors.name" />
        </FormElement>

        <div class="gap-x-2 flex">
            <Button variant="destructive" v-if="tag && !tag?.deleted_at" @click.prevent="removeTag">
                Delete
            </Button>

            <Button variant="primary" v-if="tag?.deleted_at" @click.prevent="restoreTag">
                Restore
            </Button>

            <Button variant="primary" v-if="!tag?.deleted_at" @click.prevent="submit">
                {{ tag ? 'Save' : 'Create' }}
            </Button>
        </div>
    </Form>
</template>
