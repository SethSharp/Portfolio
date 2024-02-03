<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditTagForm from '@/Components/Tags/CreateEditTagForm.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'

defineProps({
    tags: Array,
})

const open = ref(false)
const currentTag = ref(null)

const openModal = (tag) => {
    currentTag.value = tag
    open.value = true
}
</script>

<template>
    <AuthenticatedLayout title="Tags">
        <div class="flex justify-end">
            <PrimaryButton @click.prevent="open = true"> Create Tag </PrimaryButton>
        </div>

        <div class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6">
            <div
                v-for="tag in tags"
                :key="tag.id"
                @click="openModal(tag)"
                class="rounded-2xl bg-white hover:bg-gray-50 shadow-md p-4"
            >
                {{ tag.name }}
            </div>
        </div>

        <Modal :open="open" @close="open = false">
            <CreateEditTagForm :tag="currentTag" @close="open = false" />
        </Modal>
    </AuthenticatedLayout>
</template>
