<script setup>
import Link from '@tiptap/extension-link'
import Code from '@tiptap/extension-code'
import StarterKit from '@tiptap/starter-kit'
import { Text } from '@tiptap/extension-text'
import Document from '@tiptap/extension-document'
import ListItem from '@tiptap/extension-list-item'
import { Paragraph } from '@tiptap/extension-paragraph'
import { Underline } from '@tiptap/extension-underline'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import OrderedList from '@tiptap/extension-ordered-list'
import { TextAlign } from '@tiptap/extension-text-align'
import Toolbar from '@/Components/Editor/Toolbar.vue'
import BubbleMenu from '@/Components/Editor/BubbleMenu.vue'
import { Heading } from '@/Components/Editor/CustomExtensions/Heading.js'

const props = defineProps({
    modelValue: {
        type: String,
    },
})

const emits = defineEmits(['update:modelValue'])

const classes = {
    1: 'text-4xl',
    2: 'text-3xl',
    3: 'text-2xl',
}

const editor = useEditor({
    content: props.modelValue,
    extensions: [
        StarterKit,
        Code.configure({
            HTMLAttributes: {
                class: 'bg-gray-200 p-2 prose',
            },
        }),
        Document,
        Heading,
        Link.configure({
            openOnClick: false,
            HTMLAttributes: {
                class: 'text-blue-600 font-medium cursor-pointer',
            },
        }),
        ListItem,
        TextAlign.configure({
            types: ['heading', 'paragraph'],
        }),
        OrderedList.configure({
            HTMLAttributes: {
                class: 'list-decimal ml-6',
            },
        }),
        Paragraph.configure({
            HTMLAttributes: {
                class: 'h-6',
            },
        }),
        Text,
        Underline,
    ],
    editorProps: {
        attributes: {
            class: 'prose dark:prose-invert border-2 border-gray-200 rounded-lg p-6 prose-sm sm:prose-base lg:prose-lg xl:prose-2xl focus:outline-none',
        },
    },
    onUpdate: ({ editor }) => {
        emits('update:modelValue', editor.getHTML())
    },
})
</script>

<template>
    <div>
        <div class="w-full bg-red-500">
            <BubbleMenu :editor="editor" />
        </div>

        <Toolbar :editor="editor" />
        <div class="mt-4">
            <EditorContent :editor="editor" />
        </div>
    </div>
</template>
