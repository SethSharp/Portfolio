<script setup>
import { useForm, router } from '@inertiajs/vue3'
import Form from '@/Components/Form/Form.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import FormElement from '@/Components/Form/FormElement.vue'
import InputError from '@/Components/Inputs/InputError.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import DangerButton from '@/Components/Buttons/DangerButton.vue'

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
            <TextInput v-model="form.name" autofocus label="Name" />
            <InputError :message="form.errors.name" />
        </FormElement>

        <div class="gap-x-2 flex">
            <DangerButton v-if="tag && !tag?.deleted_at" @click.prevent="removeTag">
                Delete
            </DangerButton>

            <PrimaryButton v-if="tag?.deleted_at" @click.prevent="restoreTag">
                Restore
            </PrimaryButton>

            <PrimaryButton v-if="!tag?.deleted_at" @click.prevent="submit"> Save</PrimaryButton>
        </div>
    </Form>
</template>
