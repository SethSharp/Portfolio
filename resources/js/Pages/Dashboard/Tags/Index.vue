<script setup>
import { ref } from 'vue'
import { Modal, PrimaryButton } from '@sethsharp/ui'
import IndexTagsLayout from '@/Layouts/IndexTagsLayout.vue'
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
            <div class="rounded py-2 text-3xl text-black dark:text-gray-300">
                {{ currentStatus }} Tags ({{ tags.data.length }})
            </div>
            <div class="flex ml-auto">
                <PrimaryButton @click.prevent="openModal(null)"> Create Tag</PrimaryButton>
            </div>
        </template>

        <div
            v-if="tags.data.length > 0"
            class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6"
        >
            <div
                v-for="tag in tags.data"
                :key="tag.id"
                @click="openModal(tag)"
                class="rounded-2xl bg-white hover:bg-gray-50 shadow-md p-4 dark:bg-gray-600 dark:hover:bg-gray-800 transition dark:text-white"
            >
                {{ tag.name }}
            </div>
        </div>

        <div v-else class="flex justify-center align-middle">
            <div class="text-center">
                <h3 class="text-gray-400 text-md sm:text-xl">
                    There are currently no tags in the {{ currentStatus }} state.
                </h3>

                <div v-if="currentStatus === 'Active'" class="mt-4">
                    <PrimaryButton @click.prevent="openModal(null)"> Create Tag</PrimaryButton>
                </div>
            </div>
        </div>

        <Modal
            :open="open"
            @close="open = false"
            size="sm"
            :headerData="{ title: 'Manage Tag', description: 'some desc' }"
        >
            <CreateEditTagForm :tag="currentTag" @close="open = false" />
        </Modal>
    </IndexTagsLayout>
</template>
