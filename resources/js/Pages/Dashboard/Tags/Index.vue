<script setup>
import {ref} from 'vue'
import Modal from '@/Components/Modal.vue'
import IndexTagsLayout from '@/Layouts/IndexTagsLayout.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import CreateEditTagForm from '@/Components/Tags/CreateEditTagForm.vue'

defineProps({
    tags: Object,
    currentStatus: String,
    tabs: Object,
})

const open = ref(false)
const currentTag = ref(null)

const openModal = (tag = null) => {
    currentTag.value = tag
    open.value = true
}
</script>

<template>
    <IndexTagsLayout :status="currentStatus" :tabs="tabs" :count="tags.data.length" :data="tags">
        <template #header>
            <h1 class="text-lg sm:text-xl md:text-2xl font-medium">
                {{ currentStatus }} Tags ({{ tags.data.length }})
            </h1>
            <div class="flex ml-auto">
                <PrimaryButton @click.prevent="openModal(null)"> Create Tag</PrimaryButton>
            </div>
        </template>

        <div v-if="tags.data.length > 0" class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6">
            <div
                v-for="tag in tags.data"
                :key="tag.id"
                @click="openModal(tag)"
                class="rounded-2xl bg-white hover:bg-gray-50 shadow-md p-4"
            >
                {{ tag.name }}
            </div>
        </div>

        <div v-else class="flex justify-center align-middle">
            <div class="text-center">
                <h3 class="text-gray-400 text-md sm:text-xl">
                    There are currently no blogs in the {{ currentStatus }} state.
                </h3>

                <div v-if="currentStatus === 'Active'" class="mt-4">
                    <PrimaryButton @click.prevent="openModal"> Create Tag</PrimaryButton>
                </div>
            </div>
        </div>

        <Modal :open="open" @close="open = false" size="sm">
            <CreateEditTagForm :tag="currentTag" @close="open = false"/>
        </Modal>
    </IndexTagsLayout>
</template>
