<script setup>
import { ref } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Slider from "@/Components/Slider.vue";
import TopMovie from "@/Components/TopMovie.vue";
import MovieCard from "@/Components/MovieCard.vue";
import Badge from "@/Components/Badge.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    topMovies: Array,
    upcomingMovies: Array,
});

</script>

<template>
    <Head title="Kodu" />

    <GuestLayout>
        <div class="flex flex-col gap-[60px]">
            <!-- Top Movie -->
            <TopMovie
                image="https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg"
                engTitle="Monsters, INC."
                title="Kollide Kompanii"
            >
                <template #badges>
                    <Badge type="solid">Komöödia</Badge>
                    <Badge type="solid">Seiklus</Badge>
                    <Badge type="solid">Animatsioon</Badge>
                </template>

                <template #description>
                    Animeeritud film mis avastab Monstropolise maailma, kus
                    koletised toodavad linna energiat hirmutades lapsi öösel.
                </template>
            </TopMovie>

            <!-- Top Movies -->
            <div class="flex flex-col gap-[15px]">
                <p class="text-brand-white text-main1">{{ __("home.top") }}</p>
                <Slider :length="topMovies.length">
                    <MovieCard
                        v-for="i in topMovies"
                        :image="i.image"
                        :title="i.title"
                        :titleEng="i.titleEng"
                        :href="route('Movie', i.id)"
                    >
                        <template #imageBadges>
                            <Badge>{{ i.rating }}</Badge>
                        </template>

                        <template #badges>
                            <Badge type="solid" v-for="cat in i.categories">{{
                                cat.name
                            }}</Badge>
                        </template>
                    </MovieCard>
                </Slider>
            </div>

            <!-- Current Movies -->
            <div class="flex flex-col gap-[15px]">
                <p class="text-brand-white text-main1">
                    {{ __("home.current") }}
                </p>
                <Slider :length="topMovies.length">
                    <MovieCard
                        v-for="i in topMovies"
                        :image="i.image"
                        :title="i.title"
                        :titleEng="i.titleEng"
                        :starting="i.starting"
                        :href="route('Movie', i.id)"
                    >
                        <template #imageBadges>
                            <Badge>{{ i.rating }}</Badge>
                        </template>

                        <template #badges>
                            <Badge type="solid" v-for="cat in i.categories">{{
                                cat.name
                            }}</Badge>
                        </template>
                    </MovieCard>
                </Slider>
            </div>

            <!-- Upcoming Movies -->
            <div class="flex flex-col gap-[15px]">
                <p class="text-brand-white text-main1">
                    {{ __("home.upcoming") }}
                </p>
                <Slider :length="upcomingMovies.length">
                    <MovieCard
                        v-for="i in upcomingMovies"
                        :image="i.image"
                        :title="i.title"
                        :titleEng="i.titleEng"
                        :starting="i.starting"
                        :href="route('Movie', i.id)"
                    >
                        <template #imageBadges>
                            <Badge>{{ i.rating }}</Badge>
                        </template>

                        <template #badges>
                            <Badge type="solid" v-for="cat in i.categories">{{
                                cat.name
                            }}</Badge>
                        </template>
                    </MovieCard>
                </Slider>
            </div>
        </div>
    </GuestLayout>
</template>
