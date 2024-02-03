<script setup>
import StarterKit from '@tiptap/starter-kit'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import BubbleMenu from '@/Components/Editor/BubbleMenu.vue'

const props = defineProps({
    modelValue: {
        type: String,
    },
})

const emits = defineEmits(['update:modelValue'])

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit],
    onUpdate: (value) => {
        emits('update:modelValue', editor.value.getHTML())
    },
})
</script>

<template>
    <div class="border shadow rounded-2xl border-gray-200 p-3">
        <BubbleMenu :editor="editor" />

        <EditorContent :editor="editor" />
    </div>
</template>
