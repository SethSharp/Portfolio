<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import { Button, FormElement, Input, Label, Error } from '@sethsharp/lumuix'
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
                <Label> Name </Label>
                <Input id="name" type="text" v-model="form.name" required />
                <Error :error="form.errors.name" />
            </FormElement>

            <FormElement>
                <Label> Email </Label>
                <Input id="email" type="email" v-model="form.email" required />
                <Error :error="form.errors.email" />
            </FormElement>

            <FormElement>
                <Label> Password</Label>
                <Input id="password" type="password" v-model="form.password" required />
                <Error :error="form.errors.password" />
            </FormElement>

            <FormElement>
                <Label> Confirm Password</Label>
                <Input
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                />
                <Error :error="form.errors.password_confirmation" />
            </FormElement>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <Button
                    variant="primary"
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    type="submit"
                >
                    Register
                </Button>
            </div>
        </form>
    </GuestLayout>
</template>
