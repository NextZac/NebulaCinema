<script setup>
import { computed } from "vue";
const props = defineProps({
    size: {
        type: String,
        default: "lg",
    },
    type: {
        default: null,
    },
    icon: {
        default: null,
    },
});
</script>

<template>
    <button
        type="button"
        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
        :class="{
            'px-4 py-3 text-base': size === 'lg',
            'px-2 py-1 text-xs': size === 'sm',
            'py-3 px-4 text-lg': size === 'md',
            'bg-gray-300 text-gray-800 hover:bg-gray-400 focus:bg-gray-400':
                type === 'secondary',
            'bg-red-600 hover:bg-red-700 focus:bg-red-700': type === 'danger',
            'bg-green-600 hover:bg-green-700 focus:bg-green-700':
                type === 'success',
            'bg-yellow-600 hover:bg-yellow-700 focus:bg-yellow-700':
                type === 'warning',
            'bg-gray-600 hover:bg-gray-700 focus:bg-gray-700': type === 'dark',
            'bg-white text-gray-800 hover:bg-gray-100 focus:bg-gray-100':
                type === 'light',
            'bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700': !type,
        }"
    >
        <slot />
    </button>
</template>
