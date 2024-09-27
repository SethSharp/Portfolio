<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { Input, FormElement, Button, Label, Error } from '@sethsharp/lumuix'

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
})

const user = usePage().props.auth.user

const form = useForm({
    name: user.name,
    email: user.email,
})
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-slate-600">
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <FormElement>
                <Label id="name"> Name </Label>
                <Input id="name" type="text" v-model="form.name" required autocomplete="name" />
                <Error :message="form.errors.name" />
            </FormElement>

            <FormElement>
                <Label id="email"> Email</Label>
                <Input
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                    label="Email"
                    :error="form.errors.email"
                />
                <Error :message="form.errors.name" />
            </FormElement>

            <div class="flex items-center gap-4">
                <Button variant="primary" :disabled="form.processing">Save</Button>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-slate-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
