<script setup>
import axios from 'axios'
import { ref, watch } from 'vue'
import { useVModels } from '@vueuse/core'
import { useForm } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import ImageUpload from '@/Components/Inputs/ImageUpload.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'

const props = defineProps({
    open: Boolean,
    modelValue: {
        type: [String, null],
    },
    href: {
        required: true,
    },
    alt: {
        required: true,
    },
    height: {
        required: true,
    },
    fit: {
        required: true,
    },
    target: {
        required: true,
    },
})

const emits = defineEmits([
    'update:href',
    'update:alt',
    'update:height',
    'update:fit',
    'update:target',
])

const {
    href: computedHref,
    alt: computedAlt,
    height: computedHeight,
    fit: computedFit,
    target: computedTarget,
} = useVModels(props, emits)

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
    emits('close')
}

const handleError = (errs) => {
    for (const key in errs) {
        errors.value[key] = errs[key]
    }
}

const heightControl = ref(props.height === 'full' ? 'full' : 'custom')
const heightControlOptions = ['full', 'custom']

watch(
    () => heightControl.value,
    (value) => {
        if (value === 'full') {
            computedHeight.value = 'full'
        } else {
            computedHeight.value = 450
        }
    }
)
</script>

<template>
    <Modal :open="open" @close="emits('close')">
        <ImageUpload v-model="form.file" :current-image="path" :error="errors['file']" />

        <div>
            <label for="href">Link</label>
            <TextInput v-model="computedHref" description="Link to somewhere" />
        </div>

        <div>
            <label for="alt"> Alt</label>
            <TextInput v-model="computedAlt" />
        </div>

        <div>
            <label for="height"> Height</label>
            <div class="flex flex-col space-y-1">
                <label>
                    <input
                        class="mr-2"
                        type="radio"
                        name="heightControl"
                        v-model="heightControl"
                        value="full"
                    />
                    Full
                </label>

                <label>
                    <input
                        class="mr-2"
                        type="radio"
                        name="heightControl"
                        v-model="heightControl"
                        value="custom"
                    />
                    Custom
                </label>
            </div>

            <input
                v-if="heightControl === 'custom'"
                type="number"
                class="mt-2"
                step="1"
                min="0"
                max="999"
                required
                v-model="computedHeight"
            />
        </div>

        <div>
            <label for="fit"> Image fit</label>
            <select v-model="computedFit">
                <option value="none" selected>None</option>
                <option value="contain">Contain</option>
                <option value="cover">Cover</option>
                <option value="fill">Fill</option>
                <option value="scale-down">Scale down</option>
            </select>
        </div>

        <PrimaryButton type="submit" @click.prevent="submit"> Save</PrimaryButton>
    </Modal>
</template>
