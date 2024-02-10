<script setup>
import BubbleButton from '@/Components/Editor/Components/BubbleButton.vue'
import { ListBulletIcon, PhotoIcon, TableCellsIcon } from '@heroicons/vue/16/solid/index.js'

const props = defineProps({
    editor: Object,
})

const insertGrid = () => {
    props.editor
        .chain()
        .focus()
        .insertContent('<tt-grid><div>One</div><div>Two</div><div>Three</div></tt-grid>')
        .run()
}
</script>

<template>
    <div v-if="editor" class="w-full flex gap-x-4" v-cloak>
        <BubbleButton
            @click="editor.chain().focus().toggleOrderedList().run()"
            :active="editor.isActive('orderedList')"
            class="rounded-md"
        >
            <ListBulletIcon class="w-6 h-6 text-black" />
        </BubbleButton>

        <BubbleButton
            @click.prevent="editor.chain().focus().insertContent('<tt-image></tt-image>').run()"
            class="rounded-md"
        >
            <PhotoIcon class="w-6 h-6 text-black" />
        </BubbleButton>

        <BubbleButton @click.prevent="insertGrid()" class="rounded-md">
            <TableCellsIcon class="w-6 h-6 text-black" />
        </BubbleButton>
    </div>
</template>
