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
            <TopMovie v-if="topMovies.length > 0"
                :image="topMovies[0].image"
                :engTitle="topMovies[0].titleEng"
                :title="topMovies[0].title"
            >
                <template #badges>
                    <Badge
                        v-for="category in topMovies[0].categories"
                        type="solid"
                        >{{ category.name }}</Badge
                    >
                </template>

                <template #description>
                    {{ topMovies[0].description }}
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
