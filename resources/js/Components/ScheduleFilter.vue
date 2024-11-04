<script setup>
import { ref, computed } from 'vue';
import SelectOption from './SelectOption.vue';
import Slider from './Slider.vue';
import Button from './Button.vue';

const props = defineProps({
    initialDate: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['update:date']);
const SLIDER_LENGTH = 7;

const dates = computed(() => {
    const result = [];
    const today = new Date();

    for (let i = 0; i < SLIDER_LENGTH; i++) {
        const date = new Date(today);
        date.setDate(today.getDate() + i);
        result.push({
            dayOfWeek: date.toLocaleDateString('en-US', { weekday: 'short' }),
            date: date.toLocaleDateString('en-US', { day: 'numeric', month: 'short' })
        });
    }
    return result;
});

const cinemas = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const cinemaOption = ref(0);
const selectedDate = ref(props.initialDate || dates.value[0].date);

const handleDateSelect = (date) => {
    selectedDate.value = date;
    emit('update:date', date);
};

const isDateSelected = (date) => selectedDate.value === date;
</script>

<template>
    <div class="flex flex-row w-full h-min bg-brand-975 p-6 rounded-[10px] gap-4">
        <SelectOption :options="cinemas" v-model="cinemaOption" align="bottom" />

        <div class="flex flex-col gap-1">
            <Slider class="flex flex-row gap-2" :length="SLIDER_LENGTH" :itemWidth="100">
                <button v-for="(day, index) in dates" :key="index" class="flex flex-col content-center gap-1 p-4 border border-brand-900 rounded-lg text-brand-white hover:bg-brand-600/20 hover:scale-105 scale-100 transition duration-100 h-full max-w-[100px]"
                    :class="{ '!text-brand-400': isDateSelected(day.date) }" @click="handleDateSelect(day.date)">
                    <div class="text-title1 font-medium w-[65px]">{{ day.dayOfWeek }}</div>
                    <div class="text-detail w-full">{{ day.date }}</div>
                </button>
            </Slider>
        </div>
    </div>
</template>