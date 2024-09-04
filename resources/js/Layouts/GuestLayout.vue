<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900"
    >
        <div>
            <a href="/">
                <ApplicationLogo class="size-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="text-gray-500 mt-2">Logging into {{ $page.props.auth.in_app_name }} site</div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-gray-700"
        >
            <slot />
        </div>
    </div>
</template>
