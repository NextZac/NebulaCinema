<script setup>
import { ref, computed, onMounted } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Alert from '@/Components/Alert.vue';
import MovieSchedule from '@/Components/MovieSchedule.vue';
import Badge from '@/Components/Badge.vue';
import ScheduleFilter from '@/Components/ScheduleFilter.vue';

import { AlertCircle } from 'lucide-vue-next';

const props = defineProps({
    movie_session: Array,
});

/*
const topMovies = [
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ],
        title: "Kollide Kompanii",
        titleEng: "Monster's INC.",
        image: "https://lumiere-a.akamaihd.net/v1/images/p_monstersinc_19751_55afa07a.jpeg?region=0%2C0%2C540%2C810",
        rating: "PERE",
        format: "3D",
        startingTime: new Date(new Date().setHours(18, 0, 0, 0)),
        cinema: "Nebula Ülemiste",
        cinemaRoom: "Room 1",
        freeSeats: "5",
        trailer: "https://www.youtube.com/embed/CGbgaHoapFM",
        subtitles: "Eesti",
        language: "Eesti",
    },
    {
        categories: [
            { name: "Õudus" },
            { name: "Seiklus" },
            { name: "Märul" },
            { name: "Ulme & Fantaasia" }
        ],
        title: "Viimased meie hulgas",
        titleEng: "The Last of Us",
        image: "https://m.media-amazon.com/images/M/MV5BY2JiNjU3NWYtMTRlYS00NzY3LWE2NDQtZGFkNWE2MDU4OTExXkEyXkFqcGc@._V1_.jpg",
        rating: "16+",
        format: "2D",
        startingTime: new Date(new Date().setHours(13, 0, 0, 0)),
        cinema: "Nebula Ülemiste",
        cinemaRoom: "Room 4",
        freeSeats: "69",
        trailer: "https://www.youtube.com/embed/uLtkt8BonwM",
        subtitles: "Eesti, Vene",
        language: "Inglise",
    },
    {
        categories: [
            { name: "Märul" },
            { name: "Seiklus" },
            { name: "Põnevus" },
        ],
        title: "Spiderman: Pole Koduteed",
        titleEng: "Spiderman: No Way Home",
        image: "https://resizing.flixster.com/8PNiwC2bpe9OecfYZSOVkvYC5vk=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzL2U5NGM0Y2Q1LTAyYTItNGFjNC1hNWZhLWMzYjJjOTdjMTFhOS5qcGc=",
        rating: "14+",
        format: "3D",
        startingTime: new Date(new Date().setHours(16, 40, 0, 0)),
        cinema: "Nebula Tasku",
        cinemaRoom: "Room 2",
        freeSeats: "40",
        trailer: "https://www.youtube.com/embed/JfVOs4VSpmA",
        subtitles: "Eesti",
        language: "Eesti",
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Põnevus" },
        ],
        title: "Nüüd Sa Näed Mind 2",
        titleEng: "Now You See Me 2",
        image: "https://m.media-amazon.com/images/M/MV5BOTVjNTA0ZWEtNzU2Ny00Njg1LWE1MmEtZTUyZGQzYTVlY2Q5XkEyXkFqcGc@._V1_.jpg",
        rating: "12+",
        format: "2D",
        startingTime: new Date(new Date(new Date().setHours(18, 0, 0, 0)).setDate(new Date().getDate() + 1)),
        cinema: "Nebula Viru",
        cinemaRoom: "Room 1",
        freeSeats: "32",
        trailer: "https://www.youtube.com/embed/4I8rVcSQbic",
        subtitles: "Eesti, Vene",
        language: "Eesti",
    },
]; */

const movie_session = ref(props.movie_session);

console.log(movie_session.value);

const selectedDate = ref('');
const selectedCinema = ref('');
const selectedGenres = ref([]);
const selectedFilters = ref({
    language: new Set(),
    timeHours: '', // Default hours
    timeMinutes: '', // Default minutes
    subtitles: new Set(),
    format: new Set(),
    ageRating: new Set()
});

const htmlLang = document.documentElement.lang;

const handleDateUpdate = (date) => {
    selectedDate.value = date;
    fetchMovies();
};

const handleCinemaUpdate = (cinema) => {
    selectedCinema.value = cinema;
    fetchMovies();
};

const handleGenresUpdate = (genres) => {
    selectedGenres.value = genres;
    fetchMovies();
};

const handleFiltersUpdate = (filters) => {
    console.log("First: ",selectedFilters.value.timeHours, selectedFilters.value.timeMinutes);

    selectedFilters.value = {
        ...selectedFilters.value, // Keep the existing values
        ...filters, // Override with new filter values
        timeHours: filters.timeHours !== undefined ? filters.timeHours : selectedFilters.value.timeHours,
        timeMinutes: filters.timeMinutes !== undefined ? filters.timeMinutes : selectedFilters.value.timeMinutes,
    };
    console.log("Second", selectedFilters.value.timeHours, selectedFilters.value.timeMinutes);
    fetchMovies();
};

const handleTimeUpdate = (value, type) => {
    if (type === 'hours') {
        selectedFilters.value.timeHours = value;
    } else {
        selectedFilters.value.timeMinutes = value;
    }
    fetchMovies();
};

onMounted(() => {
    const today = new Date();
    selectedDate.value = today.toISOString().split('T')[0];
    fetchMovies();
});

const fetchMovies = () => {

    axios.get(route('Schedule.update'), {
        params: {
            date: selectedDate.value,
            cinema: selectedCinema.value,
            genres: Array.from(selectedGenres.value),
            language: Array.from(selectedFilters.value.language),
            subtitles: Array.from(selectedFilters.value.subtitles),
            format: Array.from(selectedFilters.value.format),
            age_rating: Array.from(selectedFilters.value.ageRating),
            timeHours: selectedFilters.value.timeHours,
            timeMinutes: selectedFilters.value.timeMinutes
        }
    }).then(response => {
        console.log("first", movie_session.value);
        movie_session.value = response.data;
        console.log("second", movie_session);
    }).catch(error => {
        console.error(error);
    });
};

</script>

<template>

    <Head title="Kinokava" />

    <GuestLayout>

        <div class="gap-[60px] w-full flex flex-col">
            <Alert type="warning" class="justify-center items-center">
                <template #description>
                    {{ __('schedule.info') }} <span class="font-medium">{{ __('schedule.info_bold') }}</span>
                </template>
            </Alert>

            <ScheduleFilter @update:date="handleDateUpdate" @update:cinema="handleCinemaUpdate"
                @update:genres="handleGenresUpdate" @update:filters="handleFiltersUpdate"
                @update:timeHours="(value) => handleTimeUpdate(value, 'hours')" @update:timeMinutes="(value) => handleTimeUpdate(value, 'minutes')" />

            <div class="flex flex-col gap-[30px]">
                <MovieSchedule v-for="i in movie_session" v-bind="i" :key="i.movie.title" :image="i.image"
                    :title="i.movie.title" :titleEng="i.movie.titleEng" href="#" :startingTime="i.start_time"
                    :cinema="i.cinema" :cinemaRoom="i.room" :freeSeats="i.seats" :subtitles="i.subtitles"
                    :language="i.language" :videoUrl="i.trailer">
                    <template #imageBadges>
                        <Badge type="solid"> {{ i.format }}</Badge>
                        <Badge> {{ i.movie.age_rating }} </Badge>
                    </template>

                    <template #badges>
                        <Badge v-for="cat in i.categories">{{ cat.name }} </Badge>
                    </template>
                </MovieSchedule>
                <Alert v-if="movie_session.length === 0" type="error" class="justify-center items-center">
                    <template #icon>
                        <AlertCircle class="size-8 text-brand-error" />
                    </template>

                    <template #description>
                        <span class="text-title1">No movies found with the selected filters.</span>
                    </template>
                </Alert>
            </div>
        </div>
    </GuestLayout>
</template>