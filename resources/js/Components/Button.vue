<script setup>
import { computed } from 'vue';

const props = defineProps({
    type: {
        type: String,
        default: 'default'
    },
    color: {
        type: String,
        default: 'brand-600'
    },
    class: String
});

const colorSolid = computed(() => {
    switch (props.color) {
        case 'brand-100':
            return 'bg-brand-100 hover:bg-brand-200 focus:bg-brand-200';
        case 'brand-200':
            return 'bg-brand-200 hover:bg-brand-300 focus:bg-brand-300';
        case 'brand-300':
            return 'bg-brand-300 hover:bg-brand-400 focus:bg-brand-400';
        case 'brand-400':
            return 'bg-brand-400 hover:bg-brand-500 focus:bg-brand-500';
        case 'brand-500':
            return 'bg-brand-500 hover:bg-brand-600 focus:bg-brand-600';
        case 'brand-700':
            return 'bg-brand-700 hover:bg-brand-800 focus:bg-brand-800';
        case 'brand-800':
            return 'bg-brand-800 hover:bg-brand-900 focus:bg-brand-900';
        case 'brand-900':
            return 'bg-brand-900 hover:bg-brand-950 focus:bg-brand-950';
        default:
            return 'bg-brand-600 hover:bg-brand-700 focus:bg-brand-700';
    }
})

const colorOutline = computed(() => {
    switch (props.color) {
        case 'brand-100':
            return 'border-brand-100 text-brand-100 hover:bg-brand-200/10 hover:border-brand-200 hover:text-brand-200 focus:bg-brand-200/10';
        case 'brand-200':
            return 'border-brand-200 text-brand-200 hover:bg-brand-300/10 hover:border-brand-300 hover:text-brand-300 focus:bg-brand-300/10';
        case 'brand-300':
            return 'border-brand-300 text-brand-300 hover:bg-brand-400/10 hover:border-brand-400 hover:text-brand-400 focus:bg-brand-400/10';
        case 'brand-400':
            return 'border-brand-400 text-brand-400 hover:bg-brand-500/10 hover:border-brand-500 hover:text-brand-500 focus:bg-brand-500/10';
        case 'brand-500':
            return 'border-brand-500 text-brand-500 hover:bg-brand-600/10 hover:border-brand-600 hover:text-brand-600 focus:bg-brand-600/10';
        case 'brand-700':
            return 'border-brand-700 text-brand-700 hover:bg-brand-800/10 hover:border-brand-800 hover:text-brand-800 focus:bg-brand-800/10';
        case 'brand-800':
            return 'border-brand-800 text-brand-800 hover:bg-brand-900/10 hover:border-brand-900 hover:text-brand-900 focus:bg-brand-900/10';
        case 'brand-900':
            return 'border-brand-900 text-brand-900 hover:bg-brand-950/10 hover:border-brand-950 hover:text-brand-950 focus:bg-brand-950/10';
        default:
            return 'border-brand-600 text-brand-600 hover:bg-brand-700/10 hover:border-brand-700 hover:text-brand-700 focus:bg-brand-700/10';
    }
})

const typeClass = computed(() => {
    switch (props.type) {
        case 'outline':
            return {
                'border': true,
                'focus:outline-none': true,
                [colorOutline.value]: true,
            };
        default:
            return {
                'border-transparent': true,
                'focus:outline-none': true,
                'text-white': true,
                [colorSolid.value]: true,
            };
    }
});

// switch (props.type) {
//     case 'outline':
//         typeClass = `border border-${color} text-${color} hover:bg-${activeColor}/10 hover:border-${activeColor} hover:text-${activeColor} focus:outline-none focus:bg-${activeColor}/10`
//         break;
//     default:
//         typeClass = "border-transparent bg-brand-600 hover:bg-brand-700 focus:outline-none focus:bg-brand-700 text-brand-white"
// }

</script>

<template>
    <button type="button"
        :class="[typeClass, props.class, 'py-[14px] px-[16px] rounded w-min h-min flex content-center items-center text-center drop-shadow-lg text-nowrap disabled:opacity-50 disabled:pointer-events-none hover:scale-105 active:scale-100 transition duration-100']">
        <slot />
    </button>
</template>
