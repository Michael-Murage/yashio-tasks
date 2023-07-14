<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PostsDisplay from '@/Pages/PostsDisplay.vue';
import { onMounted, ref } from 'vue';

const posts = ref({});

let id = atob(localStorage.getItem('user'));

async function fetchPosts(page) {
    try {
        const resp = await fetch(`/api/posts/${id}?page=${page}`);
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


onMounted(() => {
    fetchPosts(1);
});
</script>

<template>
    <Head title="Create New Post"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <PostsDisplay 
                    :posts="posts" 
                    v-on:next="nextPage" 
                    v-on:previous="previousPage"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
