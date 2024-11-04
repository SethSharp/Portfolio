<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Badge } from '@sethsharp/lumuix/badge'

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
})

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <Badge> This is a badge </Badge>

            <div class="flex items-center justify-end mt-4">
                <button
                    variant="primary"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
