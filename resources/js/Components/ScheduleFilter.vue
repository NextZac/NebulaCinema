<script setup>
import { ref, computed } from 'vue';
import SelectOption from './SelectOption.vue';
import Dropdown from './Dropdown.vue';
import Checkbox from './Checkbox.vue';
import { ChevronDown, Drama, Filter, MapPin } from 'lucide-vue-next';

const DAYS_TO_SHOW = 7;

const props = defineProps({
    initialDate: {
        type: String,
        default: ''
    },
    cinemas: {
        type: Array,
        default: () => ['Nebula Ülemiste', 'Nebula T1', 'Nebula Viru', 'Nebula Tasku']
    }
});

const emit = defineEmits(['update:date', 'update:cinema', 'update:genres', 'update:filters']);

// State management
const dropdowns = ref({
    genres: false,
    filters: false,
    cinemas: false
});

const cinemaOption = ref(0);
const selectedGenres = ref(new Set());
const selectedFilters = ref({
    language: new Set(),
    time: new Set(),
    subtitles: new Set(),
    format: new Set(),
    ageRating: new Set()
});

// Computed properties
const dates = computed(() => {
    const result = [];
    const today = new Date();

    for (let i = 0; i < DAYS_TO_SHOW; i++) {
        const date = new Date(today);
        date.setDate(today.getDate() + i);
        result.push({
            dayOfWeek: date.toLocaleDateString('et', { weekday: 'short' }),
            date: date.toLocaleDateString('et', { day: 'numeric', month: 'short' })
        });
    }
    return result;
});

const selectedDate = ref(props.initialDate || dates.value[0].date);

const selectedCinema = computed(() => props.cinemas[cinemaOption.value]);

// Filter options (move to props if needed to be configurable)
const filterCategories = {
    language: {
        title: 'Keel',
        options: ['Eesti', 'English', 'Russian']
    },
    time: {
        title: 'Aeg',
        options: ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00']
    },
    subtitles: {
        title: 'Subtiitrid',
        options: ['Eesti', 'English', 'Russian', 'None']
    },
    format: {
        title: 'Formaat',
        options: ['2D', '3D']
    },
    ageRating: {
        title: 'Vanusepiirang',
        options: ['PERE', '12+', '16+', '18+']
    }
};

const genreOptions = [
    'Action', 'Comedy', 'Drama', 'Horror', 'Romance',
    'Sci-Fi', 'Documentary', 'Animation', 'Thriller'
];

// Methods
const toggleDropdown = (key) => {
    Object.keys(dropdowns.value).forEach(k => {
        if (k !== key) dropdowns.value[k] = false;
    });
    dropdowns.value[key] = !dropdowns.value[key];
};

const handleDateSelect = (date) => {
    selectedDate.value = date;
    emit('update:date', date);
};

const handleCinemaChange = (index) => {
    cinemaOption.value = index;
    emit('update:cinema', props.cinemas[index]);
};

const handleFilterChange = (category, option) => {
    const filterSet = selectedFilters.value[category];
    if (filterSet.has(option)) {
        filterSet.delete(option);
    } else {
        filterSet.add(option);
    }
    emit('update:filters', { ...selectedFilters.value });
};

const handleGenreChange = (genre) => {
    if (selectedGenres.value.has(genre)) {
        selectedGenres.value.delete(genre);
    } else {
        selectedGenres.value.add(genre);
    }
    emit('update:genres', Array.from(selectedGenres.value));
};
</script>

<template>
    <div class="flex flex-row items-stretch w-full bg-brand-975 p-4 rounded-[10px] gap-4">
        <!-- Left -->
        <div class="flex-1 flex items-center">
            <div class="h-full flex items-center relative">
                <a @click="toggleDropdown('cinemas')"
                    class="group text-brand-white text-subtitle inline-flex items-center hover:text-brand-400 cursor-pointer select-none text-nowrap">
                    <MapPin class="size-7 mr-3 text-brand-white/60 group-hover:text-brand-400/60" />
                    <span class="flex flex-col">
                        <p class="text-detail group-hover:text-brand-400/60 text-brand-white/60">Kino</p>
                        <p> {{ selectedCinema }}</p>
                    </span>
                    <ChevronDown :class="[
                        'w-4 h-4 ml-2 transition-transform duration-100',
                        dropdowns['cinemas'] ? 'rotate-180' : '',
                    ]" />
                </a>
                <SelectOption class="w-full rounded-lg" :options="props.cinemas" v-model:isOpen="dropdowns.cinemas"
                    :modelValue="cinemaOption" @update:modelValue="handleCinemaChange" align="bottom"
                    :withButton="false" />
            </div>
        </div>

        <!-- Center -->
        <div class="flex-[2] flex items-center justify-center">
            <div class="flex flex-row gap-2">
                <button v-for="(day, index) in dates" :key="index"
                    class="flex flex-col content-center gap-1 p-4 border border-brand-900 rounded-lg text-brand-white hover:bg-brand-600/20 hover:scale-105 scale-100 transition duration-100 h-full min-w-[100px]"
                    :class="{ '!text-brand-400': selectedDate === day.date }" @click="handleDateSelect(day.date)">
                    <div class="text-title1 font-medium" :class="{ '!text-brand-400': selectedDate === day.date }">
                        {{ day.dayOfWeek }}
                    </div>
                    <div class="text-detail text-brand-white/60"
                        :class="{ '!text-brand-400/60': selectedDate === day.date }">
                        {{ day.date }}
                    </div>
                </button>
            </div>
        </div>

        <!-- Right -->
        <div class="flex-1 flex items-center justify-end gap-16">
            <!-- Genres -->
            <div class="h-full flex items-center relative">
                <a @click="toggleDropdown('genres')"
                    class="group text-brand-white text-subtitle inline-flex items-center hover:text-brand-400 cursor-pointer select-none text-nowrap">
                    <Drama class="size-7 mr-3 text-brand-white/60 group-hover:text-brand-400/60" />
                    <span class="flex flex-col">
                        <p class="text-detail group-hover:text-brand-400/60 text-brand-white/60">Genre</p>
                        <p>Kõik</p>
                    </span>
                    <ChevronDown :class="[
                        'w-4 h-4 ml-2 transition-transform duration-100',
                        dropdowns['genres'] ? 'rotate-180' : '',
                    ]" />
                </a>
                <Dropdown v-model:isOpen="dropdowns.genres" align="bottom" class="top-[110%]">
                    <div class="p-4 w-64">
                        <div v-for="genre in genreOptions" :key="genre" class="mb-3">
                            <Checkbox :id="'genre-' + genre" :modelValue="selectedGenres.has(genre)"
                                @update:modelValue="() => handleGenreChange(genre)">
                                {{ genre }}
                            </Checkbox>
                        </div>
                    </div>
                </Dropdown>
            </div>

            <!-- Filters -->
            <div class="h-full flex items-center relative">
                <a @click="toggleDropdown('filters')"
                    class="group text-brand-white text-subtitle inline-flex items-center hover:text-brand-400 cursor-pointer select-none text-nowrap">
                    <Filter class="size-7 mr-3 text-brand-white/60 group-hover:text-brand-400/60" />
                    <span class="flex flex-col">
                        <p class="text-detail group-hover:text-brand-400/60 text-brand-white/60">Filter</p>
                        <p>Kõik</p>
                    </span>
                    <ChevronDown :class="[
                        'w-4 h-4 ml-2 transition-transform duration-100',
                        dropdowns['filters'] ? 'rotate-180' : '',
                    ]" />
                </a>
                <Dropdown v-model:isOpen="dropdowns.filters" align="bottom" class="top-[110%] right-0">
                    <div class="flex divide-x divide-brand-900">
                        <div v-for="(category, key) in filterCategories" :key="key" class="flex flex-col min-w-[200px]">
                            <h2 class="p-3 text-subtitle text-brand-white/60 border-b border-brand-900">
                                {{ category.title }}
                            </h2>
                            <div class="p-4">
                                <div v-for="option in category.options" :key="option" class="mb-3">
                                    <Checkbox :id="key + '-' + option" :modelValue="selectedFilters[key].has(option)"
                                        @update:modelValue="() => handleFilterChange(key, option)">
                                        {{ option }}
                                    </Checkbox>
                                </div>
                            </div>
                        </div>
                    </div>
                </Dropdown>
            </div>
        </div>
    </div>
</template>