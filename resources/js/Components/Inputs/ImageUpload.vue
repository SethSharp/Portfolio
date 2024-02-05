<script setup>
import {computed} from 'vue'
import SecondaryButton from "@/Components/Buttons/SecondaryButton.vue";
import InputError from '@/Components/Inputs/InputError.vue'

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
})

const emits = defineEmits(['update:modelValue'])

const inputVal = computed({
    get: () => props.modelValue,
    set: (value) => emits('update:modelValue', value),
})

const newImage = computed(() => (inputVal.value ? URL.createObjectURL(inputVal.value) : null))

const handleFileChange = (event) => {
    inputVal.value = event.target.files[0]
}

const fileUpload = () => {
    document.getElementById('file-upload').click()
}
</script>

<template>
    <div class="flex items-center space-x-2">
        <img :src="newImage ?? currentImage" class="h-24 w-24 rounded-xl"/>

        <input
            id="file-upload"
            ref="image"
            type="file"
            accept="image/gif, image/jpeg, image/png"
            @input="handleFileChange"
            hidden
        />

        <SecondaryButton type="button" @click="fileUpload"> Upload</SecondaryButton>
    </div>
    <InputError :message="error"/>
</template>
