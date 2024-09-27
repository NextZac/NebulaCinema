<script setup>

import { computed } from 'vue';

const props = defineProps({
    type: String,
    class: String
})

const typeClass = computed(() => {
    switch (props.type) {
        case 'error':
            return 'bg-brand-error/10 border border-brand-error'
        case 'warning':
            return 'bg-brand-warning/10 border border-brand-warning'
        case 'success':
            return 'bg-brand-success/10 border border-brand-success'
        case 'info':
            return 'bg-brand-info/10 border border-brand-info'
        default:
            return 'bg-brand-975/10 border border-brand-600'
    }
})

const titleClass = computed(() => {
    switch (props.type) {
        case 'error':
            return 'text-brand-error'
        case 'warning':
            return 'text-brand-warning'
        case 'success':
            return 'text-brand-success'
        case 'info':
            return 'text-brand-info'
        default:
            return 'text-brand-white'
    }
})

const descriptionClass = computed(() => {
    switch (props.type) {
        case 'error':
            return 'text-brand-error/75'
        case 'warning':
            return 'text-brand-warning/75'
        case 'success':
            return 'text-brand-success/75'
        case 'info':
            return 'text-brand-info/75'
        default:
            return 'text-brand-white/75'
    }
})

</script>

<template>
    <div :class="[typeClass, 'rounded-lg p-4']" role="alert" tabindex="-1">
        <div class="flex gap-3">
            <slot name="icon" />

            <!--Content-->
            <div :class="[props.class, 'flex flex-col gap-1 w-full']">
                <h3 :class="[titleClass, 'text-body font-semibold']">
                    <slot name="title" />
                </h3>
                <div :class="[descriptionClass, 'text-body']">
                    <slot name="description" />
                </div>
            </div>
        </div>
    </div>
</template>