<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ThemeToggle from '@/Components/ThemeToggle.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const showingNavigationDropdown = ref(false);
// const darkModeToggle = ref(null);
// const lightModeToggle = ref(null);

function removeId() {
    localStorage.clear();
}

// function applyDarkMode() {
//     document.documentElement.classList.remove('light');
//     document.documentElement.classList.add('dark');
//     localStorage.setItem('theme', 'dark');
//     darkModeToggle.value.classList.add('hidden');
//     lightModeToggle.value.classList.remove('hidden');
// }

// function applyLightMode() {
//     document.documentElement.classList.remove('dark');
//     document.documentElement.classList.add('light');
//     localStorage.setItem('theme', 'light');
//     lightModeToggle.value.classList.add('hidden');
//     darkModeToggle.value.classList.remove('hidden');
// }

// function switchTheme() {
//     if (localStorage.getItem('theme') === 'light') {
//         applyDarkMode();
//     } else if(localStorage.getItem('theme') === 'dark') {
//         applyLightMode();
//     } else {
//         applySystemTheme();
//     }
// }

// function applySystemTheme() {
//     if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
//         applyDarkMode();
//     } else {
//         applyLightMode();
//     }
// }

// function applyLocalTheme() {
//     if (localStorage.getItem('theme') === 'light') {
//         applyLightMode();
//     } else {
//         applyDarkMode();
//     }
// }

// function checkCurrentTheme() {
//     if (!('theme' in localStorage)) {
//         applySystemTheme();
//     } else {
//         applyLocalTheme();
//     }
// }

// onMounted(() => {
//     lightModeToggle.value.value = lightModeToggle.value.id;
//     darkModeToggle.value.value = darkModeToggle.value.id;
//     checkCurrentTheme();
// });

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>

                                <NavLink :href="route('posts')" :active="route().current('posts')">
                                    Posts
                                </NavLink>

                                <NavLink :href="route('new_post')" :active="route().current('new_post')">
                                    New Post
                                </NavLink>
                                <NavLink :href="route('search')" :active="route().current('search')">
                                    Search
                                </NavLink>
                                <!-- <button 
                                    id="theme-toggle-button" 
                                    type="button" 
                                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 my-auto"
                                    @click="switchTheme"
                                >
                                    <img ref="lightModeToggle" src="/assets/light.svg" alt="" id="light-theme-toggle" class="w-5 h-5">
                                    <img ref="darkModeToggle" src="/assets/dark.svg" alt="" id="dark-theme-toggle" class="w-5 h-5">
                                </button> -->
                                <ThemeToggle 
                                    class="text-gray-500 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 my-auto"
                                />
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <span @click="removeId">
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </span>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
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
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <ThemeToggle 
                        class="text-gray-500 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 my-auto"
                    />
                    
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('posts')" :active="route().current('posts')">
                            Posts
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('new_post')" :active="route().current('new_post')">
                            New Post
                        </ResponsiveNavLink>
                        <ResponsiveNavLink href="route('search')" :active="route().current('search')">
                            Search
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <span @click="removeId">
                                <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </span>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
