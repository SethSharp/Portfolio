<script setup>
import { ref } from 'vue'
import { useDark } from '@vueuse/core'
import { Head, Link } from '@inertiajs/vue3'
import {
    Notifications,
    Dropdown,
    DropdownMenuLink,
    BaseDropdownMenuItem,
    SecondaryButton,
    Toggle,
} from '@sethsharp/lumuix'
import NavLink from '@/Components/Links/NavLink.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import ResponsiveNavLink from '@/Components/Links/ResponsiveNavLink.vue'

defineProps({
    title: {
        type: String,
        default: '',
    },
})

const showingNavigationDropdown = ref(false)

const links = [
    {
        name: 'Blogs',
        href: route('dashboard.blogs.index'),
        active: route().current('dashboard.blogs.*'),
    },
    {
        name: 'Tags',
        href: route('dashboard.tags.index'),
        active: route().current('dashboard.tags.*'),
    },
    {
        name: 'Collection',
        href: route('dashboard.collection.index'),
        active: route().current('dashboard.collection.*'),
    },
]

const isDark = useDark({
    selector: 'html',
})
</script>

<template>
    <Head :title="title" />

    <div>
        <div class="min-h-screen bg-slate-100 dark:bg-slate-800">
            <nav
                class="bg-white border-b border-slate-300 dark:bg-slate-900 dark:border-transparent"
            >
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard.blogs.index')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-primary-800 dark:text-primary-500"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink
                                    v-for="link in links"
                                    :href="link.href"
                                    :active="link.active"
                                >
                                    {{ link.name }}
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <Dropdown>
                                <template #trigger>
                                    <SecondaryButton>
                                        {{ $page.props.auth.user.name }}
                                    </SecondaryButton>
                                </template>

                                <template #content>
                                    <DropdownMenuLink :is="Link" :href="route('profile.edit')">
                                        Profile
                                    </DropdownMenuLink>

                                    <DropdownMenuLink is="a" :href="route('home')">
                                        Portfolio
                                    </DropdownMenuLink>

                                    <BaseDropdownMenuItem>
                                        <div class="flex gap-2">
                                            <span class="my-auto">Dark Mode: </span>
                                            <Toggle v-model="isDark" />
                                        </div>
                                    </BaseDropdownMenuItem>

                                    <DropdownMenuLink
                                        method="post"
                                        :as="Link"
                                        :href="route('logout')"
                                    >
                                        Log Out
                                    </DropdownMenuLink>
                                </template>
                            </Dropdown>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            v-for="link in links"
                            :href="link.href"
                            :active="link.active"
                        >
                            {{ link.name }}
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink external :href="route('home')">
                                Portfolio
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <div class="bg-white rounded-xl m-2 sm:m-6 p-4 sm:p-12 dark:bg-slate-900 space-y-4">
                    <slot />
                </div>
            </main>

            <Notifications :errors="$page.props.errors" :success="$page.props.success" />
        </div>
    </div>
</template>
