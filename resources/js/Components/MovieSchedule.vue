<script setup>
import { ref, computed } from "vue";

import { SquarePlay, ArrowRight } from "lucide-vue-next";
import { router } from "@inertiajs/vue3";

import Button from "./Button.vue";
import VideoModal from "./VideoModal.vue";

const props = defineProps({
    image: String,
    title: String,
    titleEng: String,
    href: String,
    ticketHref: String,
    trailerHref: String,
    startingTime: String,
    cinema: String,
    cinemaRoom: String,
    freeSeats: Number,
    subtitles: String,
    language: String,
    videoUrl: String,
});

const videoModalOpen = ref(false);
const toggleVideoModal = () => {
    videoModalOpen.value = !videoModalOpen.value;
};

const htmlLang = document.querySelector("html").getAttribute("lang");
</script>

<template>
    <div class="flex flex-row w-full h-min">
        <!--Image with badge-->
        <div class="flex justify-end align-end drop-shadow-lg">
            <img
                class="rounded-l-[10px] w-full h-[300px] object-cover"
                :src="props.image"
                alt="Movie Poster"
            />
            <span class="flex gap-[5px] absolute right-[5px] bottom-[5px]">
                <slot name="imageBadges"></slot>
            </span>
        </div>

        <!--Schedule info and stuff-->
        <div
            :class="[
                'flex flex-row gap-[35px] min-h-full w-full overflow-hidden bg-brand-975 rounded-r-[10px] p-[35px]',
            ]"
        >
            <!--Schedule info-->
            <div
                class="flex flex-col h-full w-full max-w-[200px] justify-between gap-[35px]"
            >
                <p
                    class="text-brand-white text-main2 font-semibold"
                    v-html="props.startingTime"
                ></p>
                <div class="flex flex-col gap-[10px]">
                    <p
                        class="text-brand-white text-title1"
                        v-html="props.cinema"
                    ></p>
                    <p
                        class="text-brand-white/50 text-subtitle"
                        v-html="props.cinemaRoom"
                    ></p>
                </div>
                <Button
                    class="flex font-semibold justify-center gap-2 !w-full"
                    @click="toggleVideoModal"
                >
                    <SquarePlay class="w-4 h-4" />
                    {{ __("movieSchedule.trailer") }}
                </Button>
                <VideoModal
                    :videoUrl="props.videoUrl"
                    v-model:isOpen="videoModalOpen"
                    :title="`${props.title} Trailer`"
                >
                </VideoModal>
            </div>

            <!--Title and stuff-->
            <div class="flex flex-col w-full h-full justify-between gap-[35px]">
                <!--Title and buttons-->
                <div
                    class="flex flex-row h-full justify-between items-center gap-[35px]"
                >
                    <!--Title-->
                    <div
                        class="flex flex-col h-full w-full justify-between gap-[5px]"
                    >
                        <div class="flex flex-col gap-[15px]">
                            <a
                                :href="props.href"
                                class="text-brand-white text-main1 font-medium underline hover:text-brand-400"
                                v-html="
                                    htmlLang === 'et'
                                        ? props.title
                                        : props.titleEng
                                "
                            >
                            </a>
                            <p
                                v-if="htmlLang === 'et'"
                                class="text-brand-white/50 text-title1 group-hover:text-brand-400/50"
                                v-html="props.titleEng"
                            ></p>
                        </div>
                        <!--Badges-->
                        <div class="flex gap-[10px] pt-[5px] flex-wrap">
                            <slot name="badges"></slot>
                        </div>
                    </div>

                    <!--Buttons-->
                    <div class="flex gap-[15px] h-full z-10">
                        <Button
                            color="brand-900"
                            class="gap-2 font-semibold group/btn"
                            @click="router.visit(href)"
                        >
                            {{ __("movieSchedule.schedule") }}
                            <ArrowRight
                                class="w-4 h-4 text-brand-white group-hover/btn:translate-x-1 ease-out transition duration-300"
                            />
                        </Button>
                        <Button
                            class="gap-2 font-semibold group/btn"
                            @click="router.visit(ticketHref)"
                        >
                            {{ __("movieSchedule.buy") }}
                            <ArrowRight
                                class="w-4 h-4 text-brand-white group-hover/btn:translate-x-1 ease-out transition duration-300"
                            />
                        </Button>
                    </div>
                </div>

                <!--Other info-->
                <div
                    class="flex flex-row w-full h-min items-center justify-between pt-[15px]"
                >
                    <span class="flex flex-col gap-1 w-[20%]">
                        <p class="text-brand-white/50 text-subtitle">
                            {{ __("movieSchedule.free_seats") }}
                        </p>
                        <p
                            class="text-brand-white text-title1"
                            v-html="props.freeSeats"
                        ></p>
                    </span>
                    <span class="flex flex-col gap-1 w-[20%]">
                        <p class="text-brand-white/50 text-subtitle">
                            {{ __("movieSchedule.language") }}
                        </p>
                        <p
                            class="text-brand-white text-title1"
                            v-html="props.language"
                        ></p>
                    </span>
                    <span class="flex flex-col gap-1 w-[20%]">
                        <p class="text-brand-white/50 text-subtitle">
                            {{ __("movieSchedule.subtitles") }}
                        </p>
                        <p
                            class="text-brand-white text-title1"
                            v-html="props.subtitles"
                        ></p>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
