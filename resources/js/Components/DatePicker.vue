<script setup>
import { ref, computed, onMounted } from 'vue';

import { ChevronLeft, ChevronRight } from 'lucide-vue-next';
import SelectOption from './SelectOption.vue';

const props = defineProps({
    selector: Boolean,
    hidePrevious: Boolean
});

const currentDate = ref(new Date());
const selectedDate = ref(null);
const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
const weekdays = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'];
const years = Array.from({ length: 10 }, (_, i) => new Date().getFullYear() + i);

const calendarButton = "size-10 flex justify-center items-center border rounded-full disabled:opacity-50 disabled:pointer-events-none focus:outline-none border-brand-600 text-brand-600 hover:bg-brand-700/10 hover:border-brand-700 hover:text-brand-700 hover:scale-105 active:scale-100 transition duration-100 focus:bg-brand-700/10"
const calendarDay = "m-px size-10 flex justify-center items-center border border-transparent text-sm text-brand-white rounded-full hover:border-brand-600 hover:text-brand-600 hover:scale-105 active:scale-95 transition duration-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none"


const currentMonth = ref(currentDate.value.getMonth());
const currentYear = ref(currentDate.value.getFullYear());

console.log(currentMonth.value, currentYear.value)

const calendarDays = computed(() => {
    const firstDay = new Date(currentYear.value, currentMonth.value, 1);
    const lastDay = new Date(currentYear.value, currentMonth.value + 1, 0);
    const daysInMonth = lastDay.getDate();
    const startingDayOfWeek = (firstDay.getDay() + 6) % 7; // Adjust to start week on Monday

    const calendarArray = [];
    let currentWeek = [];

    // Previous month's days
    for (let i = 0; i < startingDayOfWeek; i++) {
        const prevMonthLastDay = new Date(currentYear.value, currentMonth.value, 0).getDate();
        currentWeek.push({
            date: prevMonthLastDay - startingDayOfWeek + i + 1,
            isCurrentMonth: false,
            isNextMonth: false,
            isPreviousMonth: true
        });
    }

    // Current month's days
    for (let i = 1; i <= daysInMonth; i++) {
        currentWeek.push({ date: i, isCurrentMonth: true, isNextMonth: false, isPreviousMonth: false });
        if (currentWeek.length === 7) {
            calendarArray.push(currentWeek);
            currentWeek = [];
        }
    }

    // Next month's days
    if (currentWeek.length > 0) {
        for (let i = 1; currentWeek.length < 7; i++) {
            currentWeek.push({ date: i, isCurrentMonth: false, isNextMonth: true, isPreviousMonth: false });
        }
        calendarArray.push(currentWeek);
    }

    return calendarArray;
});

const updateCalendar = () => {
    currentDate.value = new Date(currentYear.value, currentMonth.value);
};

const previousMonth = () => {
    if (currentMonth.value === 0) {
        currentMonth.value = 11;
        currentYear.value--;
    } else {
        currentMonth.value--;
    }
    updateCalendar();
};

const nextMonth = () => {
    if (currentMonth.value === 11) {
        currentMonth.value = 0;
        currentYear.value++;
    } else {
        currentMonth.value++;
    }
    updateCalendar();
};

const selectDate = (day) => {
    if (day.isCurrentMonth ) {
        selectedDate.value = new Date(currentYear.value, currentMonth.value, day.date);
    }
};


const isSelectedDate = (day) => {
    return selectedDate.value &&
        day.date === selectedDate.value.getDate() &&
        currentMonth.value === selectedDate.value.getMonth() &&
        currentYear.value === selectedDate.value.getFullYear();
};

onMounted(() => {
    selectedDate.value = new Date();
});
</script>

<template>
    <div class="flex flex-col gap-2 w-min justify-center items-center">
        <!-- Calendar Header -->
        <div v-if="props.selector" class="flex justify-center items-center gap-3 mx-1.5 pb-3">
            <!-- Previous Month Button -->
            <button @click="previousMonth" :class="[calendarButton, 'col-span-1']" aria-label="Previous">
                <ChevronLeft class="w-4 h-4"></ChevronLeft>
            </button>

            <!-- Month and Year Selects -->
            <div class="flex items-center justify-center">
                <SelectOption :options="months" v-model="currentMonth" @change="updateCalendar"
                    class="!rounded-none first:!rounded-s-lg first:!ms-0 last:!rounded-e-lg" />
                <SelectOption :options="years" v-model="currentYear" @change="updateCalendar"
                    class="!rounded-none first:!rounded-s-lg first:!ms-0 last:!rounded-e-lg" />
            </div>

            <!-- Next Month Button -->
            <button @click="nextMonth" :class="[calendarButton, 'justify-self-end col-span-1']" aria-label="Next">
                <ChevronRight class="w-4 h-4"></ChevronRight>
            </button>
        </div>

        <!-- Weekdays -->
        <div class="flex pb-1.5 gap-2">
            <span v-for="day in weekdays" :key="day"
                class="m-px w-10 block text-center text-sm text-brand-white font-medium">
                {{ day }}
            </span>
        </div>

        <!-- Calendar Grid -->

        <!-- The hidePrevious function is still in development, if we even want to create it in the end... -->
        <div v-for="week in calendarDays" :key="week[0].date" class="flex gap-2">
            <button v-for="day in week" :key="day.date" @click="selectDate(day)"
                :class="[calendarDay, { 'bg-brand-600 text-brand-white hover:text-brand-white': isSelectedDate(day) }, { 'text-brand-white bg-transparent': !day.isCurrentMonth }]"
                :disabled="(props.hidePrevious ? (day.date < currentDate.getDate() && day.isCurrentMonth && !day.isNextMonth || day.isPreviousMonth) : !day.isCurrentMonth)">
                {{ day.date }}
            </button>
        </div>
    </div>
</template>

