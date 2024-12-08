<template>
    <AdminLayout>
        <div class="form-container">
            <h2>Edit Movie</h2>
            <form @submit.prevent="updateMovie">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                        type="text"
                        v-model="form.title"
                        class="form-control"
                        id="title"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="titleEng">English Title</label>
                    <input
                        type="text"
                        v-model="form.titleEng"
                        class="form-control"
                        id="titleEng"
                        required
                    />
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                        v-model="form.description"
                        class="form-control"
                        id="description"
                    ></textarea>
                </div>
                <div class="form-group">
                    <label for="length">Length</label>
                    <input
                        type="text"
                        v-model="form.length"
                        class="form-control"
                        id="length"
                    />
                </div>
                <div class="form-group">
                    <label for="cast">Cast (comma-separated)</label>
                    <input
                        type="text"
                        v-model="form.cast"
                        class="form-control"
                        id="cast"
                    />
                </div>
                <div class="form-group">
                    <label for="director">Director</label>
                    <input
                        type="text"
                        v-model="form.director"
                        class="form-control"
                        id="director"
                    />
                </div>
                <div class="form-group">
                    <label for="age_rating">Age Rating</label>
                    <input
                        type="text"
                        v-model="form.age_rating"
                        class="form-control"
                        id="age_rating"
                    />
                </div>
                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input
                        type="date"
                        v-model="form.release_date"
                        class="form-control"
                        id="release_date"
                    />
                </div>
                <div class="form-group">
                    <label for="trailer">Trailer Link</label>
                    <input
                        type="url"
                        v-model="form.trailer"
                        class="form-control"
                        id="trailer"
                    />
                </div>
                <button type="submit" class="btn btn-primary">Update Movie</button>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const { props } = usePage();
const form = ref({
    title: props.movie.title,
    titleEng: props.movie.titleEng,
    description: props.movie.description,
    length: props.movie.length,
    cast: JSON.stringify(props.movie.cast),
    director: props.movie.director,
    age_rating: props.movie.age_rating,
    release_date: props.movie.release_date,
    trailer: props.movie.trailer,
});

const updateMovie = () => {
    router.put(`/admin/movies/${props.movie.id}`, form.value);
};
</script>

<style scoped>
.form-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}
</style>
