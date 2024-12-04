<script setup>
import { SquarePlay, ArrowRight } from 'lucide-vue-next';
import Button from './Button.vue';
</script>

<template>
    <div class="flex flex-col w-min h-min group min-w-[365px] transition-all duration-100">
        <div class="flex justify-end align-end drop-shadow-lg">
            <div class="rounded-t-[10px] w-full h-[250px] bg-brand-900 animate-pulse"></div>
        </div>
        <div class="flex flex-col gap-[5px] h-min overflow-hidden bg-brand-975 rounded-b-[10px] p-4 animate-pulse">
            <div class="h-6 bg-brand-900 w-3/4 rounded mb-2"></div>
            <div class="h-5 bg-brand-900 w-1/2 rounded"></div>

            <div class="flex gap-[10px] pt-[5px] flex-wrap">
                <div class="w-16 h-4 bg-brand-900 rounded"></div>
                <div class="w-16 h-4 bg-brand-900 rounded"></div>
            </div>
            <div class="flex gap-2 mt-3 h-full">
                <Button color="brand-900" class="flex font-semibold justify-center gap-2 !w-full" disabled>
                    <SquarePlay class="w-4 h-4" />
                    Loading
                </Button>
                <Button class="gap-2 font-semibold group/btn" disabled>
                    Loading
                    <ArrowRight
                        class="w-4 h-4 text-brand-white group-hover/btn:translate-x-1 ease-out transition duration-300" />
                </Button>
            </div>
        </div>
    </div>
</template>