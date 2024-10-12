<script setup>
import { watch } from 'vue'
import { Toaster, useToast } from '@sethsharp/lumuix'
import {
    BellAlertIcon,
    CheckCircleIcon,
    InformationCircleIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline/index.js'

const props = defineProps({
    success: String | null,
    warning: String | null,
    info: String | null,
    errors: Object,
})

const { toast } = useToast()

watch(
    () => props.errors,
    (newVal) => {
        if (newVal && Object.keys(newVal).length) {
            let errorDescription = ''

            Object.keys(props.errors).forEach((key) => {
                errorDescription += props.errors[key] + '\n'
            })

            toast({
                title: 'Error!',
                description: errorDescription,
                icon: XMarkIcon,
                iconClasses: 'text-red-500 !size-10',
            })
        }
    },
    {
        immediate: true,
    }
)

watch(
    () => props.success,
    () => {
        if (props.success) {
            toast({
                title: 'Success!',
                description: props.success,
                icon: CheckCircleIcon,
                iconClasses: 'text-green-500 size-8',
            })
        }
    },
    {
        immediate: true,
    }
)

watch(
    () => props.warning,
    () => {
        if (props.warning) {
            toast({
                title: 'Warning!',
                description: props.warning,
                icon: BellAlertIcon,
                iconClasses: 'text-orange-500 size-8',
            })
        }
    },
    {
        immediate: true,
    }
)

watch(
    () => props.info,
    () => {
        if (props.info) {
            toast({
                title: 'Info!',
                description: props.info,
                icon: InformationCircleIcon,
                iconClasses: 'text-blue-500 size-8',
            })
        }
    },
    {
        immediate: true,
    }
)
</script>

<template>
    <Toaster />
</template>
