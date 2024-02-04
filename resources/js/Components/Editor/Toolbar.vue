<script setup>
import BubbleButton from '@/Components/Editor/Components/BubbleButton.vue'
import { ListBulletIcon } from '@heroicons/vue/16/solid/index.js'

defineProps({
    editor: Object,
})
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
    </div>
</template>
