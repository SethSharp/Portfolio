import { Node } from '@tiptap/core'
import { VueNodeViewRenderer, mergeAttributes } from '@tiptap/vue-3'
import View from './View.vue'

export default Node.create({
    name: 'Image',

    group: 'block',

    atomic: true,

    draggable: true,

    addAttributes() {
        return {
            fileId: {
                default: null,
            },
            blogId: {
                default: 'null',
            },
            src: {
                default: null,
            },
            alt: {
                default: null,
            },
            height: {
                default: '200px',
            },
        }
    },

    parseHTML() {
        return [
            {
                tag: 'tt-image',
            },
        ]
    },

    renderHTML({ HTMLAttributes }) {
        return ['tt-image', mergeAttributes(HTMLAttributes)]
    },

    addNodeView() {
        return VueNodeViewRenderer(View)
    },
})
