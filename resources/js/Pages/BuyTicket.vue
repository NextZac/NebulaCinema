<script setup>
import { ref, computed } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Button from "@/Components/Button.vue";
import SeatMap from "@/Components/SeatMap.vue";
import NumberInput from "@/Components/NumberInput.vue";
import Input from "@/Components/Input.vue";
import { Mail, Lock } from "lucide-vue-next";

const steps = ref(1);

const props = defineProps({
    cinema_room: Object,
    movie: Object,
});

const form = ref({
    email: "",
    password: "",
    seats: [],
    paymentMethod: "",
});

// Ticket selection
const ticketTypes = ref([
    { type: "Standard", price: 10, selected: 0 },
    { type: "VIP", price: 15, selected: 0 },
]);

const totalTickets = computed(() => {
    return ticketTypes.value.reduce((sum, ticket) => sum + ticket.selected, 0);
});

// Seat selection
const seatRows = props.cinema_room.rows;
const seatColumns = props.cinema_room.columns;
const seats = ref(
    Array.from({ length: seatRows }, () => Array(seatColumns).fill(1)),
);

const chosenSeats = ref({});
const loginOrGuest = ref(false);

// Payment method
const paymentMethods = ref(["Credit Card", "PayPal", "Apple Pay"]);
const selectedPaymentMethod = ref("Credit Card");

// Step navigation
const nextStep = () => {
    if (steps.value < 3) steps.value++;
};

const prevStep = () => {
    if (steps.value > 1) steps.value--;
};

const acceptedTerms = ref(false);
const selectPaymentMethod = (method) => {
    selectedPaymentMethod.value = method;
};
// Login logic
const handleLogin = async () => {
    if (!loginOrGuest.value) {
        loginOrGuest.value = true;
        return;
    } else {
        try {
            const response = await axios.post("/login", {
                email: form.value.email,
                password: form.value.password,
            });
            if (response.status === 200) {
                alert("Login successful");
                // Handle success logic (e.g., redirect to another page)
            }
        } catch (error) {
            console.error(
                "Login failed:",
                error.response?.data || error.message,
            );
            alert("Login failed. Please check your credentials.");
        }
    }
};

const handleGuestContinue = () => {
    if (loginOrGuest) {
        loginOrGuest.value = false;
        return;
    }
    if (form.value.email) {
        loginOrGuest.value = false; // Switch to guest
        nextStep();
    } else {
        alert("Please enter an email to continue as a guest.");
    }
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
                        (selectedSeats) => (chosenSeats.value = selectedSeats)
                    "
                />
            </div>

            <!-- Step 3: Payment Method -->
            <div v-if="steps >= 3" class="flex gap-6">
                <!-- Left Section -->
                <div
                    v-if="steps === 3"
                    class="flex-1 bg-brand-975 shadow-md rounded-lg p-6"
                >
                    <h2 class="text-2xl font-bold mb-6 text-brand-white">
                        {{ __("checkout.purchase_email") }}
                    </h2>
                    <div>
                        <Input
                            type="text"
                            v-model="form.email"
                            :placeholder="__('login.input.email')"
                            class="bg-brand-975"
                        >
                            <Mail class="w-5 h-5 text-brand-white" />
                        </Input>
                        <Input
                            v-if="loginOrGuest"
                            type="password"
                            v-model="form.password"
                            :placeholder="__('login.input.password')"
                            class="bg-brand-975 mt-4"
                        >
                            <Lock class="w-5 h-5 text-brand-white" />
                        </Input>
                        <div class="flex justify-end gap-4 mt-8">
                            <Button
                                class="bg-brand-primary text-brand-white px-4 py-2 rounded-lg font-medium"
                                @click="handleGuestContinue"
                            >
                                {{ __("checkout.continue_as_guest") }}
                            </Button>
                            <Button
                                class="bg-brand-primary text-brand-white px-4 py-2 rounded-lg font-medium"
                                @click="handleLogin"
                            >
                                {{ __("login.title.login") }}
                            </Button>
                        </div>
                    </div>
                </div>

                <div
                    v-if="steps === 4"
                    class="flex-1 bg-brand-975 shadow-md rounded-lg p-6"
                >
                    <h2 class="text-2xl font-bold mb-6 text-brand-white">
                        {{ __("checkout.choose_payment") }}
                    </h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            v-for="method in paymentMethods"
                            :key="method"
                            @click="selectPaymentMethod(method)"
                            :class="[
                                'cursor-pointer p-4 rounded-lg shadow-md flex items-center justify-center transition-transform transform',
                                selectedPaymentMethod === method
                                    ? 'bg-brand-primary scale-105 text-brand-white'
                                    : 'bg-brand-950 hover:scale-105 text-brand-gray',
                            ]"
                        >
                            <span class="text-lg font-medium">
                                {{ method }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div
                    class="w-full md:w-1/3 lg:w-1/4 bg-brand-900 shadow-md rounded-lg p-6 ml-auto"
                >
                    <h3 class="text-xl font-bold text-brand-white mb-4">
                        {{ __("checkout.selected_seats") }}
                    </h3>
                    <ul class="mb-6">
                        <li
                            v-for="seat in chosenSeats.value"
                            :key="'seat-details-' + seat.row + '-' + seat.col"
                            class="text-brand-white bg-brand-950 rounded-lg my-4 text-center p-2"
                        >
                            Rida {{ seat.row + 1 }}, Iste {{ seat.col + 1 }}
                        </li>
                    </ul>

                    <div class="flex items-start gap-2 mb-4">
                        <input
                            type="checkbox"
                            id="acceptTerms"
                            v-model="acceptedTerms"
                            class="mt-1"
                        />
                        <label for="acceptTerms" class="text-brand-white">
                            {{ __("checkout.accept_terms") }}
                        </label>
                    </div>

                    <Button
                        :disabled="!acceptedTerms"
                        class="bg-brand-primary text-brand-white px-4 py-2 rounded-lg font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                        @click="handleProceed"
                    >
                        {{
                            isLoggedIn
                                ? __("checkout.proceed_payment")
                                : __("checkout.login_or_guest")
                        }}
                    </Button>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
