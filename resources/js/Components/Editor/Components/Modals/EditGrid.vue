<script setup>
import { useVModels } from '@vueuse/core'
import Modal from '@/Components/Modal.vue'
import Form from '@/Components/Form/Form.vue'
import Select from '@/Components/Inputs/Select.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import FormElement from '@/Components/Form/FormElement.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'

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
        <Form>
            <FormElement>
                <TextInput id="columns" type="number" v-model="computedCols" label="Columns" />
            </FormElement>

            <FormElement>
                <TextInput
                    id="mobile-columns"
                    type="number"
                    v-model="computedMobile"
                    label="Mobile Columns"
                />
            </FormElement>

            <FormElement>
                <Select v-model="computedGap" :options="options" label="Gap" />
            </FormElement>
        </Form>

        <PrimaryButton @click.prevent="emits('close')"> Save</PrimaryButton>
    </Modal>
</template>
