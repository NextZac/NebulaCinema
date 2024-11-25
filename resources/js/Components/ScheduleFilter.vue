<script setup>
import { ref, computed, onMounted } from 'vue';
import SelectOption from './SelectOption.vue';
import Dropdown from './Dropdown.vue';
import Checkbox from './Checkbox.vue';
import Input from './Input.vue';
import { ChevronDown, Drama, Filter, MapPin, ArrowRight, ArrowLeft, X } from 'lucide-vue-next';
import Badge from './Badge.vue';

const DAYS_TO_SHOW = 14;

const props = defineProps({
    initialDate: {
        type: String,
        default: ''
    },
    cinemas: {
        type: Array,
        default: () => ['Kõik kinod', 'Nebula Ülemiste', 'Nebula T1', 'Nebula Viru', 'Nebula Tasku']
    }
});

const emit = defineEmits(['update:date', 'update:cinema', 'update:genres', 'update:filters', 'update:timeHours', 'update:timeMinutes']);

// State management
const dropdowns = ref({
    genres: false,
    filters: false,
    cinemas: false,
    timeHours: false,
    timeMinutes: false
});

const cinemaOption = ref(0);

const timeHours = ref('');
const timeMinutes = ref('');

const selectedGenres = ref(new Set());
const selectedFilters = ref({
    language: new Set(),
    time: new Set(),
    subtitles: new Set(),
    format: new Set(),
    ageRating: new Set()
});

const htmlLang = document.documentElement.lang;

// Computed properties
const dates = computed(() => {
    const result = [];
    const today = new Date();

    for (let i = 0; i < DAYS_TO_SHOW; i++) {
        const date = new Date(today);
        date.setDate(today.getDate() + i);
        result.push({
            dayOfWeek: date.toLocaleDateString(htmlLang, { weekday: 'short' }),
            date: date.toLocaleDateString(htmlLang, { day: 'numeric', month: 'short' }),
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
        options: ['Eesti', 'Inglise', 'Vene']
    },
    time: {
        title: 'Aeg',
        options: [""]
    },
    subtitles: {
        title: 'Subtiitrid',
        options: ['Eesti', 'Inglise', 'Vene', 'None']
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

const fetchGenres = () => {
    try {
        axios.get(route('Schedule.genres'), {
        }).then(response => {
            console.log(response.data);
            console.log(response.data[0].name);
            genreOptions.value = response.data
            console.log(genreOptions.value);
        }).catch(error => {
            console.error(error);
        });
    } catch (error) {
        console.error('Failed to fetch movies:', error);
        return [];
    }
};

const genreOptions = ref(fetchGenres());


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
    if (category === '' && option === '') {
        Object.values(selectedFilters.value).forEach(set => set.clear());
        emit('update:filters', { ...selectedFilters.value });
        return;
    }

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

    if (genre === '') {
        selectedGenres.value.clear();
    }

    emit('update:genres', Array.from(selectedGenres.value));
};

const formattedHours = computed({
    get: () => timeHours.value === '' ? '' : timeHours.value,
    set: (value) => {
        if (value === '') {
            timeHours.value = '';
            emit('update:timeHours', '');
            return;
        }

        let num = parseInt(value);
        if (isNaN(num)) {
            return;
        }

        // Ensure the number is between 0 and 23
        num = Math.min(Math.max(num, 0), 23);
        timeHours.value = num.toString().padStart(2, '0');
        emit('update:timeHours', timeHours.value);
    }
});

const formattedMinutes = computed({
    get: () => timeMinutes.value === '' ? '' : timeMinutes.value,
    set: (value) => {
        if (value === '') {
            timeMinutes.value = '';
            emit('update:timeMinutes', '');
            return;
        }

        let num = parseInt(value);
        if (isNaN(num)) {
            return;
        }

        // Ensure the number is between 0 and 59
        num = Math.min(Math.max(num, 0), 59);
        timeMinutes.value = num.toString().padStart(2, '0');
        emit('update:timeMinutes', timeMinutes.value);
    }
});

const handleTimeInput = (value, type) => {
    if (type === 'hours') {
        formattedHours.value = value;
        if (formattedMinutes.value === '' && formattedHours.value !== '') {
            formattedMinutes.value = '00';
        } else if (formattedHours.value === '' && formattedMinutes.value !== '') {
            formattedHours.value = '00';
        }

        if (formattedMinutes.value === '00' && formattedHours.value === '00') {
            formattedHours.value = '';
            formattedMinutes.value = '';
        }
    } else {
        formattedMinutes.value = value;
        if (formattedHours.value === '' && formattedMinutes.value !== '') {
            formattedHours.value = '00';
        } else if (formattedMinutes.value === '' && formattedHours.value !== '') {
            formattedMinutes.value = '00';
        }

        if (formattedMinutes.value === '00' && formattedHours.value === '00') {
            formattedHours.value = '';
            formattedMinutes.value = '';
        }
    };
}


// State
const scrollPosition = ref(0)
const scrollAmount = 102 // Width of each date button + gap

// Computed
const isStartOfList = computed(() => scrollPosition.value <= 0)
const isEndOfList = computed(() => {
    const maxScroll = (dates.value.length - 7) * scrollAmount
    return scrollPosition.value >= maxScroll
})

const scroll = (direction) => {
    if (direction === 'left' && !isStartOfList.value) {
        scrollPosition.value = Math.max(0, scrollPosition.value - scrollAmount)
    } else if (direction === 'right' && !isEndOfList.value) {
        const maxScroll = (dates.value.length - 7) * scrollAmount
        scrollPosition.value = Math.min(maxScroll, scrollPosition.value + scrollAmount)
    }
}


</script>

<template>
    <div class="flex flex-row max-4xl:flex-col items-stretch w-full bg-brand-975 p-4 rounded-[10px] gap-4">
        <!-- Left -->
        <div class="flex-1 flex items-center">
            <div class="h-full flex items-center relative">
                <a @click="toggleDropdown('cinemas')"
                    class="group text-brand-white text-subtitle inline-flex items-center hover:text-brand-400 cursor-pointer select-none text-nowrap"
                    :class="dropdowns['cinemas']
                        ? 'pointer-events-none'
                        : 'pointer-events-auto'">
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
        <div class="flex-[2] flex items-center overflow-hidden justify-center">
            <div class="relative w-full">
                <!-- Left scroll button -->
                <button @click="scroll('left')"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full group/left"
                    v-if="!isStartOfList">
                    <ArrowLeft
                        class="size-6 text-brand-white group-hover/left:text-brand-400 transition duration-100" />
                </button>

                <!-- Dates container -->
                <div class="fader w-full">
                    <div ref="sliderContainer" class="flex flex-row gap-2 transition-transform duration-300 py-1"
                        :style="{ transform: `translateX(-${scrollPosition}px)` }">
                        <button v-for="(day, index) in dates" :key="index"
                            class="flex flex-col content-center gap-1 p-4 border border-brand-900 rounded-lg text-brand-white hover:bg-brand-600/10 hover:scale-105 scale-100 transition duration-100 h-full min-w-[100px]"
                            :class="{ '!text-brand-400 bg-brand-600/10': selectedDate === day.date }"
                            @click="handleDateSelect(day.date)">
                            <div class="text-title1 font-medium"
                                :class="{ '!text-brand-400': selectedDate === day.date }">
                                {{ day.dayOfWeek }}
                            </div>
                            <div class="text-detail text-brand-white/60"
                                :class="{ '!text-brand-400/60': selectedDate === day.date }">
                                {{ day.date }}
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Right scroll button -->
                <button @click="scroll('right')"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-10 p-2 rounded-full group/right"
                    v-if="!isEndOfList">
                    <ArrowRight
                        class="size-6 text-brand-white group-hover/right:text-brand-400 transition duration-100" />
                </button>
            </div>
        </div>

        <!-- Right -->
        <div class="flex-1 flex items-center justify-end gap-16">
            <!-- Genres -->
            <div class="h-full flex items-center relative">
                <a @click="toggleDropdown('genres')"
                    class="group text-brand-white text-subtitle inline-flex items-center hover:text-brand-400 cursor-pointer select-none text-nowrap"
                    :class="dropdowns['genres']
                        ? '!text-brand-400 pointer-events-none'
                        : 'pointer-events-auto'">
                    <Drama class="size-7 mr-3 text-brand-white/60 group-hover:text-brand-400/60"
                        :class="dropdowns['genres'] ? '!text-brand-400/60' : ''" />
                    <span class="flex flex-col">
                        <p class="text-detail group-hover:text-brand-400/60 text-brand-white/60"
                            :class="dropdowns['genres'] ? '!text-brand-400/60' : ''">Genre</p>
                        <p v-if="selectedGenres.size <= 1"> {{ selectedGenres.size === 0 ? 'Kõik' :
                            selectedGenres.values().next().value }}</p>
                        <Badge :class="dropdowns['filters'] ? 'cursor-default' : 'cursor-pointer'" v-if="selectedGenres.size > 1" type="solid">{{ selectedGenres.size
                            + ' valitud' }} <X
                                class="size-4 ml-2 cursor-pointer hover:text-brand-error pointer-events-auto"
                                @click="() => handleGenreChange('')"></X>
                        </Badge>
                    </span>
                    <ChevronDown :class="[
                        'w-4 h-4 ml-2 transition-transform duration-100',
                        dropdowns['genres'] ? 'rotate-180' : '',
                    ]" />
                </a>
                <Dropdown v-model:isOpen="dropdowns.genres" align="bottom" class="top-[110%]">
                    <div class="p-4 w-64">
                        <div v-for="genre in genreOptions" :key="genre.name" class="mb-3">
                            <Checkbox :id="'genre-' + genre.name" :modelValue="selectedGenres.has(genre.name)"
                                :checked="selectedGenres.has(genre.name)" @change="() => handleGenreChange(genre.name)">
                                {{ genre.name }}
                            </Checkbox>
                        </div>
                    </div>
                </Dropdown>
            </div>

            <!-- Filters -->
            <div class="h-full flex items-center relative">
                <a @click="toggleDropdown('filters')"
                    class="group text-brand-white text-subtitle inline-flex items-center hover:text-brand-400 cursor-pointer select-none text-nowrap" :class="dropdowns['filters']
                        ? '!text-brand-400 pointer-events-none'
                        : 'pointer-events-auto'">
                    <Filter class="size-7 mr-3 text-brand-white/60 group-hover:text-brand-400/60" :class="dropdowns['filters'] ? '!text-brand-400/60' : ''" />
                    <span class="flex flex-col">
                        <p class="text-detail group-hover:text-brand-400/60 text-brand-white/60" :class="dropdowns['filters'] ? '!text-brand-400/60' : ''">Filter</p>
                        <p
                            v-if="Object.values(selectedFilters).reduce((sum, set) => sum + set.size, 0) + (timeHours.value || timeMinutes.value ? 1 : 0) <= 1">
                            {{ Object.values(selectedFilters).reduce((sum, set) => sum + set.size, 0) + (timeHours.value
                                || timeMinutes.value ? 1 : 0) === 0
                                ? 'Kõik'
                                : timeHours.value || timeMinutes.value
                                    ? `${timeHours.value || '00'}:${timeMinutes.value || '00'}`
                            : Object.values(selectedFilters).find(set => set.size > 0)?.values().next().value }}
                        </p>
                        <Badge :class="dropdowns['filters'] ? 'cursor-default' : 'cursor-pointer'"
                            v-if="Object.values(selectedFilters).reduce((sum, set) => sum + set.size, 0) + (timeHours.value || timeMinutes.value ? 1 : 0) > 1"
                            type="solid">
                            {{ Object.values(selectedFilters).reduce((sum, set) => sum + set.size, 0) + (timeHours.value
                                || timeMinutes.value ? 1 : 0) + ' valitud' }}
                            <X class="size-4 ml-2 cursor-pointer hover:text-brand-error pointer-events-auto"
                                @click="() => handleFilterChange('', '')"></X>
                        </Badge>
                    </span>
                    <ChevronDown :class="[
                        'w-4 h-4 ml-2 transition-transform duration-100',
                        dropdowns['filters'] ? 'rotate-180' : '',
                    ]" />
                </a>
                <Dropdown v-model:isOpen="dropdowns.filters" align="bottom" class="top-[120%] right-0">
                    <div class="flex divide-x divide-brand-900">
                        <div v-for="(category, key) in filterCategories" :key="key" class="flex flex-col min-w-[200px]">
                            <h2 class="p-3 text-subtitle text-brand-white/60 border-b border-brand-900">
                                {{ category.title }}
                            </h2>
                            <div class="p-4">
                                <div v-for="option in category.options" :key="option" class="mb-3"
                                    :class="key === 'time' ? 'mb-56' : ''">
                                    <Checkbox v-if="key !== 'time'" :id="key + '-' + option"
                                        :modelValue="selectedFilters[key].has(option)"
                                        @change="() => handleFilterChange(key, option)"
                                        :checked="selectedFilters[key].has(option)">
                                        {{ option }}
                                    </Checkbox>
                                    <div v-if="key === 'time'" class="flex flex-col gap-1">
                                        <span class="flex flex-row w-min gap-2">
                                            <span class="flex flex-col gap-1">
                                                <label for="timeHours" class="text-brand-white">Tund</label>
                                                <input type="number" min="0" max="23" :value="formattedHours"
                                                    @focus="$event.target.value = ''"
                                                    @focusout="handleTimeInput($event.target.value, 'hours')"
                                                    @input="handleTimeInput($event.target.value, 'hours'); if (typeof $event.target.value === 'string') $event.target.value = $event.target.value.slice(0, 2)"
                                                    class="bg-transparent border-brand-900 rounded-lg px-3 py-2 text-brand-white w-min"
                                                    placeholder="--" />
                                            </span>
                                            <span
                                                class="text-brand-white text-title1 text-center flex items-center pt-4">:</span>
                                            <span class="flex flex-col gap-1">
                                                <label for="timeMinutes" class="text-brand-white">Minut</label>
                                                <input type="number" min="0" max="59" :value="formattedMinutes"
                                                    @focus="$event.target.value = ''"
                                                    @focusout="handleTimeInput($event.target.value, 'minutes')"
                                                    @input="handleTimeInput($event.target.value, 'minutes'); if ($event.target.value.length > 2) $event.target.value = $event.target.value.slice(0, 2)"
                                                    class="bg-transparent border-brand-900 rounded-lg px-3 py-2 text-brand-white w-min"
                                                    placeholder="--" />
                                            </span>
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </Dropdown>
            </div>
        </div>
    </div>
</template>

<style scoped>
.fader {
    mask-image: linear-gradient(to right, transparent 0%, white 2%, white 98%, transparent 100%);
    -webkit-mask-image: linear-gradient(to right, transparent 0%, white 2%, white 98%, transparent 100%);
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Hide spin buttons in Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}
</style>