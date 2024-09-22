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

const animationStyle = computed(() => ({
    transform: isOpen.value ? 'translateY(0px)' : 'translateY(-20px)',
    opacity: isOpen.value ? '1' : '0',
    maxHeight: isOpen.value ? '300px' : '0px',
    overflow: 'hidden',
    transition: 'transform 100ms ease-in-out, max-height 100ms ease-in-out, opacity 100ms ease-in-out',
}));
</script>

<template>
    <div :class="[props.class, 'relative flex text-left w-full h-full border border-brand-600 hover:bg-brand-600/10']">
        <button @click="toggleDropdown" type="button"
            :class="['pl-[12px] py-[8px] gap-4 flex items-center justify-center text-center bg-transparent text-brand-white focus:outline-none w-full h-full']"
            aria-haspopup="listbox" :aria-expanded="isOpen">
            <span class="">{{ selectedOptionLabel }}</span>
            <ChevronDown :class="['w-4 h-4 mr-[12px] transition-transform duration-100', isOpen ? 'rotate-180' : '']"></ChevronDown>
        </button>

            <div
                class="absolute top-[110%] z-10 mt-1 w-full bg-brand-700 shadow-lg max-h-60 rounded-md py-1 text-base overflow-auto focus:outline-none sm:text-sm scroll-smooth scrollbar-hide" :style="animationStyle">
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
    </div>
</template>