<script setup>

const props = defineProps({
    image: String,
    title: String,
    titleEng: String,
    href: String,
})

</script>

<template>
    <a :href="props.href" class="flex flex-col gap-[15px] w-min h-min group min-w-[300px]">
        <!--Image with badge-->
        <div class="flex justify-end align-end drop-shadow-lg">
            <img class="rounded-[10px] w-full h-[260px] object-fill" :src="props.image" alt="Movie Poster">
            <span class="flex gap-[5px] absolute right-[5px] bottom-[5px]">
                <slot name="imageBadge"></slot>
            </span>
        </div>

        <!--Title-->
        <div class="flex flex-col gap-[5px]">
            <p class="text-brand-white text-title2 group-hover:text-brand-400 group-hover:underline">{{ props.title }}
            </p>
            <p class="text-brand-white/50 text-subtitle group-hover:text-brand-400/50 group-hover:underline">{{
                props.titleEng }}</p>

            <!--Badges-->
            <div class="flex gap-[10px] pt-[5px]">
                <slot name="badges"></slot>
            </div>
        </div>
    </a>
</template>