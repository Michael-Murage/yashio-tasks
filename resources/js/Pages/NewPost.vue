<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';
import { onMounted } from 'vue';

const newPost = ref({
    title: '',
    content: '',
    user_id: null,
    tags: []
});

const tags = ref([]);
const resizeOption = ref(true);
const newTag = ref('');

async function fetchTags() {
    try {
        const resp = await fetch('/api/tags');
        if (resp.ok) {
            const jsonResp = await resp.json();
            tags.value = jsonResp;
        } else {
            const errorJson = await resp.json();
            console.log(errorJson.message);
        }
    } catch (error) {
        console.error(error.message);
    }
}

function addTask(e) {
    e.preventDefault();
    
    if (!newTag.value.trim()) return;
    newPost.value.tags.push(newTag.value);
    newPost.value.tags = [...new Set(newPost.value.tags)];
    newTag.value = '';
}

function removeItem(item) {
    newPost.value.tags = newPost.value.tags.filter(elem => elem !== item);
}

async function savePost() {
    try {
        const resp = await fetch('/api/posts', {
            method: "POST",
            headers: {'content-type': 'application/json', accept: 'application/json'},
            body: JSON.stringify(newPost.value)
        });

        if (resp.ok) {
            const jsonResp = await resp.json();
            toast(jsonResp);
            newPost.value = {
                title: '',
                content: '',
                user_id: null,
                tags: []
            }
        } else {
            const errorJson = await resp.json();
            toast.error(errorJson.message);
        }
    } catch (error) {
        toast.error(error.message);
    }
}

onMounted(fetchTags);

</script>

<template>
    <Head title="Create New Post"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-transparent overflow-hidden shadow-sm sm:rounded-lg">
                    <div 
                        class="rounded-lg card p-6 bg-gray-100 dark:bg-black mx-auto text-gray-900 dark:text-gray-100"
                        style="width: 80%; 
                        margin-top: 2px;"
                        id="inputForm"
                    >
                        <div id="title-form">
                            <InputLabel for="title-input" value="Title"/>

                            <TextInput 
                                name="title-input" 
                                class="mt-1 block w-full p-2"
                                id="title-input" 
                                placeholder="Enter title"
                                required
                                autofocus
                                v-model="newPost.title"
                            />
                        </div>

                        <div id="content-form" class="mt-4">
                            <InputLabel for="textarea-input" value="Post Content" />

                            <textarea 
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                placeholder="Enter note content..." 
                                id="textarea-input" 
                                :style="{resize: (resizeOption ? 'both' : 'none')}"
                                v-model="newPost.content"
                            ></textarea>
                        </div>

                        <div class="hidden">
                            <input 
                                type="hidden"
                                placeholder="Enter title"
                                required
                                autofocus
                                v-model="newPost.user_id"
                            />
                        </div>

                        <form id="tags-form" class="flex">
                            <div style="width: 70%">
                                <label class="text-sm">
                                    Tags
                                    <input 
                                        type="text"
                                        placeholder="Enter tags"
                                        class="mt-1 w-full block border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                        name="tags"
                                        list="tags"
                                        v-model="newTag"
                                    >
                                </label>
                                <datalist id="tags">
                                    <option 
                                        v-for="tag in (Array.isArray(tags) ? tags : [])"
                                        :key="tag.id"
                                    >
                                        {{ tag.name }}
                                    </option>
                                </datalist>
                                
                                
                            </div>

                            <button 
                                type="submit"
                                class="ml-auto mt-auto mb-2 py-1 bg-transparent hover:bg-blue-600 rounded-lg"
                                style="width: 20%"
                                @click="addTask($event)"
                            >
                                Add
                            </button>

                        </form>

                        <div class="flex justify-start mt-3">
                            <div 
                                v-for="tag in (Array.isArray(newPost.tags) ? newPost.tags : [])" 
                                :key="tag"
                                class="mr-2 bg-blue-200 rounded-md text-blue-500"
                            >
                                <p class="px-2 py-1" @click="removeItem(tag)">
                                    {{ tag }}
                                    <span title="Remove tag" class="text-red-400 mb-auto cursor-pointer hover:text-red-600">x</span>
                                </p>
                            </div>
                        </div>
                        <p class="hidden">
                            {{ newPost.user_id = $page.props.auth.user.id }}
                        </p>

                        <button
                            type="button"
                            class="bg-blue-600 hover:bg-blue-400 mt-3 py-2 px-4 rounded-md"
                            @click="savePost"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
