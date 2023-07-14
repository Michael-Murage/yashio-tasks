<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps(['class'])
const darkModeToggle = ref(null);
const lightModeToggle = ref(null);

function applyDarkMode() {
    document.documentElement.classList.remove('light');
    document.documentElement.classList.add('dark');
    localStorage.setItem('theme', 'dark');
    darkModeToggle.value.classList.add('hidden');
    lightModeToggle.value.classList.remove('hidden');
}

function applyLightMode() {
    document.documentElement.classList.remove('dark');
    document.documentElement.classList.add('light');
    localStorage.setItem('theme', 'light');
    lightModeToggle.value.classList.add('hidden');
    darkModeToggle.value.classList.remove('hidden');
}

function switchTheme() {
    if (localStorage.getItem('theme') === 'light') {
        applyDarkMode();
    } else if(localStorage.getItem('theme') === 'dark') {
        applyLightMode();
    } else {
        applySystemTheme();
    }
}

function applySystemTheme() {
    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        applyDarkMode();
    } else {
        applyLightMode();
    }
}

function applyLocalTheme() {
    if (localStorage.getItem('theme') === 'light') {
        applyLightMode();
    } else {
        applyDarkMode();
    }
}

function checkCurrentTheme() {
    if (!('theme' in localStorage)) {
        applySystemTheme();
    } else {
        applyLocalTheme();
    }
}

onMounted(() => {
    lightModeToggle.value.value = lightModeToggle.value.id;
    darkModeToggle.value.value = darkModeToggle.value.id;
    checkCurrentTheme();
});
</script>
<template>
    <button 
        id="theme-toggle-button" 
        type="button" 
        :class="props.class ? props.class : 'absolute top-3 right-16 text-gray-500 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-lg p-2.5'"
        @click="switchTheme"
    >
        <img ref="lightModeToggle" title="Switch to Dark mode" src="/assets/light.svg" alt="" id="light-theme-toggle" class="w-5 h-5">
        <img ref="darkModeToggle" title="Switch to Light mode" src="/assets/dark.svg" alt="" id="dark-theme-toggle" class="w-5 h-5">
    </button>
</template>