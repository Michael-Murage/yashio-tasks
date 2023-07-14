<script setup>
import { ref, toRefs, onMounted, watch } from 'vue';

const props = defineProps(['posts']);

defineEmits(['next', 'previous']);

const { posts } = toRefs(props);
const limit = ref(null);

function switchToSinglePostPage(id) {
    window.location.href = `/posts/${id}`;
}

watch(posts, () => {
    limit.value = Math.ceil(posts.value.total / posts.value.per_page);
});

onMounted(() => {
    limit.value = Math.ceil(posts.value.total / posts.value.per_page);
});
</script>
<template>
    <div 
        class="bg-white dark:bg-gray-800 p-2 my-2 rounded-lg hover:scale-95"
        v-for="post in (Array.isArray(posts.data) ? posts.data : [])"
        :key="post.id"
        @click="switchToSinglePostPage(post.id)"
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

    <nav 
        class="isolate inline-flex -space-x-px rounded-md shadow-sm" 
        aria-label="Pagination"
    >
        <button 
            class="relative inline-flex items-center rounded-l-md border px-2 py-2 text-sm font-medium focus:z-20 disabled:opacity-50 bg-white text-gray-500 border-gray-300 hover:bg-gray-50"
            :disabled="posts.current_page <= 1"
            @click="this.$emit('previous')"
        >
            <span class="sr-only">
                Previous
            </span>
            <img src="/assets/previous.svg" class="w-5 h-5" alt="">
        </button>
        <button 
            class="relative inline-flex items-center border px-4 py-2 text-sm font-medium focus:z-20 bg-white text-gray-500 border-gray-300 hover:bg-gray-50" 
            aria-current="page"
        >
            {{ posts.current_page }}
        </button>
        <button 
            class="relative inline-flex items-center rounded-r-md border px-2 py-2 text-sm font-medium focus:z-20 disabled:opacity-50 bg-white text-gray-500 border-gray-300 hover:bg-gray-50" 
            :disabled="posts.current_page >= limit"
            @click="this.$emit('next')"
        >
            <span class="sr-only">
                Next
            </span>
            <img src="/assets/next.svg" class="h-5 w-5" alt="">
        </button>
    </nav>
</template>