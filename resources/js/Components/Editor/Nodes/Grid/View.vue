<script>
export default {
    name: 'Grid',
}
</script>

<script setup>
import { NodeViewWrapper, nodeViewProps, NodeViewContent } from '@tiptap/vue-3'
import EditableNode from '../../Components/EditableNodeWrapper.vue'
import breakdownNodeViewProps from '@/Helpers/breakdownNodeViewProps.js'
import EditGrid from '@/Components/Editor/Components/Modals/EditGrid.vue'
import EditImage from '@/Components/Editor/Components/Modals/EditImage.vue'
import { ref } from 'vue'

const props = defineProps({
    ...nodeViewProps,
})

const open = ref(false)

let { cols, gap, mobileColumns } = breakdownNodeViewProps(props)
</script>

<template>
    <NodeViewWrapper>
        <EditableNode v-bind="props">
            <template #tools>
                <button @click="open = true">Edit</button>

                <EditGrid
                    @close="open = false"
                    :open="open"
                    v-model:cols="cols"
                    v-model:gap="gap"
                    v-model:mobileColumns="mobileColumns"
                />

                {{ cols }}
            </template>

            <template #content>
                <NodeViewContent
                    :class="[
                        'grid divide-x divide-gray-100 w-full p-2',
                        'grid-cols-' + mobileColumns,
                        'md:grid-cols-' + cols,
                        'gap-' + gap,
                    ]"
                >
                </NodeViewContent>
            </template>
        </EditableNode>
    </NodeViewWrapper>
</template>
