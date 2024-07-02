<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import { PrimaryButton, TextInput, FormElement } from '@sethsharp/ui'
import GuestLayout from '@/Layouts/GuestLayout.vue'

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
})

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    })
}
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <form @submit.prevent="submit">
            <FormElement>
                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    label="Email"
                    :error="form.errors.email"
                    :show-character-count="false"
                />
            </FormElement>

            <FormElement>
                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    :error="form.errors.password"
                    label="Password"
                    :show-character-count="false"
                />
            </FormElement>

            <FormElement>
                <TextInput
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                    label="Confirm Password"
                    :error="form.errors.password_confirmation"
                    :show-character-count="false"
                />
            </FormElement>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reset Password
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
