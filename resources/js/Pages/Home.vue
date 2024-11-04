<script setup>
import { ref } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Slider from "@/Components/Slider.vue";
import TopMovie from "@/Components/TopMovie.vue";
import MovieCard from '@/Components/MovieCard.vue';
import Badge from "@/Components/Badge.vue";
import { Head } from "@inertiajs/vue3";

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
    rating: "PERE"
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
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ],
    title: "Kollide Kompanii",
    titleEng: "Monster's INC.",
    image: "https://lumiere-a.akamaihd.net/v1/images/p_monstersinc_19751_55afa07a.jpeg?region=0%2C0%2C540%2C810",
    rating: "PERE"
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
  },
];

const upcomingMovies = [
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ],
    title: "Transformerid: Üks",
    titleEng: "Transformers One",
    image: "https://resizing.flixster.com/Nf9rlbQUjzuMQ-vXdRGMScWkcs8=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzLzU4MDZhYjI1LTFiNTQtNDc0Ni04OTI2LWI0Nzc4OWJiNDYxYy5qcGc=",
    rating: "14+",
    starting: "22.10.2024"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Märul" },
    ],
    title: "Deadpool & Wolverine",
    titleEng: "Deadpool & Wolverine",
    image: "https://lumiere-a.akamaihd.net/v1/images/deadpool_wolverine_mobile_640x480_ad8020fd.png",
    rating: "14+",
    starting: "24.10.2024"
  },
  {
    categories: [
      { name: "Õudus" },
      { name: "Seiklus" },
      { name: "Märul" },
    ],
    title: "Tulnukas: Romulus",
    titleEng: "Alien: Romulus",
    image: "https://m.media-amazon.com/images/M/MV5BMDU0NjcwOGQtNjNjOS00NzQ3LWIwM2YtYWVmODZjMzQzN2ExXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg",
    rating: "16+",
    starting: "05.10.2024"
  },
  {
    categories: [
      { name: "Seiklus" },
      { name: "Märul" },
    ],
    title: "John Wick 4",
    titleEng: "John Wick 4",
    image: "https://m.media-amazon.com/images/I/81fk-N7tvbL._AC_UF894,1000_QL80_.jpg",
    rating: "14+",
    starting: "14.10.2024"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ],
    title: "Transformerid: Üks",
    titleEng: "Transformers One",
    image: "https://resizing.flixster.com/Nf9rlbQUjzuMQ-vXdRGMScWkcs8=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzLzU4MDZhYjI1LTFiNTQtNDc0Ni04OTI2LWI0Nzc4OWJiNDYxYy5qcGc=",
    rating: "14+",
    starting: "22.10.2024"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Märul" },
    ],
    title: "Deadpool & Wolverine",
    titleEng: "Deadpool & Wolverine",
    image: "https://lumiere-a.akamaihd.net/v1/images/deadpool_wolverine_mobile_640x480_ad8020fd.png",
    rating: "14+",
    starting: "24.10.2024"
  },
  {
    categories: [
      { name: "Õudukas" },
      { name: "Seiklus" },
      { name: "Märul" },
    ],
    title: "Tulnukas: Romulus",
    titleEng: "Alien: Romulus",
    image: "https://m.media-amazon.com/images/M/MV5BMDU0NjcwOGQtNjNjOS00NzQ3LWIwM2YtYWVmODZjMzQzN2ExXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg",
    rating: "16+",
    starting: "05.10.2024"
  },
  {
    categories: [
      { name: "Seiklus" },
      { name: "Märul" },
    ],
    title: "John Wick 4",
    titleEng: "John Wick 4",
    image: "https://m.media-amazon.com/images/I/81fk-N7tvbL._AC_UF894,1000_QL80_.jpg",
    rating: "14+",
    starting: "14.10.2024"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ],
    title: "Transformerid: Üks",
    titleEng: "Transformers One",
    image: "https://resizing.flixster.com/Nf9rlbQUjzuMQ-vXdRGMScWkcs8=/ems.cHJkLWVtcy1hc3NldHMvbW92aWVzLzU4MDZhYjI1LTFiNTQtNDc0Ni04OTI2LWI0Nzc4OWJiNDYxYy5qcGc=",
    rating: "14+",
    starting: "22.10.2024"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Märul" },
    ],
    title: "Deadpool & Wolverine",
    titleEng: "Deadpool & Wolverine",
    image: "https://lumiere-a.akamaihd.net/v1/images/deadpool_wolverine_mobile_640x480_ad8020fd.png",
    rating: "14+",
    starting: "24.10.2024"
  },
  {
    categories: [
      { name: "Õudukas" },
      { name: "Seiklus" },
      { name: "Märul" },
    ],
    title: "Tulnukas: Romulus",
    titleEng: "Alien: Romulus",
    image: "https://m.media-amazon.com/images/M/MV5BMDU0NjcwOGQtNjNjOS00NzQ3LWIwM2YtYWVmODZjMzQzN2ExXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg",
    rating: "16+",
    starting: "05.10.2024"
  },
  {
    categories: [
      { name: "Seiklus" },
      { name: "Märul" },
    ],
    title: "John Wick 4",
    titleEng: "John Wick 4",
    image: "https://m.media-amazon.com/images/I/81fk-N7tvbL._AC_UF894,1000_QL80_.jpg",
    rating: "14+",
    starting: "14.10.2024"
  },
];
</script>

<template>

  <Head title="Kodu" />

  <GuestLayout>
    <div class="flex flex-col gap-[60px]">

      <!-- Top Movie -->
      <TopMovie
        image="https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg"
        engTitle="Monsters, INC." title="Kollide Kompanii">
        <template #badges>
          <Badge type="solid">Komöödia</Badge>
          <Badge type="solid">Seiklus</Badge>
          <Badge type="solid">Animatsioon</Badge>
        </template>

        <template #description>
          Animeeritud film mis avastab Monstropolise maailma, kus
          koletised toodavad linna energiat hirmutades lapsi
          öösel.
        </template>
      </TopMovie>

      <!-- Top Movies -->
      <div class="flex flex-col gap-[15px]">
        <p class="text-brand-white text-main1">{{ __('home.top') }}</p>
        <Slider :length="topMovies.length">
            <MovieCard v-for="i in topMovies" :image="i.image" :title="i.title" :titleEng="i.titleEng" href="#">
              <template #imageBadges>
                <Badge>{{ i.rating }}</Badge>
              </template>

              <template #badges>
                <Badge type="solid" v-for="cat in i.categories">{{ cat.name }}</Badge>
              </template>
            </MovieCard>
        </Slider>
      </div>

      <!-- Current Movies -->
      <div class="flex flex-col gap-[15px]">
        <p class="text-brand-white text-main1">{{ __('home.current') }}</p>
        <Slider :length="topMovies.length">
            <MovieCard v-for="i in topMovies" :image="i.image" :title="i.title" :titleEng="i.titleEng"
              :starting="i.starting" href="#">
              <template #imageBadges>
                <Badge>{{ i.rating }}</Badge>
              </template>

              <template #badges>
                <Badge type="solid" v-for="cat in i.categories">{{ cat.name }}</Badge>
              </template>
            </MovieCard>
        </Slider>
      </div>

      <!-- Upcoming Movies -->
      <div class="flex flex-col gap-[15px]">
        <p class="text-brand-white text-main1">{{ __('home.upcoming') }}</p>
        <Slider :length="upcomingMovies.length">
            <MovieCard v-for="i in upcomingMovies" :image="i.image" :title="i.title" :titleEng="i.titleEng"
              :starting="i.starting" href="#">
              <template #imageBadges>
                <Badge>{{ i.rating }}</Badge>
              </template>

              <template #badges>
                <Badge type="solid" v-for="cat in i.categories">{{ cat.name }}</Badge>
              </template>
            </MovieCard>
        </Slider>
      </div>

    </div>
  </GuestLayout>
</template>
