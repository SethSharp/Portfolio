<script>
export default {
    name: 'Grid',
}
</script>

<script setup>
import { NodeViewWrapper, nodeViewProps, NodeViewContent } from '@tiptap/vue-3'
import EditableNode from '../../Components/EditableNodeWrapper.vue'

// Tools

const props = defineProps({
    ...nodeViewProps,
})
</script>

<template>
    <NodeViewWrapper>
        <EditableNode v-bind="props">
            <template #tools> </template>
            <template #content>
                <node-view-content
                    :class="[
                        'grid divide-x divide-gray-100 w-full p-2',
                        'grid-cols-' + 2,
                        'md:grid-cols-' + 3,
                        'gap-' + 4,
                    ]"
                ></node-view-content>
            </template>
        </EditableNode>
    </NodeViewWrapper>
</template>
