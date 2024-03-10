<script>
export default {
    name: 'Image',
}
</script>

<script setup>
import { ref } from 'vue'
import { NodeViewWrapper, nodeViewProps } from '@tiptap/vue-3'
import { PhotoIcon } from '@heroicons/vue/24/solid'
import EditableNode from '../../Components/EditableNodeWrapper.vue'
import breakdownNodeViewProps from '@/Helpers/breakdownNodeViewProps'
import EditImage from '@/Components/Editor/Components/Modals/EditImage.vue'

const props = defineProps({
    ...nodeViewProps,
})

const open = ref(false)

let { fileId, blogId, src, alt, height } = breakdownNodeViewProps(props)
</script>

<template>
    <NodeViewWrapper>
        <EditableNode v-bind="props">
            <template #tools>
                <button @click="open = true">Edit</button>
                <EditImage
                    @close="open = false"
                    :open="open"
                    :blogId="blogId"
                    v-model="src"
                    v-model:fileId="fileId"
                    v-model:alt="alt"
                    v-model:height="height"
                />
            </template>

            <template #content>
                <div class="flex flex-col sm:gap-4 mb-4">
                    <div class="flex w-full justify-center">
                        <div class="flex-col w-full">
                            <div v-if="src" class="flex mb-4 w-full">
                                <img :src="src" :alt="alt" :style="{ height: `${height}px` }" />
                            </div>

                            <div v-else class="flex flex-col justify-center items-center mt-2">
                                <PhotoIcon class="w-12 h-12 text-gray-300" />
                                <p class="mt-1 text-sm text-gray-300">Select or upload an image</p>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </EditableNode>
    </NodeViewWrapper>
</template>
