<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PostsDisplay from '@/Pages/PostsDisplay.vue';

let id = atob(localStorage.getItem('user'));

</script>

<template>
    <Head title="Create New Post"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <PostsDisplay :url="`/api/posts/${id}`"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
