<script setup>
import { ref, computed, onMounted } from 'vue';
import SelectOption from './SelectOption.vue';
import Dropdown from './Dropdown.vue';
import Checkbox from './Checkbox.vue';
import Input from './Input.vue';
import { ChevronDown, Drama, Calendar, X } from 'lucide-vue-next';
import Badge from './Badge.vue';

const props = defineProps({
    initialDate: {
        type: String,
        default: ''
    },
    cinemas: {
        type: Array,
        default: () => ['upcoming', 'current']
    }
});

const emit = defineEmits(['update:cinema', 'update:genres']);

// State management
const dropdowns = ref({
    genres: false,
    filters: false,
    cinemas: false,
    timeHours: false,
    timeMinutes: false
});

const cinemaOption = ref(0);

const selectedGenres = ref(new Set());

const htmlLang = document.documentElement.lang;

const selectedCinema = computed(() => props.cinemas[cinemaOption.value]);

const fetchGenres = () => {
    try {
        axios.get(route('Schedule.genres'), {
        }).then(response => {
            genreOptions.value = response.data
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

const handleCinemaChange = (index) => {
    cinemaOption.value = index;
    emit('update:cinema', props.cinemas[index]);
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

const convertCinemaNames = (cinemas) => {

    console.log(cinemas);
    console.log(typeof cinemas);

    if (typeof cinemas === 'object') {

        return cinemas.map(c => {
            switch (c) {
                case 'current':
                    return '__("home.current")';
                case 'upcoming':
                    return '__("home.upcoming")';
                default:
                    return c;
            }
        });
    } else {
        switch (cinemas) {
            case 'current':
                return '__("home.current")';
            case 'upcoming':
                return '__("home.upcoming")';
            default:
                return cinemas;
        }
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
                    <Calendar class="size-7 mr-3 text-brand-white/60 group-hover:text-brand-400/60" />
                    <span class="flex flex-col">
                        <p class="text-detail group-hover:text-brand-400/60 text-brand-white/60">Linastusaeg</p>
                        <p> {{ convertCinemaNames(selectedCinema) }}</p>
                    </span>
                    <ChevronDown :class="[
                        'w-4 h-4 ml-2 transition-transform duration-100',
                        dropdowns['cinemas'] ? 'rotate-180' : '',
                    ]" />
                </a>
                <SelectOption class="w-full rounded-lg" :options="convertCinemaNames(props.cinemas)"
                    v-model:isOpen="dropdowns.cinemas" :modelValue="cinemaOption"
                    @update:modelValue="handleCinemaChange" align="bottom" :withButton="false" />
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
                        <Badge :class="dropdowns['filters'] ? 'cursor-default' : 'cursor-pointer'"
                            v-if="selectedGenres.size > 1" type="solid">{{ selectedGenres.size
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