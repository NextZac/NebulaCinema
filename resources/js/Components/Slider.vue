<script setup>
import { ref, computed, onMounted, watch } from 'vue';

const props = defineProps({
  length: {
    type: Number,
    required: true,
  },
});

const sliderContainer = ref(null);
const currentIndex = ref(0);
const visibleMovies = ref(0);
const totalPages = ref(1);

const calculateVisibleMovies = () => {
  if (sliderContainer.value) {
    const containerWidth = sliderContainer.value.offsetWidth;
    const movieWidth = 272; // 256px (w-64) + 16px (2 * mx-2)
    visibleMovies.value = Math.floor(containerWidth / movieWidth);
    totalPages.value = Math.ceil(props.length / visibleMovies.value);
  }
};

onMounted(() => {
  console.log(props.length);
  calculateVisibleMovies();
  window.addEventListener('resize', calculateVisibleMovies);
});

watch(() => props.length, calculateVisibleMovies);

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % totalPages.value;
};

const prevSlide = () => {
  currentIndex.value = (currentIndex.value - 1 + totalPages.value) % totalPages.value;
};
</script>

<template>
    <div class="relative w-full overflow-hidden" ref="sliderContainer">
      <div
        class="flex transition-transform duration-300 ease-in-out pl-4 pr-4"
        :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
      >
        <slot class="" name="cards" />
      </div>
      <button
        @click="prevSlide"
        class="absolute top-1/2 left-2 transform -translate-y-1/2 text-white"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </button>
      <button
        @click="nextSlide"
        class="absolute top-1/2 right-2 transform -translate-y-1/2 text-white"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </button>
      <div class="flex justify-center mt-4">
      <div
        v-for="index in totalPages"
        :key="index"
        :class="[
          'h-1 w-8 mx-1 rounded-full',
          index - 1 === currentIndex ? 'bg-blue-500' : 'bg-gray-600'
        ]"
      />
      </div>
    </div>
  </template>
  
