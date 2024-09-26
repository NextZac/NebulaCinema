<script setup>
import { ref, watch, computed, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    isOpen: {
        type: Boolean,
        default: false
    },
    class: String
});

const emit = defineEmits(['update:isOpen']);
const isDropdownOpen = ref(props.isOpen);
const dropdownRef = ref(null);

function colorSelect(index) {
    switch (props.options[index].color) {
        case '100':
            return 'text-brand-100 hover:text-brand-200';
        case '200':
            return 'text-brand-200 hover:text-brand-300';
        case '300':
            return 'text-brand-300 hover:text-brand-400';
        case '400':
            return 'text-brand-400 hover:text-brand-500';
        case '500':
            return 'text-brand-500 hover:text-brand-600';
        case '600':
            return 'text-brand-600 hover:text-brand-700';
        case '700':
            return 'text-brand-700 hover:text-brand-800';
        case '800':
            return 'text-brand-800 hover:text-brand-900';
        case '900':
            return 'text-brand-900 hover:text-brand-950';
        case 'warning':
            return 'text-brand-white hover:text-brand-warning';
        case 'error':
            return 'text-brand-white hover:text-brand-error';
        case 'success':
            return 'text-brand-white hover:text-brand-success';
        case 'info':
            return 'text-brand-white hover:text-brand-info';
        default:
            return 'text-brand-white hover:text-brand-600';
    }
}

watch(() => props.isOpen, (newValue) => {
    isDropdownOpen.value = newValue;
});

const dropdownStyle = computed(() => ({
    transform: isDropdownOpen.value ? 'translateY(0px)' : 'translateY(-20px)',
    opacity: isDropdownOpen.value ? '1' : '0',
    maxHeight: isDropdownOpen.value ? '300px' : '0px',
    overflow: 'hidden',
    transition: 'transform 100ms ease-in-out, max-height 100ms ease-in-out, opacity 100ms ease-in-out',
    pointerEvents: isDropdownOpen.value ? 'auto' : 'none',
}));

const handleClickOutside = (event) => {
    if (isDropdownOpen.value && dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        emit('update:isOpen', false);
    }
};

onMounted(() => {
    document.addEventListener('mousedown', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('mousedown', handleClickOutside);
});
</script>

<template>
    <div ref="dropdownRef"
        :class="[props.class, 'absolute top-10 z-10 mt-1 w-min bg-brand-975 border border-brand-900 shadow-lg rounded-md py-1 text-base sm:text-sm']"
        :style="dropdownStyle">
        <ul tabindex="-1"
            class="flex flex-col gap-[15px] p-[15px] pr-[50px] overflow-auto max-h-60 scroll-smooth scrollbar-hide">
            <a v-for="(option, index) in props.options" :key="index"
                :class="[colorSelect(index), 'text-body select-none relative text-nowrap']" :href="option.href">
                {{ option.title }}
            </a>
        </ul>
    </div>
</template>