<script setup>
import StarterKit from '@tiptap/starter-kit'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import BubbleMenu from '@/Components/Editor/BubbleMenu.vue'
import ListItem from '@tiptap/extension-list-item'
import Document from '@tiptap/extension-document'
import { Paragraph } from '@tiptap/extension-paragraph'
import OrderedList from '@tiptap/extension-ordered-list'

import ComponentMenu from '@/Components/Editor/ComponentMenu.vue'
import { Text } from '@tiptap/extension-text'

const props = defineProps({
    modelValue: {
        type: String,
    },
})

const emits = defineEmits(['update:modelValue'])

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit, Document, OrderedList, ListItem, Paragraph, Text],
    editorProps: {
        attributes: {
            class: 'prose dark:prose-invert bg-red-50 p-6 prose-sm sm:prose-base lg:prose-lg xl:prose-2xl m-5 focus:outline-none',
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

        <ComponentMenu :editor="editor" />

        <div class="border-gray-400">
            <EditorContent :editor="editor" />
        </div>
    </div>
</template>
