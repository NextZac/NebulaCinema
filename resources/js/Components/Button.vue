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

console.log(props.color)

const baseColor = computed(() => props.color);
const activeColor = computed(() => {
    const [prefix, shade] = props.color.split('-');
    const activeShade = parseInt(shade) + 100;
    return `${prefix}-${activeShade}`;
});

const typeClass = computed(() => {
    switch (props.type) {
        case 'outline':
            return {
                'border': true,
                [`border-${baseColor.value}`]: true,
                [`text-${baseColor.value}`]: true,
                [`hover:bg-${activeColor.value}/10`]: true,
                [`hover:border-${activeColor.value}`]: true,
                [`hover:text-${activeColor.value}`]: true,
                'focus:outline-none': true,
                [`focus:bg-${activeColor.value}/10`]: true
            };
        default:
            return {
                'border-transparent': true,
                [`bg-${baseColor.value}`]: true,
                [`hover:bg-${activeColor.value}`]: true,
                'focus:outline-none': true,
                [`focus:bg-${activeColor.value}`]: true,
                'text-white': true
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
