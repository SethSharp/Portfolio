<script setup>
import axios from 'axios'
import { ref, watch } from 'vue'
import { useVModels } from '@vueuse/core'
import { useForm } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import ImageUpload from '@/Components/Inputs/ImageUpload.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import InputLabel from '@/Components/Inputs/InputLabel.vue'
import Select from '@/Components/Inputs/Select.vue'

const props = defineProps({
    open: Boolean,
    cols: {
        type: Number,
        required: true,
    },
    gap: {
        required: true,
    },
    mobileColumns: {
        required: true,
    },
})

const emits = defineEmits(['update:cols', 'update:gap', 'update:mobileColumns'])

const {
    cols: computedCols,
    gap: computedGap,
    mobileColumns: computedMobile,
} = useVModels(props, emits)

const options = [
    {
        value: '0',
        label: 'None',
    },
    {
        value: '1',
        label: '1',
    },
    {
        value: '2',
        label: '2',
    },
    {
        value: '4',
        label: '4',
    },
    {
        value: '6',
        label: '6',
    },
]
</script>

<template>
    <Modal :open="open" @close="emits('close')">
        <div class="mb-4">
            <div>
                <InputLabel> Cols</InputLabel>
                <TextInput type="number" v-model="computedCols" />
            </div>

            <div>
                <InputLabel> Mobile Columns</InputLabel>
                <TextInput type="number" v-model="computedMobile" />
            </div>

            <div>
                <InputLabel> Gap</InputLabel>

                <Select v-model="computedGap" :options="options" />
            </div>
        </div>

        <PrimaryButton @click.prevent="emits('close')"> Save</PrimaryButton>
    </Modal>
</template>
