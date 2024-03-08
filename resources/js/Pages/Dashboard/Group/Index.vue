<script setup>
import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditGroupForm from '@/Components/Group/CreateEditGroupForm.vue'

defineProps({
    allGroups: Array,
})

const open = ref(false)
const currentGroup = ref(null)

const openModal = (group) => {
    currentGroup.value = group
    open.value = true
}
</script>

<template>
    <AuthenticatedLayout title="Groups">
        <div class="flex justify-end">
            <PrimaryButton @click.prevent="openModal()"> Create Group</PrimaryButton>
        </div>

        <div class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6">
            <div
                v-for="group in allGroups"
                :key="group.id"
                @click="openModal(group)"
                class="rounded-2xl bg-white hover:bg-gray-50 shadow-md p-4"
            >
                {{ group.title }}
            </div>
        </div>

        <Modal :open="open" @close="open = false" size="xl">
            <CreateEditGroupForm :group="currentGroup" @close="open = false" />
        </Modal>
    </AuthenticatedLayout>
</template>
