<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { PrimaryButton, FormElement, TextInput } from '@sethsharp/ui'
import GuestLayout from '@/Layouts/GuestLayout.vue'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    })
}
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <FormElement>
                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    required
                    label="Name"
                    :error="form.errors.name"
                />
            </FormElement>

            <FormElement>
                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    label="Email"
                    :error="form.errors.email"
                />
            </FormElement>

            <FormElement>
                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    label="New Password"
                    :error="form.errors.password"
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
                />
            </FormElement>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    type="submit"
                >
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
