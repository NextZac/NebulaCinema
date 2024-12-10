<script setup>

import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

import Badge from './Badge.vue';
import Button from './Button.vue';
import { ArrowRight, SquarePlay } from 'lucide-vue-next';

import VideoModal from './VideoModal.vue';

const videoModalOpen = ref(false);

const toggleVideoModal = () => {
    videoModalOpen.value = !videoModalOpen.value;
}

const props = defineProps({
    image: String,
    title: String,
    titleEng: String,
    href: String,
    starting: String,
    videoUrl: String,
})

</script>

<template>
    <div
        class="flex flex-col w-min h-min min-w-[365px] transition-all duration-100">
        <!--Image with badge-->
        <div class="flex justify-end align-end drop-shadow-lg">
            <img class="rounded-t-[10px] w-full h-[250px] object-cover" :src="props.image" alt="Movie Poster">
            <span v-if="props.starting" class="flex absolute left-[5px] top-[5px]">
                <Badge type="bordered">Linastused alates {{ props.starting }}</Badge>
            </span>
            <span class="flex gap-[5px] absolute right-[5px] bottom-[5px]">
                <slot name="imageBadges"></slot>
            </span>
        </div>

        <!--Title-->
        <div :class="['flex flex-col gap-[5px] h-min overflow-hidden bg-brand-975 rounded-b-[10px] p-4 min-h-[250px]']">
            <span class="flex flex-col gap-[5px] h-min overflow-hidden">
                <p class="text-brand-white text-title2" v-html="props.title"></p>
                <p class="text-brand-white/50 text-body" v-html="props.titleEng"></p>
            </span>

            <!--Badges-->
            <div class="flex gap-[10px] pt-[5px] flex-wrap">
                <slot name="badges"></slot>
            </div>

            <div class="flex gap-2 h-full z-10 mt-auto">
                <Button color="brand-900" class="flex font-semibold justify-center gap-2 !w-full" @click="toggleVideoModal">
                    <SquarePlay class="w-4 h-4" />
                    {{ __('movieSchedule.trailer') }}
                </Button>
                <VideoModal :videoUrl="props.videoUrl" v-model:isOpen="videoModalOpen" :title="`${props.title} Trailer`">
                </VideoModal>
                <Button class="gap-2 font-semibold group/btn" @click="router.visit(props.href)">
                    {{ __("topMovie.learn_more") }}
                    <ArrowRight
                        class="w-4 h-4 text-brand-white group-hover/btn:translate-x-1 ease-out transition duration-300" />
                </Button>
            </div>
        </div>
    </div>
</template>