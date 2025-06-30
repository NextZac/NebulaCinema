<template>
    <AdminLayout title="Create Movie">
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 md:p-8">
                    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Create New Movie</h1>
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title (Original)</label>
                            <input type="text" id="title" v-model="form.title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.title }">
                            <p v-if="form.errors.title" class="mt-1 text-sm text-red-600">{{ form.errors.title }}</p>
                        </div>

                        <!-- English Title -->
                        <div class="mb-4">
                            <label for="titleEng" class="block text-sm font-medium text-gray-700">Title (English - Optional)</label>
                            <input type="text" id="titleEng" v-model="form.titleEng" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.titleEng }">
                            <p v-if="form.errors.titleEng" class="mt-1 text-sm text-red-600">{{ form.errors.titleEng }}</p>
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" v-model="form.description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.description }"></textarea>
                            <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">{{ form.errors.description }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Release Date -->
                            <div class="mb-4">
                                <label for="release_date" class="block text-sm font-medium text-gray-700">Release Date</label>
                                <input type="date" id="release_date" v-model="form.release_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.release_date }">
                                <p v-if="form.errors.release_date" class="mt-1 text-sm text-red-600">{{ form.errors.release_date }}</p>
                            </div>

                            <!-- Duration (in minutes) -->
                            <div class="mb-4">
                                <label for="duration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                                <input type="number" id="duration" v-model="form.duration" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.duration }">
                                <p v-if="form.errors.duration" class="mt-1 text-sm text-red-600">{{ form.errors.duration }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Age Rating -->
                            <div class="mb-4">
                                <label for="age_rating" class="block text-sm font-medium text-gray-700">Age Rating (e.g., PG-13, R)</label>
                                <input type="text" id="age_rating" v-model="form.age_rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.age_rating }">
                                <p v-if="form.errors.age_rating" class="mt-1 text-sm text-red-600">{{ form.errors.age_rating }}</p>
                            </div>

                            <!-- Director -->
                            <div class="mb-4">
                                <label for="director" class="block text-sm font-medium text-gray-700">Director</label>
                                <input type="text" id="director" v-model="form.director" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.director }">
                                <p v-if="form.errors.director" class="mt-1 text-sm text-red-600">{{ form.errors.director }}</p>
                            </div>
                        </div>

                        <!-- Cast -->
                        <div class="mb-4">
                            <label for="cast" class="block text-sm font-medium text-gray-700">Cast (comma separated)</label>
                            <textarea id="cast" v-model="form.cast" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.cast }"></textarea>
                            <p v-if="form.errors.cast" class="mt-1 text-sm text-red-600">{{ form.errors.cast }}</p>
                        </div>

                        <!-- Trailer URL -->
                        <div class="mb-4">
                            <label for="trailerUrl" class="block text-sm font-medium text-gray-700">Trailer URL (e.g., YouTube)</label>
                            <input type="url" id="trailerUrl" v-model="form.trailerUrl" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.trailerUrl }">
                            <p v-if="form.errors.trailerUrl" class="mt-1 text-sm text-red-600">{{ form.errors.trailerUrl }}</p>
                        </div>

                        <!-- Categories -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Categories</label>
                            <div class="mt-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-x-4 gap-y-2">
                                <div v-for="category in availableCategories" :key="category.id" class="flex items-center">
                                    <input :id="'category_' + category.id" type="checkbox" :value="category.id" v-model="form.categories" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label :for="'category_' + category.id" class="ml-2 block text-sm text-gray-900">{{ category.name }}</label>
                                </div>
                            </div>
                            <p v-if="form.errors.categories" class="mt-1 text-sm text-red-600">{{ form.errors.categories }}</p>
                        </div>

                        <!-- Poster Image -->
                        <div class="mb-6">
                            <label for="poster_image" class="block text-sm font-medium text-gray-700">Poster Image</label>
                            <input type="file" id="poster_image" @change="onFileChange" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" :class="{ 'border-red-500': form.errors.poster_image }">
                            <p v-if="form.errors.poster_image" class="mt-1 text-sm text-red-600">{{ form.errors.poster_image }}</p>
                            <div v-if="posterPreview" class="mt-4">
                                <img :src="posterPreview" class="h-40 w-auto rounded" alt="Poster Preview">
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-4">
                            <Link :href="route('admin.movies.index')" class="text-sm text-gray-600 hover:text-gray-900">
                                Cancel
                            </Link>
                            <button type="submit" :disabled="form.processing" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" :class="{ 'opacity-50': form.processing }">
                                Create Movie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    categories: Array, // All available categories from backend
});

const form = useForm({
    title: '',
    titleEng: '',
    description: '',
    release_date: '',
    duration: null,
    age_rating: '',
    director: '',
    cast: '',
    trailerUrl: '',
    categories: [], // Selected category IDs
    poster_image: null, // File object for poster
});

const availableCategories = ref(props.categories);
const posterPreview = ref(null);

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.poster_image = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            posterPreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        form.poster_image = null;
        posterPreview.value = null;
    }
};

const submit = () => {
    // Inertia's useForm handles multipart/form-data automatically when a File object is present.
    form.post(route('admin.movies.store'), {
        // onFinish: () => form.reset(), // Consider resetting only specific fields or not at all
    });
};
</script>
