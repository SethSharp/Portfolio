<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { SecondaryButton } from '@sethsharp/ui'
import ProfileLayout from '@/Layouts/ProfileLayout.vue'
import DeleteUserForm from './Partials/DeleteUserForm.vue'
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue'

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
})
</script>

<template>
    <Head title="Profile" />

    <ProfileLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>

                <SecondaryButton
                    :href="route('logout')"
                    method="post"
                    :as="Link"
                    class="bg-gray-200 hover:bg-gray-300 border-gray-400 border-1 p-2 rounded font-medium"
                >
                    Log Out
                </SecondaryButton>
            </div>
        </div>
    </ProfileLayout>
</template>
