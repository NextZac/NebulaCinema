<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Alert from '@/Components/Alert.vue';
import MovieSchedule from '@/Components/MovieSchedule.vue';
import Badge from '@/Components/Badge.vue';

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
        startingTime: "18:00",
        cinema: "Nebula Ülemiste",
        cinemaRoom: "Room 1",
        freeSeats: "5",
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
        startingTime: "13:00",
        cinema: "Nebula Ülemiste",
        cinemaRoom: "Room 4",
        freeSeats: "69",
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
        startingTime: "16:40",
        cinema: "Nebula Tasku",
        cinemaRoom: "Room 2",
        freeSeats: "40",
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
        startingTime: "18:00",
        cinema: "Nebula Viru",
        cinemaRoom: "Room 1",
        freeSeats: "32",
    },
];

</script>

<template>

    <Head title="Kinokava" />

    <GuestLayout>
        
        <div class="gap-[60px] w-full flex flex-col">
            <Alert type="warning" class="justify-center items-center">
                <template #description>
                    Kinokava koostatakse ette üheks nädalaks, sama nädala reedest järgmise nädala neljapäevani. Uue
                    nädala kinokava avaldatakse hiljemalt <span class="font-medium">teisipäeva õhtuks.</span>
                </template>
            </Alert>

            <div class="flex flex-col gap-[30px]">
                <MovieSchedule v-for="i in topMovies" :image="i.image" :title="i.title" :titleEng="i.titleEng" href="#"
                    :startingTime="i.startingTime" :cinema="i.cinema" :cinemaRoom="i.cinemaRoom"
                    :freeSeats="i.freeSeats" subtitles="Eesti, Vene" language="Eesti">
                    <template #imageBadges>
                        <Badge type="solid"> {{ i.format }}</Badge>
                        <Badge> {{ i.rating }} </Badge>
                    </template>

                    <template #badges>
                        <Badge v-for="cat in i.categories">{{ cat.name }} </Badge>
                    </template>
                </MovieSchedule>
            </div>
        </div>
    </GuestLayout>
</template>