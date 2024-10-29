<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import { Button, Input, FormElement, Label, Error } from '@sethsharp/lumuix'
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
                <Label> Email </Label>
                <Input id="email" type="email" v-model="form.email" required />
                <Error :error="form.errors.email" />
            </FormElement>

            <FormElement>
                <Label> Password </Label>
                <Input id="password" type="password" v-model="form.password" required />
                <Error :error="form.errors.password" />
            </FormElement>

            <FormElement>
                <Label> Confirm Password </Label>
                <Input
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                />
                <Error :error="form.errors.password_confirmation" />
            </FormElement>

            <div class="flex items-center justify-end mt-4">
                <Button
                    variant="primary"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reset Password
                </Button>
            </div>
        </form>
    </GuestLayout>
</template>
