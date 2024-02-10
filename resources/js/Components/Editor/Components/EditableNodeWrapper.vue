<script setup>
import { computed } from 'vue'
import { nodeViewProps } from '@tiptap/vue-3'
import { ArrowsPointingOutIcon, TrashIcon } from '@heroicons/vue/24/solid'

const props = defineProps({
    ...nodeViewProps,
})

const editable = computed(() => {
    return props.editor.options.hasOwnProperty('editable') ? props.editor.options.editable : true
})
</script>

<template>
    <div v-if="editable" :draggable="node.type.spec.draggable">
        <div class="flex">
            <div
                class="flex items-center w-content -top-7 bg-gray-50 shadow rounded overflow-hidden"
            >
                <div v-if="node.type.spec.draggable" class="cursor-move p-1" data-drag-handle>
                    <ArrowsPointingOutIcon class="w-4 h-4 text-gray-800" />
                </div>

                <button class="p-1" type="button" @click.prevent="deleteNode">
                    <TrashIcon class="w-4 h-4 text-gray-800" />
                </button>

                <slot name="tools" />
            </div>
        </div>

        <div class="border border-gray-100">
            <slot name="content" :editable="editable" />
        </div>
    </div>

    <div v-else>
        <slot name="content" :editable="editable" />
    </div>
</template>
