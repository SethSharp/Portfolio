<script setup>
import { computed, ref } from 'vue'
import { Modal, Button, Datatable } from '@sethsharp/lumuix'
import { formatDate } from '@/Helpers/helpers.js'
import IndexTagsLayout from '@/Layouts/IndexTagsLayout.vue'
import CreateEditTagForm from '@/Components/Tags/CreateEditTagForm.vue'

const props = defineProps({
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

const dataTableConfig = computed(() => ({
    headers: [
        {
            value: 'name',
            name: 'Name',
        },
        {
            value: 'created_at',
            name: 'Created At',
        },
    ],
    rows: props.tags.data,
}))
</script>

<template>
    <IndexTagsLayout :status="currentStatus" :tabs="tabs" :count="tags.data.length" :data="tags">
        <template #header>
            <div class="rounded py-2 text-3xl text-black dark:text-gray-300">
                {{ currentStatus }} Tags ({{ tags.data.length }})
            </div>
            <div class="flex ml-auto">
                <Button variant="primary" @click.prevent="openModal(null)"> Create Tag</Button>
            </div>
        </template>

        <Datatable v-if="tags.data.length" v-bind="dataTableConfig">
            <template #cell_name="{ item }">
                {{ item.name }}
            </template>

            <template #cell_created_at="{ item }">
                {{ formatDate(item.created_at) }}
            </template>

            <template #row_actions="{ item }">
                <Button variant="secondary" @click="openModal(item)"> Edit </Button>
            </template>
        </Datatable>

        <div v-else class="flex justify-center align-middle w-full">
            <div class="text-center">
                <h3 class="text-gray-400 text-md sm:text-xl">
                    There are currently no tags in the {{ currentStatus }} state.
                </h3>

                <div v-if="currentStatus === 'Active'" class="mt-4">
                    <Button variant="primary" @click.prevent="openModal(null)"> Create Tag</Button>
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
