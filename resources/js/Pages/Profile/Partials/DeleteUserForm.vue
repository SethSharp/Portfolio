<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { Input, FormElement, LumuixModal, Button } from '@sethsharp/lumuix'

const confirmingUserDeletion = ref(false)
const passwordInput = ref(null)

const form = useForm({
    password: '',
})

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true
}

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onFinish: () => form.reset(),
    })
}

const closeModal = () => {
    confirmingUserDeletion.value = false

    form.reset()
}
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Account</h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently
                deleted. Before deleting your account, please download any data or information that
                you wish to retain.
            </p>
        </header>

        <Button variant="destructive" @click="confirmUserDeletion">Delete Account</Button>

        <LumuixModal :open="confirmingUserDeletion" @close="closeModal" size="lg">
            <template #header> Are you sure you want to delete your account?</template>
            <template #content>
                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently
                    deleted. Please enter your password to confirm you would like to permanently
                    delete your account.
                </p>

                <FormElement>
                    <Input
                        id="password"
                        label="Password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                        :error="form.errors.password"
                    />
                </FormElement>

                <div class="mt-6 flex gap-2 justify-end">
                    <Button variant="secondary" @click="closeModal"> Cancel</Button>

                    <Button
                        variant="destructive"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </Button>
                </div>
            </template>
        </LumuixModal>
    </section>
</template>
