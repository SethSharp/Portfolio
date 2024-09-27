<script setup>
import { computed, ref } from 'vue'
import { Datatable, Modal, Button } from '@sethsharp/lumuix'
import { formatDate } from '@/Helpers/helpers.js'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditCollectionForm from '@/Components/Collection/CreateEditCollectionForm.vue'

const props = defineProps({
    allCollections: Array,
})

const open = ref(false)
const currentCollection = ref(null)

const manageCollection = (collection) => {
    currentCollection.value = collection
    open.value = true
}

const dataTableConfig = computed(() => ({
    headers: [
        {
            value: 'title',
            name: 'Title',
        },
        {
            value: 'description',
            name: 'Description',
        },
        {
            value: 'created_at',
            name: 'Created At',
        },
    ],
    rows: props.allCollections,
}))
</script>

<template>
    <AuthenticatedLayout title="Groups">
        <div class="flex justify-end">
            <Button variant="primary" @click.prevent="manageCollection(null)">
                Create Collection
            </Button>
        </div>

        <Datatable v-if="allCollections.length" v-bind="dataTableConfig">
            <template #cell_created_at="{ item }">
                {{ formatDate(item.created_at) }}
            </template>

            <template #row_actions="{ item }">
                <Button variant="secondary" @click="manageCollection(item)"> Edit </Button>
            </template>
        </Datatable>

        <div v-else class="flex justify-center align-middle">
            <div class="text-center">
                <h3 class="text-gray-400 text-md sm:text-xl">There are currently no collections</h3>

                <div class="mt-4">
                    <Buttonv variant="primary" @click="manageCollection(null)">
                        Create a Collection
                    </Buttonv>
                </div>
            </div>
        </div>

        <Modal :open="open" @close="open = false" size="xl">
            <template #header> Manage Collection</template>
            <CreateEditCollectionForm :collection="currentCollection" @close="open = false" />
        </Modal>
    </AuthenticatedLayout>
</template>
