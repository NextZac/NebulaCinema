<script setup>

const props = defineProps({
    checked: Boolean,
    id: String,
    class: String
});
</script>

<template>
    <div class="flex items-center gap-2">
        <input type="checkbox"
            class="bg-transparent focus:outline-none focus:ring-offset-0 focus:ring-0 rounded text-brand-600 disabled:opacity-50 cursor-pointer disabled:cursor-default disabled:pointer-events-none"
            :class="props.class" :id="props.id" :aria-labelledby="props.id + '-label'">
        <label class="text-sm select-none cursor-pointer text-brand-white text-nowrap" :id="props.id + '-label'" :for="props.id">
            <slot />
        </label>
    </div>
</template>
