<script setup>
import { ref, computed } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Button from "@/Components/Button.vue";
import SeatMap from "@/Components/SeatMap.vue";
import NumberInput from "@/Components/NumberInput.vue";

const steps = ref(1);

// Ticket selection
const ticketTypes = ref([
    { type: "Standard", price: 10, selected: 0 },
    { type: "VIP", price: 15, selected: 0 },
]);

const totalTickets = computed(() => {
    return ticketTypes.value.reduce((sum, ticket) => sum + ticket.selected, 0);
});

// Seat selection
const seatRows = 10;
const seatColumns = 10;
const seats = ref(
    Array.from({ length: seatRows }, () => Array(seatColumns).fill(1)),
);

// Payment method
const paymentMethods = ref(["Credit Card", "PayPal", "Apple Pay"]);
const selectedPaymentMethod = ref("");

// Step navigation
const nextStep = () => {
    if (steps.value < 3) steps.value++;
};

const prevStep = () => {
    if (steps.value > 1) steps.value--;
};
</script>

<template>
    <GuestLayout>
        <div class="w-full flex flex-col gap-[60px]">
            <!-- Step Navigation -->
            <div class="flex items-center justify-center gap-4">
                <Button
                    v-if="steps > 1"
                    color="brand-900"
                    class="font-semibold"
                    @click="prevStep"
                >
                    {{ __("checkout.previous") }}
                </Button>
                <Button
                    v-if="steps < 3"
                    color="brand-900"
                    class="font-semibold"
                    :disabled="steps === 1 && totalTickets === 0"
                    @click="nextStep"
                >
                    {{ __("checkout.next") }}
                </Button>
            </div>

            <!-- Step 1: Ticket Selection -->
            <div
                v-if="steps === 1"
                class="bg-brand-975 shadow-md rounded-lg p-6"
            >
                <h2 class="text-2xl font-bold mb-6 text-brand-white">
                    {{ __("checkout.choose_tickets") }}
                </h2>
                <div class="flex flex-col gap-4">
                    <div
                        v-for="ticket in ticketTypes"
                        :key="ticket.type"
                        class="flex justify-between items-center border-b border-brand-900 py-2"
                    >
                        <div>
                            <h3 class="text-lg font-semibold text-brand-white">
                                {{ ticket.type }}
                            </h3>
                            <p class="text-sm text-gray-400">
                                {{ __("checkout.price") }}: {{ ticket.price }}€
                            </p>
                        </div>
                        <NumberInput
                            v-model="ticket.selected"
                            :min="0"
                            :max="10"
                        />
                    </div>
                </div>
            </div>

            <!-- Step 2: Seat Selection -->
            <div
                v-if="steps === 2"
                class="bg-brand-975 shadow-md rounded-lg p-6"
            >
                <h2 class="text-2xl font-bold mb-6 text-brand-white">
                    {{ __("checkout.choose_seats") }}
                </h2>
                <SeatMap
                    :rows="seatRows"
                    :columns="seatColumns"
                    :seats="seats"
                    :selectedSeatAmount="totalTickets"
                    @seatSelected="
                        (selectedSeats) => console.log(selectedSeats)
                    "
                />
            </div>

            <!-- Step 3: Payment Method -->
            <div
                v-if="steps === 3"
                class="bg-brand-975 shadow-md rounded-lg p-6"
            >
                <h2 class="text-2xl font-bold mb-6 text-brand-white">
                    {{ __("checkout.choose_payment") }}
                </h2>
                <div class="flex flex-col gap-4">
                    <div
                        v-for="method in paymentMethods"
                        :key="method"
                        class="flex items-center gap-4"
                    >
                        <input
                            type="radio"
                            :id="method"
                            v-model="selectedPaymentMethod"
                            :value="method"
                        />
                        <label
                            :for="method"
                            class="text-brand-white font-medium"
                        >
                            {{ method }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Add specific styles for your checkout page as needed */
</style>
