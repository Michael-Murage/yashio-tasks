<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { ref, watch } from 'vue';
import PostsDisplay from '@/Pages/PostsDisplay.vue';

const searchInput = ref('');
// const posts = ref([]);


let id = atob(localStorage.getItem('user'));

</script>
<template>
    <Head title="Search Posts"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-center">
                        <input
                            type="search"
                            class="my-4 rounded-md lg:rounded-lg bg-white text-gray-900 dark:bg-gray-700 dark:text-white"
                            v-model="searchInput"
                            placeholder="Enter tag or title to search"
                            title="Enter tag or post title to search"
                        />
                    </div>
                </div>

                <PostsDisplay :url="`/api/posts/${id}`" :searchInput="searchInput"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>