<script setup>
import axios from 'axios'
import { ref, watch } from 'vue'
import { useVModels } from '@vueuse/core'
import { router, useForm } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import ImageUpload from '@/Components/Inputs/ImageUpload.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'

const props = defineProps({
    open: Boolean,
    modelValue: {
        type: [String, null],
    },
    fileId: {
        required: true,
    },
    alt: {
        required: true,
    },
    height: {
        required: true,
    },
})

const emits = defineEmits(['update:fileId', 'update:alt', 'update:height'])

const {
    fileId: computedFileId,
    alt: computedAlt,
    height: computedHeight,
    fit: computedFit,
} = useVModels(props, emits)

const path = ''
const errors = ref({})
const file = ref(null)

const storeImage = () => {
    const formData = new FormData()
    formData.append('file', file.value)
    formData.append('fileId', computedFileId.value)

    axios
        .post(route('dashboard.blogs.image.store'), formData)
        .then((res) => {
            handleSuccess(res)
        })
        .catch((err) => {
            console.log(err)
        })
}

const handleSuccess = (res) => {
    emits('update:modelValue', res.data.path)
    emits('update:fileId', res.data.fileId)
}

watch(file, (val) => {
    storeImage()
})
</script>

<template>
    <Modal :open="open" @close="emits('close')">
        <ImageUpload v-model="file" :current-image="path" :error="errors['file']" />

        <div>
            <label for="alt"> Alt</label>
            <TextInput v-model="computedAlt" />
        </div>

        <div>
            <label for="height"> Height</label>
            <input
                type="number"
                class="mt-2"
                step="1"
                min="0"
                max="999"
                required
                v-model="computedHeight"
            />
        </div>

        <PrimaryButton as="button" @click.prevent="emits('close')"> Save</PrimaryButton>
    </Modal>
</template>
