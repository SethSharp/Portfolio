<script setup>
import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditCollectionForm from '@/Components/Collection/CreateEditCollectionForm.vue'

defineProps({
    allCollections: Array,
})

const open = ref(false)
const currentCollection = ref(null)

const openModal = (collection) => {
    currentCollection.value = collection
    open.value = true
}
</script>

<template>
    <AuthenticatedLayout title="Groups">
        <div class="flex justify-end">
            <PrimaryButton @click.prevent="openModal()"> Create Collection</PrimaryButton>
        </div>

        <div class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6">
            <div
                v-for="collection in allCollections"
                :key="collection.id"
                @click="openModal(collection)"
                class="rounded-2xl bg-white hover:bg-gray-50 shadow-md p-4"
            >
                {{ collection.title }}
            </div>
        </div>

        <Modal :open="open" @close="open = false" size="xl">
            <CreateEditCollectionForm :collection="currentCollection" @close="open = false" />
        </Modal>
    </AuthenticatedLayout>
</template>
