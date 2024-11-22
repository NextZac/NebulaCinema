<script setup>
import { SquarePlay, ArrowRight } from 'lucide-vue-next';
import Button from './Button.vue';
</script>

<template>
    <div class="flex flex-row w-full h-min">
        <!--Image Skeleton-->
        <div
            class="flex justify-end align-end drop-shadow-lg w-[300px] h-[300px] bg-brand-900 rounded-l-[10px] animate-pulse">
            <div class="absolute right-[5px] bottom-[5px] flex gap-[5px]">
                <div class="w-8 h-4 bg-brand-900 rounded"></div>
                <div class="w-8 h-4 bg-brand-900 rounded"></div>
            </div>
        </div>

        <!--Schedule Info Skeleton-->
        <div class="flex flex-row gap-[35px] min-h-full w-full overflow-hidden bg-brand-975 rounded-r-[10px] p-[35px]">
            <!--Left Column-->
            <div class="flex flex-col h-full w-full max-w-[200px] justify-between gap-[35px] animate-pulse">
                <div class="h-6 bg-brand-900 w-full rounded"></div>
                <div class="flex flex-col gap-[10px]">
                    <div class="h-5 bg-brand-900 w-full rounded"></div>
                    <div class="h-4 bg-brand-900 w-3/4 rounded"></div>
                </div>
                <Button class="flex font-semibold justify-center gap-2 !w-full opacity-50" disabled>
                    <SquarePlay class="w-4 h-4" />
                    Loading...
                </Button>
            </div>

            <!--Right Column-->
            <div class="flex flex-col w-full h-full justify-between gap-[35px] animate-pulse">
                <!--Title and Buttons-->
                <div class="flex flex-row h-full justify-between items-center gap-[35px]">
                    <!--Title Skeleton-->
                    <div class="flex flex-col h-full w-full justify-between gap-[5px]">
                        <div class="flex flex-col gap-[15px]">
                            <div class="h-6 bg-brand-900 w-3/4 rounded"></div>
                            <div class="h-5 bg-brand-900 w-1/2 rounded"></div>
                        </div>
                        <!--Badges Skeleton-->
                        <div class="flex gap-[10px] pt-[5px] flex-wrap">
                            <div class="w-16 h-4 bg-brand-900 rounded"></div>
                            <div class="w-16 h-4 bg-brand-900 rounded"></div>
                        </div>
                    </div>

                    <!--Buttons Skeleton-->
                    <div class="flex gap-[15px] h-full animate-pulse">
                        <Button color="brand-900" class="gap-2 font-semibold opacity-50" disabled>
                            Loading
                            <ArrowRight class="w-4 h-4" />
                        </Button>
                        <Button class="gap-2 font-semibold opacity-50" disabled>
                            Loading
                            <ArrowRight class="w-4 h-4" />
                        </Button>
                    </div>
                </div>

                <!--Other Info Skeleton-->
                <div class="flex flex-row w-full h-min items-center justify-between pt-[15px] animate-pulse">
                    <span class="flex flex-col gap-1 w-[20%]">
                        <div class="h-4 bg-brand-900 w-full rounded mb-1"></div>
                        <div class="h-5 bg-brand-900 w-full rounded"></div>
                    </span>
                    <span class="flex flex-col gap-1 w-[20%]">
                        <div class="h-4 bg-brand-900 w-full rounded mb-1"></div>
                        <div class="h-5 bg-brand-900 w-full rounded"></div>
                    </span>
                    <span class="flex flex-col gap-1 w-[20%]">
                        <div class="h-4 bg-brand-900 w-full rounded mb-1"></div>
                        <div class="h-5 bg-brand-900 w-full rounded"></div>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>