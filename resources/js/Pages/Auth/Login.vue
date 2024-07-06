<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { PrimaryButton, TextInput, FormElement, Checkbox } from '@sethsharp/ui'
import GuestLayout from '@/Layouts/GuestLayout.vue'

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
            <FormElement>
                <TextInput
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    label="Email"
                    :error="form.errors.email"
                />
            </FormElement>

            <FormElement>
                <TextInput
                    type="password"
                    v-model="form.password"
                    required
                    label="Password"
                    autocomplete="password"
                    :error="form.errors.password"
                />
            </FormElement>

            <FormElement>
                <Checkbox label="Remember Me" v-model="form.remember" :show-label="false" />
            </FormElement>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
