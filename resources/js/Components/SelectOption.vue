<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue';
import { ChevronDown, Check } from 'lucide-vue-next';

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    isOpen: {
        type: Boolean,
        default: false,
    },
    modelValue: {
        type: [String, Number, Object],
        required: true
    },
    align: {
        type: String,
        default: 'bottom',
    },
    withButton: {
        type: Boolean,
        default: true
    },
    class: String
});

const emit = defineEmits(['update:modelValue']);
const isDropdownOpen = ref(props.isOpen);
const dropdownRef = ref(null);

console.log(isDropdownOpen.value);

watch(
    () => props.isOpen,
    (newValue) => {
        isDropdownOpen.value = newValue;
    },
);

const alignmentClasses = computed(() => {
    switch (props.align) {
        case 'left':
            return 'right-[110%]';
        case 'right':
            return 'left-[110%]';
        case 'top':
            return 'bottom-[110%]';
        default:
            return 'top-[110%]';
    }
});

const alignmentTransformAnimation = computed(() => {
    switch (props.align) {
        case 'left':
            return 'translateX(20px)';
        case 'right':
            return 'translateX(-20px)';
        case 'top':
            return 'translateY(20px)';
        default:
            return 'translateY(-20px)';
    }
})

const alignmentWidthAnimation = computed(() => {
    switch (props.align) {
        case 'left':
            return '0px';
        case 'right':
            return '0px';
        case 'top':
            return '100%';
        default:
            return '100%';
    }
})

const alignmentHeightAnimation = computed(() => {
    switch (props.align) {
        case 'left':
            return '300px';
        case 'right':
            return '300px';
        case 'top':
            return '0px';
        default:
            return '0px';
    }
})

const iconRotation = computed(() => {
    switch (props.align) {
        case 'left':
            return 'rotate-90';
        case 'right':
            return '-rotate-90';
        case 'top':
            return 'rotate-180';
        default:
            return 'rotate-0';
    }
});

const iconRotationActive = computed(() => {
    switch (props.align) {
        case 'left':
            return 'rotate-[270deg]';
        case 'right':
            return '-rotate-[270deg]';
        case 'top':
            return 'rotate-0';
        default:
            return 'rotate-180';
    }
});

const selectedOptionLabel = computed(() => {
    if (typeof props.options[0] === 'object' && 'title' in props.options[0]) {
        return props.modelValue;
    } else {
        const option = props.options[props.modelValue];
        return option ? option : props.options.includes(props.modelValue) ? props.modelValue : '';
    }
});

const selectOption = (option) => {
    if (typeof option === 'object' && 'title' in option) {
        // Handle language array
        emit('update:modelValue', option.title);
    } else if (typeof option === 'string') {
        // get index of string in options
        const index = props.options.indexOf(option);
        emit('update:modelValue', index);

    } else {
        emit('update:modelValue', option);
    }
    emit("update:isOpen", false);
};

const getOptionLabel = (option) => {
    if (typeof option === 'object' && 'title' in option) {
        return option.title;
    }
    return option;
};

const isSelected = (option) => {
    if (typeof props.options[props.options.indexOf(option)] === 'object' && 'title' in props.options[props.options.indexOf(option)]) {
        return props.modelValue === option.title;
    } else if (typeof option === 'string') {
        return props.modelValue === props.options.indexOf(option);
    } else {
        return props.modelValue === option;
    }
};

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const animationStyle = computed(() => ({
    transform: isDropdownOpen.value ? 'translateY(0px)' : alignmentTransformAnimation.value,
    opacity: isDropdownOpen.value ? '1' : '0',
    maxHeight: isDropdownOpen.value ? '100vh' : alignmentHeightAnimation.value,
    maxWidth: isDropdownOpen.value ? '100vw' : alignmentWidthAnimation.value,
    overflow: 'hidden',
    transition: 'transform 100ms ease-in-out, max-height 100ms ease-in, opacity 100ms ease-in-out, max-width 100ms ease-in',
    pointerEvents: isDropdownOpen.value ? 'auto' : 'none',
}));


const handleClickOutside = (event) => {
    if (
        isDropdownOpen.value &&
        dropdownRef.value &&
        !dropdownRef.value.contains(event.target)
    ) {
        emit("update:isOpen", false);
    }
};

onMounted(() => {
    document.addEventListener("mousedown", handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener("mousedown", handleClickOutside);
});
</script>

<template>
    <div v-if="props.withButton"
        :class="[props.class, 'relative flex text-left justify-center items-center w-full h-full border border-brand-600 hover:bg-brand-600/10', props.class ? '' : 'rounded-lg']">

        <!-- Dropdown button -->
        <button @click="toggleDropdown" type="button"
            :class="['pl-[12px] py-[8px] gap-4 flex items-center justify-center text-center bg-transparent text-brand-white focus:outline-none w-full h-full']"
            aria-haspopup="listbox" :aria-expanded="isDropdownOpen">
            <span class="">{{ selectedOptionLabel }}</span>
            <ChevronDown
                :class="['w-4 h-4 mr-[12px] transition-transform duration-100', isDropdownOpen ? iconRotationActive : iconRotation]">
            </ChevronDown>
        </button>

        <!-- Dropdown options -->
        <div ref="dropdownRef"
            :class="[alignmentClasses, 'absolute z-10 my-1 w-full bg-brand-975/80 border border-brand-900 shadow-lg backdrop-blur-md rounded-md text-base focus:outline-none']"
            :style="animationStyle">
            <div class="w-full h-full max-h-60 scroll-smooth overflow-auto sm:text-sm scrollbar-hide">
                <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                    aria-activedescendant="listbox-option-0">
                    <li v-for="(option, index) in props.options" :key="index"
                        class="text-brand-white cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-brand-600"
                        :id="`listbox-option-${index}`" role="option" @click="selectOption(option)">
                        <a v-if="option.href" :href="option.href" class="absolute w-full h-full inset-0"></a>
                        <span class="font-normal block truncate">
                            {{ getOptionLabel(option) }}
                        </span>
                        <span v-if="isSelected(option)"
                            class=" absolute inset-y-0 right-0 flex items-center pr-4 text-brand-400">
                            <Check class="w-4 h-4"></Check>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div v-else ref="dropdownRef"
        :class="[alignmentClasses, props.class, 'absolute z-10 my-1 w-full bg-brand-975/80 border border-brand-900 shadow-lg backdrop-blur-md rounded-md text-base focus:outline-none']"
        :style="animationStyle">
        <div class="w-full h-full max-h-60 scroll-smooth overflow-auto sm:text-sm scrollbar-hide">
            <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-0">
                <li v-for="(option, index) in props.options" :key="index"
                    class="text-brand-white cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-brand-600"
                    :id="`listbox-option-${index}`" role="option" @click="selectOption(option)">
                    <a v-if="option.href" :href="option.href" class="absolute w-full h-full inset-0"></a>
                    <span class="font-normal block truncate">
                        {{ getOptionLabel(option) }}
                    </span>
                    <span v-if="isSelected(option)"
                        class=" absolute inset-y-0 right-0 flex items-center pr-4 text-brand-400">
                        <Check class="w-4 h-4"></Check>
                    </span>
                </li>
            </ul>
        </div>
    </div>
</template>