<script setup>
import { ref } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Slider from "@/Components/Slider.vue";
import TopMovie from "@/Components/TopMovie.vue";
import MovieCard from '@/Components/MovieCard.vue';
import Badge from "@/Components/Badge.vue";
import { Head } from "@inertiajs/vue3";

const movies = [
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Kollide Kompanii",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Monster's INC."
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
  },
  {
    categories: [
      { name: "Komöödia" },
      { name: "Seiklus" },
      { name: "Animatsioon" },
    ], title: "Another Movie",
    image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
    titleEng: "Another Movie English"
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
        <Slider :length="movies.length">
          <template #cards>
            <MovieCard v-for="i in movies" :image="i.image" :title="i.title" :titleEng="i.titleEng" href="#">
              <template #imageBadges>
                <Badge type="solid">3D</Badge>
                <Badge>12+</Badge>
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
        <Slider :length="movies.length">
          <template #cards>
            <MovieCard v-for="i in movies" :image="i.image" :title="i.title" :titleEng="i.titleEng" href="#">
              <template #imageBadges>
                <Badge type="solid">3D</Badge>
                <Badge>12+</Badge>
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
        <Slider :length="movies.length">
          <template #cards>
            <MovieCard v-for="i in movies" :image="i.image" :title="i.title" :titleEng="i.titleEng" href="#">
              <template #imageBadges>
                <Badge type="solid">3D</Badge>
                <Badge>12+</Badge>
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
