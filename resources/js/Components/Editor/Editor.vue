<script setup>
import StarterKit from '@tiptap/starter-kit'
import Toolbar from '@/Components/Editor/Toolbar.vue'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import BubbleMenu from '@/Components/Editor/BubbleMenu.vue'
import Extensions from '@/Components/Editor/extensions.js'

const props = defineProps({
    modelValue: String,
    blog: Object,
})

const emits = defineEmits(['update:modelValue'])

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit, Extensions],
    editorProps: {
        attributes: {
            class: 'bg-white p-4 max-w-none w-full min-h-[500px] focus:outline-none border border-gray-200 rounded-md max-h-[85vh] overflow-y-scroll overflow-hidden prose prose-img:m-0 ',
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

        <Toolbar :editor="editor" :blog="blog" />

        <div class="mt-4">
            <div class="text-gray-500">
                To add a hard break: `Ctr` + `Enter` on windows or `Cmd` + `Enter` on mac
            </div>

            <EditorContent :editor="editor" />
        </div>
    </div>
</template>

<style>
/* Basic editor styles */
.tiptap {
    > * + * {
        margin-top: 0.75em;
    }

    pre {
        background: #0d0d0d;
        color: #fff;
        font-family: 'JetBrainsMono', monospace;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;

        code {
            color: inherit;
            padding: 0;
            background: none;
            font-size: 0.8rem;
        }

        .hljs-comment,
        .hljs-quote {
            color: #616161;
        }

        .hljs-variable,
        .hljs-template-variable,
        .hljs-attribute,
        .hljs-tag,
        .hljs-name,
        .hljs-regexp,
        .hljs-link,
        .hljs-name,
        .hljs-selector-id,
        .hljs-selector-class {
            color: #f98181;
        }

        .hljs-number,
        .hljs-meta,
        .hljs-built_in,
        .hljs-builtin-name,
        .hljs-literal,
        .hljs-type,
        .hljs-params {
            color: #fbbc88;
        }

        .hljs-string,
        .hljs-symbol,
        .hljs-bullet {
            color: #b9f18d;
        }

        .hljs-title,
        .hljs-section {
            color: #faf594;
        }

        .hljs-keyword,
        .hljs-selector-tag {
            color: #70cff8;
        }

        .hljs-emphasis {
            font-style: italic;
        }

        .hljs-strong {
            font-weight: 700;
        }
    }
}
</style>
