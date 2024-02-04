<script setup>
import StarterKit from '@tiptap/starter-kit'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import BubbleMenu from '@/Components/Editor/BubbleMenu.vue'
import ListItem from '@tiptap/extension-list-item'
import Document from '@tiptap/extension-document'
import { Paragraph } from '@tiptap/extension-paragraph'
import OrderedList from '@tiptap/extension-ordered-list'
import { Text } from '@tiptap/extension-text'
import { Underline } from '@tiptap/extension-underline'
import Link from '@tiptap/extension-link'
import { TextAlign } from '@tiptap/extension-text-align'

const props = defineProps({
    modelValue: {
        type: String,
    },
})

const emits = defineEmits(['update:modelValue'])

const editor = useEditor({
    content: props.modelValue,
    extensions: [
        StarterKit,
        Document,
        OrderedList,
        ListItem,
        Paragraph.configure({
            HTMLAttributes: {
                class: 'h-6',
            },
        }),
        Text,
        Underline,
        Link.configure({
            openOnClick: false,
        }),
        TextAlign.configure({
            types: ['heading', 'paragraph'],
        }),
    ],
    editorProps: {
        attributes: {
            class: 'prose dark:prose-invert border-2 border-gray-200 rounded-lg p-6 prose-sm sm:prose-base lg:prose-lg xl:prose-2xl focus:outline-none',
        },
    },
    onUpdate: () => {
        emits('update:modelValue', editor.value.getHTML())
    },
})
</script>

<template>
    <div>
        <BubbleMenu :editor="editor" />

        <div class="border-gray-400">
            <EditorContent :editor="editor" />
        </div>
    </div>
</template>
