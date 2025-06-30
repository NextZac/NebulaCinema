<template>
    <AdminLayout title="Manage Movies">
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-semibold text-gray-700">Movies</h1>
                        <Link :href="route('admin.movies.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Movie
                        </Link>
                    </div>

                    <div v-if="$page.props.flash && $page.props.flash.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ $page.props.flash.success }}</span>
                    </div>
                    <div v-if="$page.props.flash && $page.props.flash.error" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ $page.props.flash.error }}</span>
                    </div>

                    <div class="overflow-x-auto bg-white rounded shadow">
                        <table class="w-full whitespace-nowrap">
                            <thead class="bg-gray-50">
                                <tr class="text-left font-bold">
                                    <th class="px-6 pt-6 pb-4">Poster</th>
                                    <th class="px-6 pt-6 pb-4">Title</th>
                                    <th class="px-6 pt-6 pb-4">Categories</th>
                                    <th class="px-6 pt-6 pb-4">Release Date</th>
                                    <th class="px-6 pt-6 pb-4">Duration</th>
                                    <th class="px-6 pt-6 pb-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="movie in movies.data" :key="movie.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="border-t px-6 py-4">
                                        <img v-if="movie.image_path" :src="movie.image_path" :alt="movie.title" class="h-16 w-auto rounded">
                                        <span v-else class="text-gray-400">No Poster</span>
                                    </td>
                                    <td class="border-t px-6 py-4">
                                        <div>{{ movie.title }}</div>
                                        <div v-if="movie.titleEng" class="text-xs text-gray-500">{{ movie.titleEng }}</div>
                                    </td>
                                    <td class="border-t px-6 py-4">
                                        <span v-for="category in movie.categories" :key="category.id" class="bg-gray-200 text-gray-700 px-2 py-1 text-xs rounded-full mr-1 mb-1 inline-block">
                                            {{ category.name }}
                                        </span>
                                         <span v-if="!movie.categories || movie.categories.length === 0" class="text-xs text-gray-500">None</span>
                                    </td>
                                    <td class="border-t px-6 py-4">{{ formatDate(movie.release_date) }}</td>
                                    <td class="border-t px-6 py-4">{{ movie.duration }} mins</td>
                                    <td class="border-t px-6 py-4 text-right">
                                        <Link :href="route('admin.movies.edit', movie.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">Edit</Link>
                                        <button @click="confirmDelete(movie)" class="text-red-600 hover:text-red-900">Delete</button>
                                    </td>
                                </tr>
                                <tr v-if="movies.data.length === 0">
                                    <td class="border-t px-6 py-4" colspan="6">No movies found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div v-if="movies.links.length > 3" class="mt-6">
                        <div class="flex flex-wrap -mb-1">
                            <template v-for="(link, key) in movies.links" :key="key">
                                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label" />
                                <Link v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active }" :href="link.url" v-html="link.label" />
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <Modal :show="showConfirmDeleteModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete this movie?
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    "{{ movieToDelete ? movieToDelete.title : '' }}" will be permanently deleted. This action cannot be undone.
                </p>
                <div class="mt-6 flex justify-end">
                    <button @click="closeModal" class="mr-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                    <button @click="deleteMovie" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete Movie
                    </button>
                </div>
            </div>
        </Modal>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import Modal from '@/Components/Modal.vue'; // Assuming Modal component exists

const props = defineProps({
    movies: Object, // Paginated movies from controller
});

const showConfirmDeleteModal = ref(false);
const movieToDelete = ref(null);

const confirmDelete = (movie) => {
    movieToDelete.value = movie;
    showConfirmDeleteModal.value = true;
};

const closeModal = () => {
    showConfirmDeleteModal.value = false;
    movieToDelete.value = null;
};

const deleteMovie = () => {
    if (movieToDelete.value) {
        router.delete(route('admin.movies.destroy', movieToDelete.value.id), {
            onFinish: () => closeModal(),
        });
    }
};

const formatDate = (dateString) => {
    if (!dateString) return 'N/A';
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString(undefined, options);
};

</script>

<style>
/* Basic styling for table elements, can be replaced/augmented by Tailwind */
</style>
