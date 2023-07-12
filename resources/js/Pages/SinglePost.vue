<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Create New Post"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <h1 class="font-semibold text-2xl underline uppercase">
                            {{ $page.props.data[0].title }}
                        </h1>

                        <p class="my-3">{{ $page.props.data[0].content }}</p>

                        <hr>

                        <div class="flex justify-start mt-6">
                            <div 
                                v-for="tag in (Array.isArray($page.props.data[0].tags) ? $page.props.data[0].tags : [])" 
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
