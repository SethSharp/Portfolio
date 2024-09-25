<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import { Button, Text, FormElement, Checkbox, Label, Error } from '@sethsharp/lumuix'
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
                <Label> Email </Label>
                <Text
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />
                <Error :message="form.errors.email" />
            </FormElement>

            <FormElement>
                <Label> Password</Label>
                <Text type="password" v-model="form.password" required autocomplete="password" />
                <Error :message="form.errors.password" />
            </FormElement>

            <FormElement>
                <Checkbox label="Remember Me" v-model="form.remember" :show-label="false" />
            </FormElement>

            <div class="flex items-center justify-end mt-4">
                <Button
                    variant="primary"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </Button>
            </div>
        </form>
    </GuestLayout>
</template>
