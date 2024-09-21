<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { ChevronLeft, ChevronRight } from 'lucide-vue-next';

const props = defineProps({
  length: {
    type: Number,
    required: true,
  },
});

const sliderContainer = ref(null);
const currentIndex = ref(0);
const visibleMovies = ref(1);
const totalPages = computed(() => Math.ceil(props.length / visibleMovies.value));

const calculateVisibleMovies = () => {
  if (sliderContainer.value) {
    const containerWidth = sliderContainer.value.offsetWidth;
    const movieWidth = 365; // Adjust this value based on your card width
    const gap = 35; // Gap between cards
    visibleMovies.value = Math.floor((containerWidth + gap) / (movieWidth + gap));
  }
};

onMounted(() => {
  calculateVisibleMovies();
  window.addEventListener('resize', calculateVisibleMovies);
});

watch(() => props.length, calculateVisibleMovies);

const nextSlide = () => {
  if (currentIndex.value < totalPages.value - 1) {
    currentIndex.value++;
  }
};

const prevSlide = () => {
  if (currentIndex.value > 0) {
    currentIndex.value--;
  }
};

const translateX = computed(() => {
  const itemWidth = 365 + 35; // Card width + gap
  return `translateX(-${currentIndex.value * itemWidth * visibleMovies.value}px)`;
});
</script>

<template>
  <!-- Slider Page Indicators -->
  <div class="w-full flex">
    <div class="flex w-full content-end justify-end h-[6px] gap-2">
      <div v-for="index in totalPages" :key="index" class="h-full w-full max-w-[30px] flex flex-col justify-end group"
        @click="currentIndex = index - 1">
        <div :class="[
          'h-full w-full transition-all duration-100 max-w-[30px]',
          index - 1 === currentIndex ? 'bg-brand-white max-h-full cursor-default' : 'bg-brand-white/50 max-h-[2px] group-hover:bg-brand-600 group-hover:max-h-full cursor-pointer'
        ]">
        </div>
      </div>
    </div>
  </div>

  <!-- Slider Container -->
  <div class="relative w-full" ref="sliderContainer">
    <div class="flex transition-transform duration-300 ease-in-out gap-[35px]" :style="{ transform: translateX }">
      <slot name="cards" />
    </div>
    <button @click="prevSlide" v-if="currentIndex > 0"
      class="absolute flex justify-center items-center z-20 -left-6 top-0 w-16 h-full transition duration-100 group text-brand-white hover:bg-gradient-to-r from-black/50 to-transparent">
      <ChevronLeft class="h-6 w-6 transition duration-100 group-hover:scale-125"></ChevronLeft>
    </button>
    <button @click="nextSlide" v-if="currentIndex < totalPages - 1"
      class="absolute flex justify-center items-center z-20 -right-6 top-0 w-16 h-full transition duration-100 group text-brand-white hover:bg-gradient-to-l from-black/50 to-transparent">
      <ChevronRight class="h-6 w-6 transition duration-100 group-hover:scale-125"></ChevronRight>
    </button>
  </div>
</template>