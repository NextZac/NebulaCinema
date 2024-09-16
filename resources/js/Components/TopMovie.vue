<script setup>
const props = defineProps({
    image: String,
    title: String,
    publisher: String,
    description: String,
    href: String,
});
</script>

<template>
    <div class="relative w-full h-[500px] overflow-hidden group">
        <!-- Gradient and Image Background -->
        <div
            :style="{
                background: `linear-gradient(98deg, rgba(23, 21, 50, 1) 0%, rgba(23, 21, 50, 1) 31.21%, rgba(0, 0, 0, 0) 56.26%), url(${image})`,
                backgroundSize: 'auto, 80%',
                backgroundPosition: 'right',
            }"
            class="absolute inset-0 w-full h-full transition-all duration-500"
        ></div>

        <!-- Title Holder with text on the gradient side -->
        <div class="absolute left-[20px] bottom-[10rem] text-white z-10">
            <slot name="badges"></slot>
            <p class="font-bold text-5xl" v-html="title"></p>
            <p class="text-xl text-brand-gray" v-html="publisher"></p>
            <p class="mt-2 text-lg w-[50%]"><slot name="description" /></p>
            <div class="mt-4 flex gap-3">
                <button
                    class="bg-brand-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                    @click="router.visit(href)"
                >
                    Osta Pilet
                </button>
                <button
                    class="bg-brand-900 text-white px-4 py-2 rounded hover:bg-gray-700 transition"
                    @click="router.visit(href)"
                >
                    Uuri Veel
                </button>
            </div>
        </div>
    </div>
</template>
