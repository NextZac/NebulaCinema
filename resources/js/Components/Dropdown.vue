<script setup>
import { ref, computed } from 'vue';

import { ChevronDown, Check } from 'lucide-vue-next';

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: [String, Number, Object],
        required: true
    },
    class: String
});

const emit = defineEmits(['update:modelValue']);

const isOpen = ref(false);

const selectedOptionLabel = computed(() => {
    const option = props.options[props.modelValue];
    return option ? option : props.options.includes(props.modelValue) ? props.modelValue : '';
});

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
};

const selectOption = (option) => {
    if (typeof option === 'string') {
        // get index of string in options
        const index = props.options.indexOf(option);
        emit('update:modelValue', index);
    } else {
        emit('update:modelValue', option);  
    }
    isOpen.value = false;
};

const getOptionLabel = (option) => {
    return option;
};

const isSelected = (option) => {
    if (typeof option === 'string') {
        return props.modelValue === props.options.indexOf(option);
    } else {
        return props.modelValue === option;
    }
};
</script>

<template>
    <div :class="[props.class, 'relative flex text-left w-full h-full border border-brand-600 hover:bg-brand-600/10']">
        <button @click="toggleDropdown" type="button"
            :class="['pl-[12px] py-[8px] gap-4 flex items-center justify-center text-center bg-transparent text-brand-white focus:outline-none w-full h-full']"
            aria-haspopup="listbox" :aria-expanded="isOpen">
            <span class="">{{ selectedOptionLabel }}</span>
            <ChevronDown class="w-4 h-4 mr-[12px]"></ChevronDown>
        </button>

        <transition enter-active-class="transition ease-out duration-100"
            enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-if="isOpen"
                class="absolute top-10 z-10 mt-1 w-full bg-brand-700 shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm scroll-smooth scrollbar-hide">
                <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                    aria-activedescendant="listbox-option-0">
                    <li v-for="(option, index) in props.options" :key="index"
                        class="text-brand-white cursor-default select-none relative py-2 pl-3 pr-9 hover:bg-brand-600"
                        :id="`listbox-option-${index}`" role="option" @click="selectOption(option)">
                        <span class="font-normal block truncate">
                            {{ getOptionLabel(option) }}
                        </span>
                        <span v-if="isSelected(option)"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-brand-400">
                            <Check class="w-4 h-4"></Check>
                        </span>
                    </li>
                </ul>
            </div>
        </transition>
    </div>
</template>