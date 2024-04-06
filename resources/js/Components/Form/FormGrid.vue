<script setup>
import FormElement from '@/Components/Form/FormElement.vue'
</script>

<template>
    <FormElement>
        <div class="grid sm:grid-cols-2 gap-4">
            <slot />
        </div>
    </FormElement>
</template>
