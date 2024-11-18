<script setup>
import { ref, computed, onMounted } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Alert from '@/Components/Alert.vue';
import MovieSchedule from '@/Components/MovieSchedule.vue';
import Badge from '@/Components/Badge.vue';
import ScheduleFilter from '@/Components/ScheduleFilter.vue';

import { AlertCircle } from 'lucide-vue-next';

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
];

const selectedDate = ref('');
const selectedCinema = ref('');
const selectedGenres = ref([]);
const selectedFilters = ref({
    language: new Set(),
    time: new Set(),
    subtitles: new Set(),
    format: new Set(),
    ageRating: new Set()
});

const getTimeIndex = (time) => {
    const hours = time.getHours();
    const minutes = time.getMinutes();
    return Math.floor((hours * 60 + minutes) / 10);
};

const filteredMovies = computed(() => {
    return topMovies.filter(movie => {
        // Filter by cinema
        if (selectedCinema.value && selectedCinema.value !== 'Kõik kinod' && movie.cinema !== selectedCinema.value) return false;

        // Filter by genres
        if (selectedGenres.value.length > 0) {
            const movieGenres = movie.categories.map(cat => cat.name);
            if (!selectedGenres.value.some(genre => movieGenres.includes(genre))) return false;
        }

        // Filter by format
        if (selectedFilters.value.format.size > 0) {
            if (!selectedFilters.value.format.has(movie.format)) return false;
        }

        // Filter by language
        if (selectedFilters.value.language.size > 0) {
            if (!selectedFilters.value.language.has(movie.language)) return false;
        }

        // Filter by subtitles
        if (selectedFilters.value.subtitles.size > 0) {
            const movieSubtitles = movie.subtitles.split(', ');
            if (!Array.from(selectedFilters.value.subtitles).some(sub => movieSubtitles.includes(sub))) return false;
        }

        // Filter by age rating
        if (selectedFilters.value.ageRating.size > 0) {
            if (!selectedFilters.value.ageRating.has(movie.rating)) return false;
        }

        // Filter by date
        if (selectedDate.value) {
            if (movie.startingTime.getDate() !== new Date(selectedDate.value).getDate()) return false;
        }

        // Filter by time
        if (selectedFilters.value.time.size > 0) {
            if (!selectedFilters.value.time.has(movie.startingTime)) return false;
        }

        return true;
    });
});

const handleDateUpdate = (date, locale = 'et') => {
    const months = {
        jan: '01', feb: '02', mar: '03', apr: '04', may: '05', jun: '06',
        jul: '07', aug: '08', sep: '09', oct: '10', nov: '11', dec: '12'
    };

    // If the locale is 'et' (Estonian), handle the "19. nov" format
    if (locale === 'et') {
        const [day, monthName] = date.split('.').map(str => str.trim());
        const currentYear = new Date().getFullYear();
        const formattedDate = `${currentYear}-${months[monthName.toLowerCase()]}-${day.padStart(2, '0')}`;
        selectedDate.value = formattedDate;
    }
    // If the locale is 'en-US' (English US), handle the "MM/DD/YYYY" format
    else if (locale === 'en-US') {
        const [month, day, year] = date.split('/').map(str => str.trim());
        const formattedDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
        selectedDate.value = formattedDate;
    }
};

const handleCinemaUpdate = (cinema) => {
    selectedCinema.value = cinema;
};

const handleGenresUpdate = (genres) => {
    selectedGenres.value = genres;
};

const handleFiltersUpdate = (filters) => {
    selectedFilters.value = filters;
};

onMounted(() => {
    const today = new Date();
    selectedDate.value = today.toISOString().split('T')[0];
});

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
                @update:genres="handleGenresUpdate" @update:filters="handleFiltersUpdate" />

            <div class="flex flex-col gap-[30px]">
                <MovieSchedule v-for="i in filteredMovies" v-bind="i" :key="i.title" :image="i.image" :title="i.title"
                    :titleEng="i.titleEng" href="#"
                    :startingTime="i.startingTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: false })"
                    :cinema="i.cinema" :cinemaRoom="i.cinemaRoom" :freeSeats="i.freeSeats" :subtitles="i.subtitles"
                    :language="i.language" :style="`order: ${getTimeIndex(i.startingTime)};`" :videoUrl="i.trailer">
                    <template #imageBadges>
                        <Badge type="solid"> {{ i.format }}</Badge>
                        <Badge> {{ i.rating }} </Badge>
                    </template>

                    <template #badges>
                        <Badge v-for="cat in i.categories">{{ cat.name }} </Badge>
                    </template>
                </MovieSchedule>
                <Alert v-if="filteredMovies.length === 0" type="error" class="justify-center items-center">
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