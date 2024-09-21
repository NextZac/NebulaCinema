<script setup>

const props = defineProps({
    image: String,
    title: String,
    titleEng: String,
    href: String,
})

</script>

<template>
    <a :href="props.href"
        class="flex flex-col gap-[15px] w-min h-min group min-w-[365px] hover:scale-105 active:scale-100 transition duration-100">
        <!--Image with badge-->
        <div class="flex justify-end align-end drop-shadow-lg">
            <img class="rounded-[10px] w-full h-[260px] object-fill" :src="props.image" alt="Movie Poster">
            <span class="flex gap-[5px] absolute right-[5px] bottom-[5px]">
                <slot name="imageBadges"></slot>
            </span>
        </div>

        <!--Title-->
        <div
            :class="'flex flex-col gap-[5px] h-min overflow-hidden transition-all delay-100 duration-[0.65s] ease-in-out max-h-0 group-hover:max-h-[500px]'">
            <p class="text-brand-white text-title2 group-hover:text-brand-400 group-hover:underline"
                v-html="props.title"></p>
            <p class="text-brand-white/50 text-subtitle group-hover:text-brand-400/50 group-hover:underline"
                v-html="props.titleEng"></p>

            <!--Badges-->
            <div class="flex gap-[10px] pt-[5px]">
                <slot name="badges"></slot>
            </div>
        </div>
    </a>
</template>