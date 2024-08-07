<script setup>
import axios from 'axios'
import { ref, watch } from 'vue'
import { useVModels } from '@vueuse/core'
import { Modal, Text, FormElement, ImageUpload, PrimaryButton } from '@sethsharp/ui'
import { PencilSquareIcon } from '@heroicons/vue/16/solid/index.js'

const props = defineProps({
    open: Boolean,
    blogId: Number,
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
    formData.append('file_id', computedFileId.value)
    formData.append('blog_id', props.blogId)

    axios
        .post(route('dashboard.blogs.image.store'), formData)
        .then((res) => {
            handleSuccess(res)
        })
        .catch((err) => {
            console.log(err)
            alert('We failed to upload your file: ', err)
        })
}

const handleSuccess = (res) => {
    emits('update:modelValue', res.data.path)
    emits('update:fileId', res.data.fileId)
}

watch(file, (_) => {
    storeImage()
})
</script>

<template>
    <Modal :header-data="{ title: 'Manage Image' }" size="2xl">
        <template #trigger>
            <PencilSquareIcon class="size-4" />
        </template>
        <template #content>
            <div class="mb-4">
                <FormElement>
                    <ImageUpload
                        v-model="file"
                        :current-image="path"
                        label="Image Upload"
                        :error="errors['file']"
                    />
                </FormElement>

                <FormElement>
                    <Text id="alt" type="text" v-model="computedAlt" label="Alt" />
                </FormElement>

                <FormElement>
                    <Text id="height" v-model="computedHeight" type="number" label="Height" />
                </FormElement>
            </div>

            <PrimaryButton as="button" @click.prevent="emits('close')"> Save</PrimaryButton>
        </template>
    </Modal>
</template>
