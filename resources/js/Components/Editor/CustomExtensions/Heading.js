import BaseHeading from '@tiptap/extension-heading'
import { mergeAttributes } from '@tiptap/core'

export const Heading = BaseHeading.extend({
    levels: [1, 2, 3],
    renderHTML({ node, HTMLAttributes }) {
        const level = this.options.levels.includes(node.attrs.level)
            ? node.attrs.level
            : this.options.levels[0]

        const classes = {
            1: 'text-2xl',
            2: 'text-xl',
            3: 'text-lg',
        }
        return [
            `h${level}`,
            mergeAttributes(this.options.HTMLAttributes, HTMLAttributes, {
                class: `${classes[level]}`,
            }),
            0,
        ]
    },
}).configure({ levels: [1, 2, 3] })
