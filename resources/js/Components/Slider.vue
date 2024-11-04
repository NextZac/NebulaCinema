<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { ArrowLeft, ArrowRight } from 'lucide-vue-next';

const props = defineProps({
  length: {
    type: Number,
    required: true,
  },
  itemWidth: {
    type: Number,
    default: 365,
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
  const itemWidth = props.itemWidth + 35; // Card width + gap
  return `translateX(-${currentIndex.value * itemWidth * visibleMovies.value}px)`;
});
</script>

<template>
  <!-- Slider Page Indicators -->
  <div class="w-full flex">
    <div class="flex w-full content-end justify-end h-[6px] gap-2">
      <div v-if="totalPages > 1" v-for="index in totalPages" :key="index"
        class="h-full w-full max-w-[30px] flex flex-col justify-end group" @click="currentIndex = index - 1">
        <div :class="[
          'h-full w-full transition-all duration-100 max-w-[30px]',
          index - 1 === currentIndex ? 'bg-brand-white max-h-full cursor-default' : 'bg-brand-white/50 max-h-[2px] group-hover:bg-brand-600 group-hover:max-h-full cursor-pointer'
        ]">
        </div>
      </div>
    </div>
  </div>

  <!-- Slider Container -->
  <div class="fader py-4">
    <div class="relative w-full group/slider" ref="sliderContainer">
      <div class="flex w-full transition-transform duration-[400ms] ease-in-out gap-[35px] mx-4"
        :style="{ transform: translateX }">
        <slot/>
      </div>
      <button @click="prevSlide" v-if="currentIndex > 0"
        class="absolute flex justify-center items-center z-20 -left-2 top-0 w-20 h-[100%] transition duration-100 group text-brand-white invisible group-hover/slider:visible bg-gradient-to-r from-brand-950 to-transparent">
        <ArrowLeft class="size-10 transition duration-100 group-hover:scale-125 text-brand-white" />
      </button>
      <button @click="nextSlide" v-if="currentIndex < totalPages - 1"
        class="absolute flex justify-center items-center z-20 -right-2 top-0 w-20 h-[100%] transition duration-100 group text-brand-white invisible group-hover/slider:visible bg-gradient-to-l from-brand-950 to-transparent">
        <ArrowRight class="size-10 transition duration-100 group-hover:scale-125 text-brand-white"/>
      </button>
    </div>
  </div>
</template>

<style scoped>
.fader {
  mask-image: linear-gradient(to right, transparent 0%, white 2%, white 98%, transparent 100%);
  -webkit-mask-image: linear-gradient(to right, transparent 0%, white 2%, white 98%, transparent 100%);
}

.faderDown {
  mask-image: linear-gradient(to bottom, transparent 0%, white 1%, white 90%, transparent 100%);
  -webkit-mask-image: linear-gradient(to top, transparent 0%, white 2%, white 98%, transparent 100%);
}
</style>