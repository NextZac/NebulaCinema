<script setup>
import Button from './Button.vue';

import { ChevronRight } from 'lucide-vue-next';

const props = defineProps({
    image: String,
    title: String,
    engTitle: String,
    description: String,
    href: String,
});
</script>

<template>
    <div class="relative w-full h-[20vw] p-[10px] overflow-hidden group drop-shadow-lg">
        <!-- Gradient and Image Background -->
        <div :style="{
                background: `linear-gradient(98deg, rgba(23, 21, 50, 1) 0%, rgba(23, 21, 50, 1) 31.21%, rgba(0, 0, 0, 0) 56.26%), url(${image}) no-repeat`,
                backgroundSize: 'auto, 80%',
                backgroundPosition: 'right',
            }" class="absolute inset-0 w-full h-full rounded-[10px]"></div>

        <!-- Title Holder with text on the gradient side -->
        <div
            class="absolute flex flex-col gap-[30px] justify-center content-center h-full w-[30%] text-brand-white z-10 px-[30px] pb-[50px]">
            <span class="flex gap-[10px] pt-[5px]">
                <slot name="badges" />
            </span>
            <span class="flex flex-col gap-[30px] pt-2">
                <p class="font-bold text-display1" v-html="title"></p>
                <p class="text-main1 text-brand-white/50" v-html="engTitle"></p>
            </span>
            <p class="text-title1 w-full">
                <slot name="description" />
            </p>
            <div class="mt-4 flex gap-[25px]">
                <Button @click="router.visit(href)" class="gap-2 font-semibold group/btn">
                    Osta Pilet
                    <ChevronRight
                        class="w-4 h-4 text-brand-white group-hover/btn:translate-x-1 transition duration-100" />
                </Button>
                <Button @click="router.visit(href)" color="brand-900" class="gap-2 font-semibold group/btn">
                    Uuri veel
                    <ChevronRight
                        class="w-4 h-4 text-brand-white group-hover/btn:translate-x-1 transition duration-100" />
                </Button>
            </div>
        </div>
    </div>
</template>
