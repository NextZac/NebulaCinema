<script setup>

const props = defineProps({
    class: String,
})
</script>

<template>
    <div :class="[props.class, 'py-3 flex items-center text-xs text-brand-white before:flex-1 before:border-t before:border-brand-white before:me-6 after:flex-1 after:border-t after:border-brand-white after:ms-6']">
        <slot />
    </div>
</template>