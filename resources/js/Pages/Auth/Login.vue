<script setup>
import Checkbox from '@/Components/Inputs/Checkbox.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/Inputs/InputError.vue'
import InputLabel from '@/Components/Inputs/InputLabel.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import TextInput from '@/Components/Inputs/TextInput.vue'
import {Head, Link, useForm} from '@inertiajs/vue3'
import FormElement from '@/Components/Form/FormElement.vue'

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
        <Head title="Log in"/>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <FormElement>
                <TextInput
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    label="Email"
                    :error="form.errors.email"
                    :show-character-count="false"
                />
            </FormElement>

            <FormElement>
                <TextInput
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    label="Password"
                    :error="form.errors.password"
                    :show-character-count="false"
                />
            </FormElement>

            <FormElement>
                <Checkbox label="Remember Me" v-model="form.remember"/>
            </FormElement>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

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
