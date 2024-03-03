<script setup>
import { ref } from 'vue'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateEditSeriesForm from '@/Components/Series/CreateEditSeriesForm.vue'

defineProps({
    allSeries: Array,
})

const open = ref(false)
const currentSeries = ref(null)

const openModal = (series) => {
    currentSeries.value = series
    open.value = true
}
</script>

<template>
    <AuthenticatedLayout title="Series">
        <div class="flex justify-end">
            <PrimaryButton @click.prevent="openModal()"> Create Series</PrimaryButton>
        </div>

        <div class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-y-4 gap-x-4 mt-6">
            <div
                v-for="series in allSeries"
                :key="series.id"
                @click="openModal(series)"
                class="rounded-2xl bg-white hover:bg-gray-50 shadow-md p-4"
            >
                {{ series.title }}
            </div>
        </div>

        <Modal :open="open" @close="open = false">
            <CreateEditSeriesForm :series="currentSeries" @close="open = false" />
        </Modal>
    </AuthenticatedLayout>
</template>
