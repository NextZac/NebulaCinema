<script setup>
import { ref, onMounted, watchEffect } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Alert from "@/Components/Alert.vue";
import MovieCard2 from "@/Components/MovieCard2.vue";
import MovieCard2Skeleton from "@/Components/MovieCard2Skeleton.vue";
import Badge from "@/Components/Badge.vue";
import MovieFilter from "@/Components/MovieFilter.vue";

import { AlertCircle } from "lucide-vue-next";

const movie_session = ref([]);

const isLoading = ref(false);
const error = ref(null);

const selectedCategories = ref([]);
const selectedShowtime = ref("all");

const htmlLang = document.documentElement.lang;

const handleCategoriesUpdate = (categories) => {
    selectedCategories.value = categories;
};

const handleShowtimeUpdate = (showtime) => {
    selectedShowtime.value = showtime;
};

const fetchMovies = () => {
    const params = {
        showtime: selectedShowtime.value,
        categories: Array.from(selectedCategories.value),
    };

    isLoading.value = true;
    error.value = null;

    try {
        axios
            .get(route("Movie.update"), {
                params,
            })
            .then((response) => {
                console.log(response.data);
                movie_session.value = response.data;
                isLoading.value = false;
            })
            .catch((error) => {
                console.error(error);
            });
    } catch (error) {
        error.value = error;
        isLoading.value = false;
        movie_session.value = [];
        console.error("Failed to fetch movies:", error);
    }
};

onMounted(() => {
    const today = new Date();
});

watchEffect(() => {
    fetchMovies();
    console.log(selectedShowtime.value);
});
</script>

<template>
    <Head title="Filmid" />

    <GuestLayout>
        <div class="gap-[60px] w-full flex flex-col">
            <MovieFilter
                @update:showtime="handleShowtimeUpdate"
                @update:genres="handleCategoriesUpdate"
            />

            <div class="flex flex flex-wrap justify-between content-start gap-[30px]">
                <template v-if="isLoading">
                    <!-- Multiple skeleton loaders -->
                    <MovieCard2Skeleton v-for="n in 12" :key="n" />
                </template>

                <template v-else-if="movie_session.length > 0 && !isLoading">
                    <MovieCard2
                        v-for="(i, index) in movie_session"
                        v-bind="i"
                        :key="i.title + index"
                        :image="i.image"
                        :title="i.title"
                        :titleEng="i.titleEng"
                        :href="route('Movie', i.id)"
                        :videoUrl="i.trailer"
                        :starting="new Date(i.release_date) >= new Date() ? i.release_date : null"
                    >
                        <template #imageBadges>
                            <Badge>{{ i.age_rating }}</Badge>
                        </template>

                        <template #badges>
                            <Badge v-for="cat in i.categories" :key="cat.name">
                                {{ cat.name }}
                            </Badge>
                        </template>
                    </MovieCard2>
                </template>

                <Alert v-else type="error" class="justify-center items-center">
                    <template #icon>
                        <AlertCircle class="size-8 text-brand-error" />
                    </template>

                    <template #description>
                        <span class="text-title1">
                            {{ error?.message || __("movie.none_found") }}
                        </span>
                    </template>
                </Alert>
            </div>
        </div>
    </GuestLayout>
</template>
