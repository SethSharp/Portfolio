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

const manageCollection = (collection) => {
    currentCollection.value = collection
    open.value = true
}
</script>

<template>
    <AuthenticatedLayout title="Groups">
        <div class="flex justify-end">
            <PrimaryButton @click.prevent="manageCollection(null)">
                Create Collection</PrimaryButton
            >
        </div>

        <div
            v-if="allCollections.length > 0"
            class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6"
        >
            <div
                v-for="collection in allCollections"
                :key="collection.id"
                @click="manageCollection(collection)"
                class="rounded-2xl bg-white hover:bg-gray-50 shadow-md p-4"
            >
                {{ collection.title }}
            </div>
        </div>
        <div v-else class="flex justify-center align-middle">
            <div class="text-center">
                <h3 class="text-gray-400 text-md sm:text-xl">There are currently no collections</h3>

                <div class="mt-4">
                    <PrimaryButton @click="manageCollection(null)">
                        Create a Collection</PrimaryButton
                    >
                </div>
            </div>
        </div>

        <Modal :open="open" @close="open = false" size="xl">
            <CreateEditCollectionForm :collection="currentCollection" @close="open = false" />
        </Modal>
    </AuthenticatedLayout>
</template>
