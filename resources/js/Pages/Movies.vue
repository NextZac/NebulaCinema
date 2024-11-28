<script setup>
import { ref, onMounted, watchEffect } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Alert from '@/Components/Alert.vue';
import MovieSchedule from '@/Components/MovieSchedule.vue';
import MovieScheduleSkeleton from '@/Components/MovieScheduleSkeleton.vue';
import Badge from '@/Components/Badge.vue';
import MovieFilter from '@/Components/MovieFilter.vue';

import { AlertCircle } from 'lucide-vue-next';

const movie_session = ref([]);

const isLoading = ref(false);
const error = ref(null);

const selectedCategories = ref([]);

const htmlLang = document.documentElement.lang;

const handleCategoriesUpdate = (categories) => {
    selectedCategories.value = categories;
};

/*
const fetchMovies = () => {
    const params = {
        date: selectedDate.value,
        cinema: selectedCinema.value,
        categories: Array.from(selectedCategories.value),
        language: Array.from(selectedFilters.value.language),
        subtitles: Array.from(selectedFilters.value.subtitles),
        format: Array.from(selectedFilters.value.format),
        age_rating: Array.from(selectedFilters.value.ageRating),
        timeHours: selectedFilters.value.timeHours,
        timeMinutes: selectedFilters.value.timeMinutes
    };

    isLoading.value = true;
    error.value = null;

    try {
        axios.get(route('Schedule.update'), {
            params
        }).then(response => {
            movie_session.value = response.data;
            isLoading.value = false;
        }).catch(error => {
            console.error(error);
        });
    } catch (error) {
        error.value = error;
        isLoading.value = false;
        movie_session.value = [];
        console.error('Failed to fetch movies:', error);
    }
}; */

onMounted(() => {
    const today = new Date();
});

watchEffect(() => {
    // fetchMovies();
});

</script>

<template>

    <Head title="Filmid" />

    <GuestLayout>

        <div class="gap-[60px] w-full flex flex-col">

            <MovieFilter @update:date="handleDateUpdate" @update:cinema="handleCinemaUpdate"
                @update:genres="handleCategoriesUpdate" @update:filters="handleFiltersUpdate"
                @update:timeHours="(value) => handleTimeUpdate(value, 'hours')"
                @update:timeMinutes="(value) => handleTimeUpdate(value, 'minutes')" />

            <div class="flex flex-col gap-[30px]">
                <template v-if="isLoading">
                    <!-- Multiple skeleton loaders -->
                    <MovieScheduleSkeleton v-for="n in 6" :key="n" />
                </template>

                <template v-else-if="movie_session.length > 0 && !isLoading">
                    <MovieSchedule v-for="(i, index) in movie_session" v-bind="i" :key="i.movie.title + index"
                        :image="i.image" :title="i.movie.title" :titleEng="i.movie.titleEng" href="#"
                        :startingTime="i.start_time" :cinema="convertCinemaNames(i.cinema)" :cinemaRoom='htmlLang === "et" ? `Saal ${i.room}` : `Hall ${i.room}`' :freeSeats="i.seats"
                        :subtitles="i.subtitles" :language="i.language" :videoUrl="i.movie.trailer">
                        <template #imageBadges>
                            <Badge type="solid">{{ i.format }}</Badge>
                            <Badge>{{ i.movie.age_rating }}</Badge>
                        </template>

                        <template #badges>
                            <Badge v-for="cat in i.categories" :key="cat.name">
                                {{ cat.name }}
                            </Badge>
                        </template>
                    </MovieSchedule>
                </template>

                <Alert v-else type="error" class="justify-center items-center">
                    <template #icon>
                        <AlertCircle class="size-8 text-brand-error" />
                    </template>

                    <template #description>
                        <span class="text-title1">
                            {{ error?.message || 'No movies found with the selected filters.' }}
                        </span>
                    </template>
                </Alert>
            </div>
        </div>
    </GuestLayout>
</template>