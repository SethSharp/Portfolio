<script setup>
defineProps({
    editor: Object,
})
</script>

<template>
    <div v-if="editor" class="w-full">
        <button
            @click="editor.chain().focus().toggleOrderedList().run()"
            :class="{ 'is-active': editor.isActive('orderedList') }"
        >
            toggleOrderedList
        </button>
        <button
            @click="editor.chain().focus().splitListItem('listItem').run()"
            :disabled="!editor.can().splitListItem('listItem')"
        >
            splitListItem
        </button>
        <button
            @click="editor.chain().focus().sinkListItem('listItem').run()"
            :disabled="!editor.can().sinkListItem('listItem')"
        >
            sinkListItem
        </button>
        <button
            @click="editor.chain().focus().liftListItem('listItem').run()"
            :disabled="!editor.can().liftListItem('listItem')"
        >
            liftListItem
        </button>
    </div>
</template>
