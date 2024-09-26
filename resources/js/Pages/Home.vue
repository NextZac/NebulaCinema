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
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    rating: "PERE"
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
];
</script>

<template>

  <Head title="Kodu" />

  <GuestLayout>
    <div class="py-2 flex flex-col gap-[60px]">

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
        <p class="text-brand-white text-main1">Top Filmid</p>
        <Slider :length="topMovies.length">
          <template #cards>
            <MovieCard v-for="i in topMovies" :image="i.image" :title="i.title" :titleEng="i.titleEng" href="#">
              <template #imageBadges>
                <Badge>{{ i.rating }}</Badge>
              </template>

              <template #badges>
                <Badge type="solid" v-for="cat in i.categories">{{ cat.name }}</Badge>
              </template>
            </MovieCard>
          </template>
        </Slider>
      </div>

      <!-- Current Movies -->
      <div class="flex flex-col gap-[15px]">
        <p class="text-brand-white text-main1">Hetkel Kinos</p>
        <Slider :length="topMovies.length">
          <template #cards>
            <MovieCard v-for="i in topMovies" :image="i.image" :title="i.title" :titleEng="i.titleEng"
              :starting="i.starting" href="#">
              <template #imageBadges>
                <Badge>{{ i.rating }}</Badge>
              </template>

              <template #badges>
                <Badge type="solid" v-for="cat in i.categories">{{ cat.name }}</Badge>
              </template>
            </MovieCard>
          </template>
        </Slider>
      </div>

      <!-- Upcoming Movies -->
      <div class="flex flex-col gap-[15px]">
        <p class="text-brand-white text-main1">Varsti Kinos</p>
        <Slider :length="upcomingMovies.length">
          <template #cards>
            <MovieCard v-for="i in upcomingMovies" :image="i.image" :title="i.title" :titleEng="i.titleEng" href="#">
              <template #imageBadges>
                <Badge>{{ i.rating }}</Badge>
              </template>

              <template #badges>
                <Badge type="solid" v-for="cat in i.categories">{{ cat.name }}</Badge>
              </template>
            </MovieCard>
          </template>
        </Slider>
      </div>

    </div>
  </GuestLayout>
</template>
