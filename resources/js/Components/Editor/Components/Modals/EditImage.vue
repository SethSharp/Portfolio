<script setup>
import axios from 'axios'
import { ref, watch } from 'vue'
import { useVModels } from '@vueuse/core'
import { PencilSquareIcon } from '@heroicons/vue/16/solid/index.js'
import {
    LumuixModal,
    Input,
    FormElement,
    ImageUpload,
    Button,
    Label,
    Error,
} from '@sethsharp/lumuix'

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
    <LumuixModal :header-data="{ title: 'Manage Image' }" size="2xl">
        <template #trigger>
            <PencilSquareIcon class="size-4" />
        </template>
        <template #content>
            <div class="mb-4">
                <FormElement>
                    <Label id="image_upload"> Image Upload</Label>
                    <ImageUpload v-model="file" :current-image="path" />
                    <Error :message="errors['file']" />
                </FormElement>

                <FormElement>
                    <Label id="alt">Alt</Label>
                    <Input id="alt" type="text" v-model="computedAlt" />
                </FormElement>

                <FormElement>
                    <Label id="height"> Height </Label>
                    <Input id="height" v-model="computedHeight" type="number" />
                </FormElement>
            </div>

            <Button variant="primary" @click.prevent="emits('close')"> Save</Button>
        </template>
    </LumuixModal>
</template>
