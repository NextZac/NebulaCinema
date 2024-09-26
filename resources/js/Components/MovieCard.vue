<script setup>

import { ref, computed } from 'vue';

import Badge from './Badge.vue';

const props = defineProps({
    image: String,
    title: String,
    titleEng: String,
    href: String,
    starting: String,
    animated: Boolean
})

const isHovered = ref(false);

let animationStyle

if (props.animated) {
    animationStyle = computed(() => ({
        transform: isHovered.value ? 'translateY(0px)' : 'translateY(-20px)',
        opacity: isHovered.value ? '1' : '0',
        overflow: 'hidden',
        transition: 'transform 150ms ease-in-out, opacity 150ms ease-in-out',
        pointerEvents: isHovered.value ? 'auto' : 'none',
    }));
} else { 
    animationStyle = "";
}


</script>

<template>
    <a :href="props.href"
        class="flex flex-col gap-[15px] w-min h-min group min-w-[365px] hover:scale-105 active:scale-100 transition-all duration-100"
        @mouseover="isHovered = true" @mouseleave="isHovered = false">
        <!--Image with badge-->
        <div class="flex justify-end align-end drop-shadow-lg">
            <img class="rounded-[10px] w-full h-[500px] object-cover" :src="props.image" alt="Movie Poster">
            <span v-if="props.starting" class="flex absolute left-[5px] top-[5px]">
                <Badge type="bordered">Linastused alates {{ props.starting }}</Badge>
            </span>
            <span class="flex gap-[5px] absolute right-[5px] bottom-[5px]">
                <slot name="imageBadges"></slot>
            </span>
        </div>

        <!--Title-->
        <div :class="['flex flex-col gap-[5px] h-min overflow-hidden' ]"
            :style="animationStyle">
            <p class="text-brand-white text-title2 group-hover:text-brand-400" v-html="props.title"></p>
            <p class="text-brand-white/50 text-subtitle group-hover:text-brand-400/50" v-html="props.titleEng"></p>

            <!--Badges-->
            <div class="flex gap-[10px] pt-[5px] flex-wrap">
                <slot name="badges"></slot>
            </div>
        </div>
    </a>
</template>