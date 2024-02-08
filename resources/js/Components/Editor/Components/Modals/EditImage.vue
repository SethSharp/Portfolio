<script setup>
import Modal from '@/Components/Modal.vue'
import ImageUpload from '@/Components/Inputs/ImageUpload.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import { ref } from 'vue'
import { router, useForm } from '@inertiajs/vue3'
import axios from 'axios'

const props = defineProps({
    modelValue: {
        type: String,
        required: false,
    },
    open: Boolean,
})

const emits = defineEmits(['close', 'update:modelValue'])

const path = ''
const errors = ref({})

const form = useForm({
    file: null,
})

const submit = () => {
    const formData = new FormData()
    formData.append('file', form.file)

    axios
        .post(route('dashboard.blogs.image.store'), formData)
        .then((res) => handleSuccess(res))
        .catch((err) => console.log(err))
}

const handleSuccess = (res) => {
    emits('update:modelValue', res.data.path)
}

const handleError = (errs) => {
    for (const key in errs) {
        errors.value[key] = errs[key]
    }
}
</script>

<template>
    <Modal :open="open" @close="emits('close')">
        <ImageUpload v-model="form.file" :current-image="path" :error="errors['file']" />

        <PrimaryButton type="submit" @click.prevent="submit"> Submit</PrimaryButton>
    </Modal>
</template>
