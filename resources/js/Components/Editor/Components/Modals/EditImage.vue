<script setup>
import Modal from '@/Components/Modal.vue'
import ImageUpload from '@/Components/Inputs/ImageUpload.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    modelValue: String,
    open: Boolean,
})

const emits = defineEmits(['close'])

const path = ''
const errors = ref({})

const form = useForm({
    file: null,
})

const submit = () => {
    form.post(route('dashboard.files.store'), {
        onError: (errors) => handleError(errors),
        onSuccess: () => handleSuccess(),
    })
}

const handleSuccess = () => {
    emits('close')
}

const handleError = (errs) => {
    for (const key in errs) {
        errors.value[key] = errs[key]
    }
}
</script>

<template>
    <Modal :open="open">
        <ImageUpload v-model="form.file" :current-image="path" :error="errors['file']" />

        <PrimaryButton type="submit" @click.prevent="submit"> Submit</PrimaryButton>
    </Modal>
</template>
