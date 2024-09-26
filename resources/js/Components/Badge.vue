<script setup>
const props = defineProps({
    type: String,
})

let typeClass = ''

switch (props.type) {
    case 'solid':
        typeClass = "bg-brand-900 "
        break;
    default:
        typeClass = "bg-black/30 border border-brand-white "
}

</script>

<template>
    <span :class="[typeClass + 'text-brand-white px-[10px] py-[2px] rounded w-min h-min flex content-center drop-shadow-lg text-nowrap']">
        <slot></slot>
    </span>
</template>