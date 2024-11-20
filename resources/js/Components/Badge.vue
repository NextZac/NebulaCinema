<script setup>
const props = defineProps({
    type: String,
})

let typeClass = ''

switch (props.type) {
    case 'solid':
        typeClass = "bg-brand-900 "
        break;
    case 'bordered':
        typeClass = "border border-brand-white bg-brand-975 "
        break;
    default:
        typeClass = "bg-black/50 border border-brand-white "
}

</script>

<template>
    <span :class="[typeClass + 'text-brand-white px-[10px] py-[2px] rounded w-min h-min flex content-center drop-shadow-lg text-nowrap flex items-center']">
        <slot></slot>
    </span>
</template>