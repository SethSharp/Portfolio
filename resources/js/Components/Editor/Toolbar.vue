<script setup>
import BubbleButton from '@/Components/Editor/Components/BubbleButton.vue'
import { ListBulletIcon, PhotoIcon, MinusIcon } from '@heroicons/vue/16/solid/index.js'

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
        <BubbleButton
            @click="editor.chain().focus().setHorizontalRule().run()"
            :active="editor.isActive('orderedList')"
            class="rounded-md"
        >
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
    </div>
</template>
