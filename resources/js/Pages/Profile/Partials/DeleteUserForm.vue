<script setup>
import { nextTick, ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import { TextInput, FormElement, SecondaryButton, Modal, DangerButton } from '@sethsharp/ui'

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

        <DangerButton @click="confirmUserDeletion">Delete Account</DangerButton>

        <Modal :open="confirmingUserDeletion" @close="closeModal" size="lg">
            <template #header> Are you sure you want to delete your account?</template>
            <template #content>
                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently
                    deleted. Please enter your password to confirm you would like to permanently
                    delete your account.
                </p>

                <FormElement>
                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                        label="Password"
                        :error="form.errors.password"
                        :show-character-count="false"
                    />
                </FormElement>

                <div class="mt-6 flex gap-2 justify-end">
                    <SecondaryButton @click="closeModal"> Cancel</SecondaryButton>

                    <DangerButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Delete Account
                    </DangerButton>
                </div>
            </template>
        </Modal>
    </section>
</template>
