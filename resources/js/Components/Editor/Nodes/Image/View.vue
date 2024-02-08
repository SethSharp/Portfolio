<script>
export default {
    name: 'Image',
}
</script>

<script setup>
import {ref, watch, computed} from 'vue'
import {NodeViewWrapper, nodeViewProps} from '@tiptap/vue-3'
import {PhotoIcon, XMarkIcon} from '@heroicons/vue/24/solid'
import EditableNode from '../../Components/EditableNodeWrapper.vue'
import EditImage from '@/Components/Editor/Components/Modals/EditImage.vue'
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue'

const props = defineProps({
    ...nodeViewProps,
})

const open = ref(false)
const src = ref(props.node.attrs.src)

watch(src, (newVal) => {
    newSrc.value = newVal
})

let newSrc = computed({
    get: () => props.node.attrs[src],
    set: (value) => {
        props.updateAttributes({
            [src]: value,
        })
    },
})
</script>

<template>
    <NodeViewWrapper>
        <EditableNode v-bind="props">
            <template #tools>
                <EditImage @close="open = false" :open="open" v-model="src"/>
            </template>

            <template #content>
                <div class="flex flex-col sm:gap-4 mb-4">
                    <div class="flex w-full justify-center">
                        <div class="flex-col w-full">
                            <div v-if="src" class="flex mb-4 w-full">
                                <div class="relative shadow w-full">
                                    <button
                                        class="absolute -right-3 top-4 bg-white shadow text-red-400 hover:bg-white hover:text-red-500 hover:shadow rounded-full"
                                    >
                                        x
                                    </button>

                                    <img :src="src"/>
                                </div>
                            </div>

                            <div v-else class="flex flex-col justify-center items-center mt-2">
                                <PhotoIcon class="w-12 h-12 text-gray-300"/>
                                <p class="mt-1 text-sm text-gray-300">Select or upload an image</p>
                            </div>

                            <div class="flex justify-center p-2">
                                <SecondaryButton @click="open = true">
                                    Upload an Image
                                </SecondaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </EditableNode>
    </NodeViewWrapper>
</template>
