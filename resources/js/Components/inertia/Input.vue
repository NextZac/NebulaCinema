<script setup>
import { Search } from "lucide-vue-next";
const props = defineProps({
    type: String,
    placeholder: String
})
</script>

<template>
    <div
        class="w-auto flex items-center gap-3 p-4 bg-brand-950 border-0 rounded-[10px] text-body disabled:opacity-50 disabled:pointer-events-none">
        <Search class="w-5 h-5 text-brand-white" />
        <input :type="props.type" :placeholder="props.placeholder"
            class="bg-transparent border-transparent w-full h-full text-brand-white focus:ring-0 focus:border-transparent p-0">
    </div>
</template>