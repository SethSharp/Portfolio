<script setup>
import { BubbleMenu } from '@tiptap/vue-3'
import BubbleButton from '@/Components/Editor/Other/BubbleButton.vue'

defineProps({
    editor: Object,
})
</script>

<template>
    <BubbleMenu v-if="editor" :editor="editor">
        <div class="bg-white rounded-xl">
            <BubbleButton
                @click="editor.chain().focus().toggleBold().run()"
                class="font-bold rounded-l-xl"
                :class="{ 'bg-gray-300': editor.isActive('bold') }"
            >
                bold
            </BubbleButton>

            <BubbleButton
                @click="editor.chain().focus().toggleItalic().run()"
                class="italic"
                :class="{ 'bg-gray-300': editor.isActive('italic') }"
            >
                italic
            </BubbleButton>

            <BubbleButton
                @click="editor.chain().focus().toggleStrike().run()"
                :class="{ 'bg-gray-300': editor.isActive('strike') }"
                class="line-through"
            >
                strike
            </BubbleButton>
        </div>
    </BubbleMenu>
</template>
