<script setup>
import {
    PhotoIcon,
    MinusIcon,
    ListBulletIcon,
    Bars3BottomLeftIcon,
    Bars3BottomRightIcon,
    Bars3Icon,
    Bars3CenterLeftIcon,
} from '@heroicons/vue/16/solid/index.js'
import BubbleButton from '@/Components/Editor/Components/BubbleButton.vue'

const props = defineProps({
    editor: Object,
    blog: Object,
})

const insertImage = () => {
    props.editor
        .chain()
        .focus()
        .insertContent(`<tt-image blogId="${props.blog.id}"></tt-image>`)
        .run()
}
</script>

<template>
    <div v-if="editor" class="w-full flex gap-x-4" v-cloak>
        <BubbleButton @click="editor.chain().focus().setHorizontalRule().run()" class="rounded-md">
            <MinusIcon class="size-6 text-black" />
        </BubbleButton>

        <BubbleButton
            @click="editor.chain().focus().toggleOrderedList().run()"
            :active="editor.isActive('orderedList')"
            class="rounded-md"
        >
            <ListBulletIcon class="size-6 text-black" />
        </BubbleButton>

        <BubbleButton @click.prevent="insertImage" class="rounded-md">
            <PhotoIcon class="size-6 text-black" />
        </BubbleButton>

        <BubbleButton
            @click="editor.chain().focus().setTextAlign('left').run()"
            :active="editor.isActive({ textAlign: 'left' })"
            class="rounded-md"
        >
            <Bars3BottomLeftIcon class="size-4" />
        </BubbleButton>

        <BubbleButton
            @click="editor.chain().focus().setTextAlign('center').run()"
            :active="editor.isActive({ textAlign: 'center' })"
            class="rounded-md"
        >
            <Bars3Icon class="size-4" />
        </BubbleButton>

        <BubbleButton
            @click="editor.chain().focus().setTextAlign('right').run()"
            :active="editor.isActive({ textAlign: 'right' })"
            class="rounded-md"
        >
            <Bars3BottomRightIcon class="size-4" />
        </BubbleButton>

        <BubbleButton
            @click="editor.chain().focus().setTextAlign('justify').run()"
            :active="editor.isActive({ textAlign: 'justify' })"
            class="rounded-md"
        >
            <Bars3CenterLeftIcon class="size-4" />
        </BubbleButton>
    </div>
</template>
