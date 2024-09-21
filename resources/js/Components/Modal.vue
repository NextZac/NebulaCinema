<script setup>
import { ref, watch } from 'vue';

import { X } from 'lucide-vue-next';

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    isOpen: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['update:isOpen']);

const isModalOpen = ref(props.isOpen);

watch(() => props.isOpen, (newValue) => {
    isModalOpen.value = newValue;
});

const closeModal = () => {
    isModalOpen.value = false;
    emit('update:isOpen', false);
};
</script>

<template>
    <Transition name="modal">
        <div v-if="isModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-brand-975 rounded-lg shadow-xl max-w-md w-full border border-brand-900 drop-shadow-lg">
                <div class="flex justify-between items-center p-4 border-b border-brand-900">
                    <h3 class="text-xl font-medium text-brand-white">
                        {{ props.title }}
                    </h3>
                    <button @click="closeModal" class="group hover:scale-125 active:scale-100 transition duration-100">
                        <X class="w-6 h-6 text-brand-white group-hover:text-brand-600 transition duration-100" />
                    </button>
                </div>
                <div class="p-4">
                    <slot name="content" />
                </div>
                <div class="flex justify-end gap-3 p-4 border-t border-brand-900">
                    <slot name="buttons" />
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