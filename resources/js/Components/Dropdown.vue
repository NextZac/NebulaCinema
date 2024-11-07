<script setup>
import { ref, watch, computed, onMounted, onUnmounted } from "vue";

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    isOpen: {
        type: Boolean,
        default: false,
    },
    align: {
        type: String,
        default: "bottom",
    },
    class: String,
});

const emit = defineEmits(["update:isOpen", "select"]);
const isDropdownOpen = ref(props.isOpen);
const dropdownRef = ref(null);

const alignmentClasses = computed(() => {
    switch (props.align) {
        case "left":
            return "right-[110%]";
        case "right":
            return "left-[110%]";
        case "top":
            return "bottom-[110%]";
        default:
            return "top-[110%]";
    }
});

const alignmentTransformAnimation = computed(() => {
    switch (props.align) {
        case "left":
            return "translateX(20px)";
        case "right":
            return "translateX(-20px)";
        case "top":
            return "translateY(20px)";
        default:
            return "translateY(-20px)";
    }
});

const alignmentWidthAnimation = computed(() => {
    switch (props.align) {
        case "left":
            return "0px";
        case "right":
            return "0px";
        case "top":
            return "min-content";
        default:
            return "min-content";
    }
});

const alignmentHeightAnimation = computed(() => {
    switch (props.align) {
        case "left":
            return "min-content";
        case "right":
            return "min-content";
        case "top":
            return "0px";
        default:
            return "0px";
    }
});

function colorSelect(index) {
    switch (props.options[index].color) {
        case "100":
            return "text-brand-100 hover:text-brand-200";
        case "200":
            return "text-brand-200 hover:text-brand-300";
        case "300":
            return "text-brand-300 hover:text-brand-400";
        case "400":
            return "text-brand-400 hover:text-brand-500";
        case "500":
            return "text-brand-500 hover:text-brand-600";
        case "600":
            return "text-brand-600 hover:text-brand-700";
        case "700":
            return "text-brand-700 hover:text-brand-800";
        case "800":
            return "text-brand-800 hover:text-brand-900";
        case "900":
            return "text-brand-900 hover:text-brand-950";
        case "warning":
            return "text-brand-white hover:text-brand-warning";
        case "error":
            return "text-brand-white hover:text-brand-error";
        case "success":
            return "text-brand-white hover:text-brand-success";
        case "info":
            return "text-brand-white hover:text-brand-info";
        default:
            return "text-brand-white hover:text-brand-600";
    }
}

watch(
    () => props.isOpen,
    (newValue) => {
        isDropdownOpen.value = newValue;
    },
);

const dropdownStyle = computed(() => ({
    transform: isDropdownOpen.value
        ? "translateY(0px)"
        : alignmentTransformAnimation.value,
    opacity: isDropdownOpen.value ? "1" : "0",
    maxHeight: isDropdownOpen.value ? "100vh" : alignmentHeightAnimation.value,
    maxWidth: isDropdownOpen.value ? "100vw" : alignmentWidthAnimation.value,
    overflow: "hidden",
    transition:
        "transform 100ms ease-in-out, max-height 100ms ease-in, opacity 100ms ease-in-out, max-width 100ms ease-in",
    pointerEvents: isDropdownOpen.value ? "auto" : "none",
}));

const handleClickOutside = (event) => {
    if (
        isDropdownOpen.value &&
        dropdownRef.value &&
        !dropdownRef.value.contains(event.target)
    ) {
        emit("update:isOpen", false);
    }
};

onMounted(() => {
    document.addEventListener("mousedown", handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener("mousedown", handleClickOutside);
});
</script>

<template>
    <div
        ref="dropdownRef"
        :class="[
            props.class,
            alignmentClasses,
            'absolute z-20 my-1 w-min bg-brand-975 border border-brand-900 shadow-lg rounded-md text-base sm:text-sm',
        ]"
        :style="dropdownStyle"
    >
        <ul
            tabindex="-1"
            class="flex flex-col gap-[15px] p-[15px] pr-[50px] overflow-auto scroll-smooth scrollbar-hide"
        >
            <a
                v-for="(option, index) in props.options"
                :key="index"
                :class="[
                    colorSelect(index),
                    'text-body select-none relative text-nowrap flex items-center',
                ]"
                :href="option.href"
                @click.prevent="emit('select', option)"
            >
                {{ option.title }}
            </a>
        </ul>
    </div>
</template>
