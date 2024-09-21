<script setup>
import { ChevronRight } from 'lucide-vue-next';

const props = defineProps({
  crumbs: Array
});

console.log(props.crumbs);

const crumbActive = 'text-brand-white bg-brand-white font-medium cursor-default'
const crumbInactive = 'text-brand-white/50 hover:text-brand-600 cursor-pointer'

</script>

<template>
  <ol class="flex items-center whitespace-nowrap gap-2">
    <li v-for="(crumb, index) in props.crumbs" :key="index" class="inline-flex items-center gap-2">
      <ChevronRight v-if="index != 0" class="w-4 h-4 text-brand-white/50" />
      <a v-if="index < props.crumbs.length - 1" href="#"
        class="text-sm text-brand-white/50 hover:text-brand-600 cursor-pointer"> {{ crumb }}</a>
      <p v-if="index === props.crumbs.length - 1" class="text-sm text-brand-white font-medium cursor-default"> {{ crumb
        }} </p>
    </li>
  </ol>
</template>