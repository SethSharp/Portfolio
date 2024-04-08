<script setup>
import { computed } from 'vue'
import { v4 as uuidv4 } from 'uuid'
import { getBlogCoverImage } from '@/Helpers/helpers.js'
import InputError from '@/Components/Inputs/InputError.vue'
import InputLabel from '@/Components/Inputs/InputLabel.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'

const props = defineProps({
    modelValue: {
        type: [String, null, File],
        required: true,
    },
    currentImage: {
        type: String,
        required: false,
    },
    error: [String, null],
    label: {
        type: String,
        default: '',
    },
})

const emits = defineEmits(['update:modelValue'])

const uniqueId = 'file-upload-' + uuidv4()
const newImage = computed(() => (inputVal.value ? URL.createObjectURL(inputVal.value) : null))
const curImg = props.currentImage ? props.currentImage : getBlogCoverImage(null)

const inputVal = computed({
    get: () => props.modelValue,
    set: (value) => emits('update:modelValue', value),
})

const handleFileChange = (event) => {
    inputVal.value = event.target.files[0]
}

const fileUpload = () => document.getElementById(uniqueId).click()
</script>

<template>
    <InputLabel :value="label" />

    <div class="flex items-center space-x-2">
        <img
            :src="newImage ?? curImg"
            class="max-w-lg max-h-40 sm:max-h-64 object-cover object-center"
        />

        <input
            :id="uniqueId"
            ref="image"
            type="file"
            accept="image/gif, image/jpeg, image/png"
            @input="handleFileChange"
            hidden
        />

        <SecondaryButton type="button" @click="fileUpload"> Upload</SecondaryButton>
    </div>

    <InputError :message="error" />
</template>
