<script setup>
import { BubbleMenu } from '@tiptap/vue-3'
import BubbleButton from '@/Components/Editor/Other/BubbleButton.vue'
import {
    Bars3BottomLeftIcon,
    Bars3BottomRightIcon,
    Bars3Icon,
    Bars3CenterLeftIcon,
    Bars4Icon,
} from '@heroicons/vue/16/solid/index.js'

const props = defineProps({
    editor: Object,
})

const setLink = () => {
    const previousUrl = props.editor.getAttributes('link').href
    const url = window.prompt('URL', previousUrl)

    // cancelled
    if (url === null) {
        return
    }

    // empty
    if (url === '') {
        props.editor.chain().focus().extendMarkRange('link').unsetLink().run()
    }

    props.editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run()
}
</script>

<template>
    <BubbleMenu v-if="editor" :editor="editor">
        <div class="rounded-xl w-fit">
            <BubbleButton
                @click="editor.chain().focus().toggleBold().run()"
                :active="editor.isActive('bold')"
                class="font-bold rounded-l-xl"
            >
                bold
            </BubbleButton>

            <BubbleButton
                @click="editor.chain().focus().toggleItalic().run()"
                :active="editor.isActive('italic')"
                class="italic"
            >
                italic
            </BubbleButton>

            <BubbleButton
                @click="editor.chain().focus().toggleUnderline().run()"
                :active="editor.isActive('underline')"
                class="underline"
            >
                U
            </BubbleButton>

            <BubbleButton
                v-if="!editor.isActive('link')"
                @click="setLink"
                :active="editor.isActive('link')"
                class="underline"
            >
                Link
            </BubbleButton>

            <BubbleButton
                v-if="editor.isActive('link')"
                @click="editor.chain().focus().unsetLink().run()"
                :active="editor.isActive('link')"
                class="underline"
            >
                Unlink
            </BubbleButton>

            <BubbleButton>
                <button
                    @click="editor.chain().focus().setTextAlign('left').run()"
                    :active="editor.isActive({ textAlign: 'left' })"
                >
                    <Bars3BottomLeftIcon class="w-4 h-4" />
                </button>
            </BubbleButton>

            <BubbleButton
                @click="editor.chain().focus().setTextAlign('center').run()"
                :active="editor.isActive({ textAlign: 'center' })"
            >
                <Bars3Icon class="w-4 h-4" />
            </BubbleButton>

            <BubbleButton
                @click="editor.chain().focus().setTextAlign('right').run()"
                :active="editor.isActive({ textAlign: 'right' })"
            >
                <Bars3BottomRightIcon class="w-4 h-4" />
            </BubbleButton>

            <BubbleButton
                @click="editor.chain().focus().setTextAlign('justify').run()"
                :active="editor.isActive({ textAlign: 'justify' })"
            >
                <Bars3CenterLeftIcon class="w-4 h-4" />
            </BubbleButton>

            <BubbleButton @click="editor.chain().focus().unsetTextAlign().run()">
                <Bars4Icon class="w-4 h-4" />
            </BubbleButton>

            <BubbleButton
                @click="editor.chain().focus().toggleStrike().run()"
                :active="editor.isActive('strike')"
                class="line-through rounded-r-xl"
            >
                strike
            </BubbleButton>
        </div>
    </BubbleMenu>
</template>
