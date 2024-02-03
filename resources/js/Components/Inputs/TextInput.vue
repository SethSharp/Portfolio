<script setup>
import { onMounted, ref } from "vue";
import InputLabel from "@/Components/Inputs/InputLabel.vue";

defineProps({
    label: {
        type: String,
        default: "",
    },
    type: {
        type: String,
        default: "text",
    },
});

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div>
        <InputLabel :value="label" />

        <input
            :type="type"
            class="w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            v-model="model"
            ref="input"
        />
    </div>
</template>
