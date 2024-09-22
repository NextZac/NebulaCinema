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
                :class="[option.color ? `text-${option.color}` : 'text-brand-white', 'text-body select-none relative text-nowrap hover:text-brand-600']"
                :href="option.href">
                {{ option.title }}
            </a>
        </ul>
    </div>
</template>