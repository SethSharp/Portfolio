<script setup>
import { computed } from "vue";
import InputLabel from "@/Components/Inputs/InputLabel.vue";

const emit = defineEmits(["update:checked"]);

const props = defineProps({
    checked: {
        type: [Array, Boolean],
        required: true,
    },
    value: {
        default: null,
    },
    label: {
        type: String,
        default: "",
    },
});

const proxyChecked = computed({
    get() {
        return props.checked;
    },

    set(val) {
        emit("update:checked", val);
    },
});
</script>

<template>
    <div>
        <InputLabel :value="label" />

        <input
            type="checkbox"
            :value="value"
            v-model="proxyChecked"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
        />
    </div>
</template>
