<script setup>
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

const form = useForm({
    title: props.series?.title ? props.series.title : '',
    description: props.series?.description ? props.series.description : '',
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

        <div class="gap-x-2 flex">
            <DangerButton @click.prevent="destroySeries"> Delete</DangerButton>

            <PrimaryButton @click.prevent="submit"> Save</PrimaryButton>
        </div>
    </Form>
</template>
