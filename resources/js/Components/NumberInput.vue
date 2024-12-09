<template>
    <div
        class="py-2 px-3 inline-block bg-white border border-gray-200 rounded-lg dark:bg-neutral-900 dark:border-neutral-700"
    >
        <div class="flex items-center gap-x-1.5">
            <!-- Decrement Button -->
            <button
                type="button"
                @click="decrement"
                :disabled="value <= min"
                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                aria-label="Decrease"
            >
                <svg
                    class="shrink-0 size-3.5"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M5 12h14"></path>
                </svg>
            </button>

            <!-- Input Field -->
            <input
                type="number"
                v-model.number="value"
                :min="min"
                :max="max"
                class="p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white"
                style="-moz-appearance: textfield"
                aria-roledescription="Number field"
            />

            <!-- Increment Button -->
            <button
                type="button"
                @click="increment"
                :disabled="value >= max"
                class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                aria-label="Increase"
            >
                <svg
                    class="shrink-0 size-3.5"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";

// Props
const props = defineProps({
    modelValue: Number,
    min: {
        type: Number,
        default: 0,
    },
    max: {
        type: Number,
        default: 10,
    },
});

// Local state to manage the input value
const value = ref(props.modelValue);

// Emit value changes to the parent
const emit = defineEmits(["update:modelValue"]);

watch(value, (newValue) => {
    emit("update:modelValue", newValue);
});

// Increment and decrement handlers
const increment = () => {
    if (value.value < props.max) {
        value.value++;
    }
};

const decrement = () => {
    if (value.value > props.min) {
        value.value--;
    }
};
</script>
