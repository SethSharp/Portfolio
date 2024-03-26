<script setup>
import { createLowlight } from 'lowlight'
import Link from '@tiptap/extension-link'
import { Text } from '@tiptap/extension-text'
import StarterKit from '@tiptap/starter-kit'
import php from 'highlight.js/lib/languages/php'
import Document from '@tiptap/extension-document'
import ListItem from '@tiptap/extension-list-item'
import { Underline } from '@tiptap/extension-underline'
import { HardBreak } from '@tiptap/extension-hard-break'
import { useEditor, EditorContent } from '@tiptap/vue-3'
import { TextAlign } from '@tiptap/extension-text-align'
import OrderedList from '@tiptap/extension-ordered-list'
import CodeBlockLowlight from '@tiptap/extension-code-block-lowlight'
import Toolbar from '@/Components/Editor/Toolbar.vue'
import BubbleMenu from '@/Components/Editor/BubbleMenu.vue'
import Image from '@/Components/Editor/Nodes/Image/Image.js'
import { Paragraph } from '@tiptap/extension-paragraph'
import { Heading } from '@/Components/Editor/CustomExtensions/Heading.js'

const props = defineProps({
    modelValue: {
        type: String,
    },
    blog: Object,
})

const emits = defineEmits(['update:modelValue'])
const lowlight = createLowlight()

lowlight.register({ php })

const editor = useEditor({
    content: props.modelValue,
    extensions: [
        StarterKit,
        CodeBlockLowlight.configure({
            lowlight,
            defaultLanguage: 'php',
            languageClassPrefix: 'language-',
        }),
        Document,
        Heading,
        Paragraph.configure({
            HTMLAttributes: {
                style: 'color: #475569;',
            },
        }),
        Link.configure({
            openOnClick: false,
            HTMLAttributes: {
                style: 'color: #1d4ed8;',
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
        Text,
        Underline,
        Image,
        HardBreak,
    ],
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
