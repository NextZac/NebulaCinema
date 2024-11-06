<script setup>
import { ref, watch, onMounted } from "vue";

import { X } from "lucide-vue-next";

const props = defineProps({
    title: {
        type: String,
        default: "",
    },
    isOpen: {
        type: Boolean,
        default: false,
    },
    videoUrl: {
        type: String,
        default: "",
    },
});

onMounted(() => {
    props.videoUrl = `${props.videoUrl}?autoplay=1&frameborder=0`;
});

console.log(props.videoUrl);

const emit = defineEmits(["update:isOpen"]);

const isModalOpen = ref(props.isOpen);

watch(
    () => props.isOpen,
    (newValue) => {
        isModalOpen.value = newValue;
    },
);

const closeModal = () => {
    isModalOpen.value = false;
    emit("update:isOpen", false);
};
</script>

<template>
    <Transition name="modal">
        <div
            v-if="isModalOpen"
            class="fixed z-50 inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4"
        >
            <div
                class="bg-brand-975 rounded-lg shadow-xl max-w-[70%] max-h-[70%] h-full w-full border border-brand-900 drop-shadow-lg flex flex-col"
            >
                <div
                    class="flex justify-between items-center p-4 border-b border-brand-900"
                >
                    <h3 class="text-xl font-medium text-brand-white">
                        {{ props.title }}
                    </h3>
                    <button
                        @click="closeModal"
                        class="group hover:scale-125 active:scale-100 transition duration-100"
                    >
                        <X
                            class="w-6 h-6 text-brand-white group-hover:text-brand-600 transition duration-100"
                        />
                    </button>
                </div>
                <div class="grow w-full">
                    <iframe
                        class="w-[100%] h-[100%] rounded-b-lg"
                        :src="props.videoUrl"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        :allowfullscreen="true"
                    >
                    </iframe>
                </div>
            </div>
        </div>
    </Transition>
</template>

<style scoped>
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.1s ease-in;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}
</style>
