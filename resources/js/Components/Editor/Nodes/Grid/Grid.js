import { Node } from '@tiptap/core'
import { VueNodeViewRenderer, mergeAttributes } from '@tiptap/vue-3'
import View from './View.vue'

export default Node.create({
    name: 'Grid',

    group: 'block',

    content: 'block+',

    draggable: true,

    isolating: true,

    addAttributes() {
        return {
            cols: {
                default: 3,
            },
            gap: {
                default: 2,
            },
            mobileColumns: {
                default: 1,
            },
        }
    },

    parseHTML() {
        return [
            {
                tag: 'tt-grid',
            },
        ]
    },

    renderHTML({ HTMLAttributes }) {
        return ['tt-grid', mergeAttributes(HTMLAttributes), 0]
    },

    addNodeView() {
        return VueNodeViewRenderer(View)
    },
})
