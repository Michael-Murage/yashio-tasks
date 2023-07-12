<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { ref } from 'vue';

const posts = ref([]);

async function fetchPosts() {
    let id = atob(localStorage.getItem('user'));

    try {
        const resp = await fetch(`/api/posts/${id}`);
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

function switchPage(id) {
    window.location.href = `/posts/${id}`;
}

onMounted(fetchPosts)
</script>

<template>
    <Head title="Create New Post"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    <div 
                        class="bg-white dark:bg-gray-800 p-2 my-2 rounded-lg hover:scale-95"
                        v-for="post in (Array.isArray(posts) ? posts : [])"
                        :key="post.id"
                        @click="switchPage(post.id)"
                    >
                        <h1 class="font-semibold text-2xl">{{ post.title }}</h1>
                        <p class="my-3">
                            {{ post.content.slice(0, 50) }}
                            <span v-if="post.content.length > 50">...</span>
                        </p>

                        <div class="flex justify-start my-3">
                            <div 
                                v-for="tag in (Array.isArray(post.tags) ? post.tags : [])" 
                                :key="tag"
                                class="mr-2 bg-blue-200 rounded-md text-blue-500"
                            >
                                <p class="px-2 py-1">
                                    {{ tag.name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
