<script setup>
import StarterKit from '@tiptap/starter-kit'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import { ref, watch } from 'vue'

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
    <EditorContent :editor="editor" />
</template>
