<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import PostsDisplay from '@/Pages/PostsDisplay.vue';

const titleInput = ref('');
const tagInput = ref('');
const posts = ref({});

let id = atob(localStorage.getItem('user'));

async function fetchPosts(page) {
    if (!titleInput.value && !tagInput.value) return;
    try {
        const resp = await fetch(`/api/posts/${id}?title=${titleInput.value}&tag=${tagInput.value}&page=${page}`);
        if (resp.ok) {
            const jsonResp = await resp.json();
            posts.value = jsonResp;
        } else {
            const errorJson = await resp.json();
            console.error(errorJson.message);
        }
    } catch (error) {
        console.error(error.message);
    }
}

function nextPage() {
    const nextPageNumber = posts.value.current_page + 1;
    fetchPosts(nextPageNumber);
}

function previousPage() {
    const prevPageNumber = posts.value.current_page - 1;
    fetchPosts(prevPageNumber);
}

</script>
<template>
    <Head title="Search Posts"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-around">
                        <div class="flex flex-col justify-center my-4">
                            <label for="title-search" class="block text-gray-700 dark:text-gray-300 text-xl font-semibold mb-2">
                                Title
                            </label>
                            <input
                                type="text"
                                class="rounded-md lg:rounded-lg bg-white text-gray-900 dark:bg-gray-700 dark:text-white"
                                v-model="titleInput"
                                placeholder="Enter title to search"
                                title="Enter post title to search"
                            />
                        </div>

                        <div class="flex justify-center flex-col my-4">
                            <label for="title-search" class="block text-gray-700 dark:text-gray-300 text-xl font-semibold mb-2">
                                Tag
                            </label>
                            <input
                                type="text"
                                class="rounded-md lg:rounded-lg bg-white text-gray-900 dark:bg-gray-700 dark:text-white"
                                v-model="tagInput"
                                placeholder="Enter tag to search"
                                title="Enter tag to search"
                            />
                        </div>
                    </div>
                    
                    <div class="flex justify-center mt-3">
                        <button 
                            class="px-4 py-2 bg-blue-600 text-gray-100 dark:bg-blue-500 dark:text-gray-900 rounded-md hover:opacity-50 hover:scale-110"
                            @click="fetchPosts(1)"
                        >
                            Search
                        </button>
                    </div>
                </div>

                

                <PostsDisplay 
                    :posts="posts"
                    v-on:next="nextPage"
                    v-on:previous="previousPage"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>