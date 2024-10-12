<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Input, FormElement, Button, Label, Error } from '@sethsharp/lumuix'

const passwordInput = ref(null)
const currentPasswordInput = ref(null)

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
})

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation')
            }

            if (form.errors.current_password) {
                form.reset('current_password')
            }
        },
        onFinish: () => form.reset(),
    })
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update Password</h2>

            <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <FormElement>
                <Input
                    id="current_password"
                    label="Current Password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    class="mt-1"
                    autocomplete="current-password"
                    :error="form.errors.current_password"
                />
            </FormElement>

            <FormElement>
                <Input
                    id="password"
                    label="Password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1"
                    autocomplete="new-password"
                    :error="form.errors.password"
                />
            </FormElement>

            <FormElement>
                <Input
                    id="password_confirmation"
                    label="Password Confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    class="mt-1"
                    autocomplete="new-password"
                    :error="form.errors.password_confirmation"
                />
            </FormElement>

            <div class="flex items-center gap-4">
                <Button variant="primary" :disabled="form.processing">Save</Button>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-slate-600 dark:text-slate-300"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
