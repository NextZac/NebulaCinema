<script setup>
const props = defineProps({
    type: {
        type: String,
        default: 'normal',
    },
    message: {
        type: String,
        default: 'This is a normal message.',
    },
    icon: {
        type: String,
        default: 'info',
    },
    iconColor: {
        type: String,
        default: 'blue',
    },
    iconSize: {
        type: String,
        default: '4',
    },
    iconClasses: {
        type: String,
        default: 'mt-0.5',
    },
    classes: {
        type: String,
        default: 'bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700',
    },
    labelId: {
        type: String,
        default: 'hs-toast-normal-example-label',
    },
    role: {
        type: String,
        default: 'alert',
    },
    tabIndex: {
        type: String,
        default: '-1',
    },
});
</script

<template>
    <div
        class="flex items-center p-4 bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-neutral-800 dark:border-neutral-700"
        role="alert"
        aria-labelledby="hs-toast-normal-example-label"
        tabindex="-1"
    >
        <div class="flex p-4">
            <div class="shrink-0">
                <svg
                    class="shrink-0 size-4 text-blue-500 mt-0.5"
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
                    ></path>
                </svg>
            </div>
            <div class="ms-3">
                <p
                    id="hs-toast-normal-example-label"
                    class="text-sm text-gray-700 dark:text-neutral-400"
                >
                    This is a normal message.
                </p>
            </div>
        </div>
    </div>
</template>
