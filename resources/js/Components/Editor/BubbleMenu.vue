<script setup>
import { BubbleMenu } from '@tiptap/vue-3'
import BubbleButton from '@/Components/Editor/Components/BubbleButton.vue'
import {
    Bars3BottomLeftIcon,
    Bars3BottomRightIcon,
    Bars3Icon,
    Bars3CenterLeftIcon,
    Bars4Icon,
    CodeBracketIcon,
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
    <div class="w-full bg-red-50">
        <BubbleMenu v-if="editor" :editor="editor">
            <div class="isolate inline-flex rounded-md shadow-sm">
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
                    Underline
                </BubbleButton>

                <BubbleButton
                    v-if="!editor.isActive('link')"
                    @click="
                        !editor.isActive('link')
                            ? setLink()
                            : editor.chain().focus().unsetLink().run()
                    "
                    :active="editor.isActive('link')"
                    class="underline"
                >
                    Link
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
                    class="line-through"
                >
                    strike
                </BubbleButton>

                <BubbleButton
                    @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                    :active="editor.isActive('heading', { level: 1 })"
                >
                    H1
                </BubbleButton>

                <BubbleButton
                    @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                    :active="editor.isActive('heading', { level: 2 })"
                >
                    H2
                </BubbleButton>

                <BubbleButton
                    @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                    :active="editor.isActive('heading', { level: 3 })"
                >
                    H3
                </BubbleButton>

                <BubbleButton
                    @click="editor.chain().focus().toggleCode().run()"
                    :active="editor.isActive('code')"
                    class="rounded-r-xl"
                >
                    <CodeBracketIcon class="w-6 h-6" />
                </BubbleButton>
            </div>
        </BubbleMenu>
    </div>
</template>
