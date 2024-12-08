<script setup>
import { computed, ref } from "vue";
import { Armchair } from "lucide-vue-next";

// Props
const props = defineProps({
    rows: { type: Number, required: true },
    columns: { type: Number, required: true },
    seats: { type: Array, required: true }, // Matrix of seat availability
    selectedSeatAmount: { type: Number, default: 1 }, // Max number of selectable seats
});

// Emit event for seat selection
const emit = defineEmits(["seatSelected"]);

// Seat dimensions and spacing
const seatSize = 30; // Seat icon size in px
const seatSpacing = 5; // Gap between seats

// Track selected seats
const selectedSeats = ref([]); // Array of { row, col } objects

// Calculate total map width for centering
const mapWidth = computed(() => props.columns * (seatSize + seatSpacing));

// Select or unselect a seat
const toggleSeatSelection = (rowIndex, colIndex) => {
    const seatIndex = selectedSeats.value.findIndex(
        (seat) => seat.row === rowIndex && seat.col === colIndex,
    );

    // If the seat is already selected, unselect it
    if (seatIndex !== -1) {
        selectedSeats.value.splice(seatIndex, 1);
        props.seats[rowIndex][colIndex] = 1; // Mark seat as available
    } else {
        // Add the new seat
        if (selectedSeats.value.length >= props.selectedSeatAmount) {
            // Unselect the earliest selected seat if limit is reached
            const removedSeat = selectedSeats.value.shift();
            props.seats[removedSeat.row][removedSeat.col] = 1; // Mark it as available
        }
        selectedSeats.value.push({ row: rowIndex, col: colIndex });
        props.seats[rowIndex][colIndex] = 2; // Mark seat as reserved
    }

    // Emit the updated list of selected seats
    emit("seatSelected", selectedSeats.value);
};
</script>

<template>
    <div class="seat-map-container">
        <!-- Screen -->
        <div class="screen">
            <span>Screen</span>
        </div>

        <!-- Seat Map -->
        <div class="seat-map" :style="{ width: `${mapWidth}px` }">
            <div
                v-for="(row, rowIndex) in seats"
                :key="'row-' + rowIndex"
                class="seat-row"
            >
                <div
                    v-for="(seat, colIndex) in row"
                    :key="'seat-' + rowIndex + '-' + colIndex"
                    :class="[
                        'seat',
                        seat === 0
                            ? 'taken'
                            : seat === 1
                              ? 'available'
                              : seat === 2
                                ? 'reserved'
                                : '',
                    ]"
                    @click="
                        seat === 1 && toggleSeatSelection(rowIndex, colIndex)
                    "
                    :title="seat === 0 ? 'Seat Taken' : 'Seat Available'"
                    class="mx-1"
                >
                    <Armchair alt="Seat" />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Screen styling */
.screen {
    text-align: center;
    background: #ccc;
    padding: 10px;
    margin: 20px auto;
    border-radius: 10px;
    width: 80%;
    font-weight: bold;
    font-size: 1.2rem;
}

/* Seat map container */
.seat-map-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 20px 0;
}

/* Seat map grid */
.seat-map {
    display: grid;
    gap: 5px;
}

.seat-row {
    display: flex;
    justify-content: center;
    margin-bottom: 5px;
}

/* Seat styling */
.seat {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.seat img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* Available seat */
.seat.available {
    background-color: #4caf50; /* Green for available seats */
    border-radius: 50%;
}

.seat.reserved {
    background-color: #ffa500; /* Orange for reserved */
    border-radius: 50%;
}

/* Taken seat */
.seat.taken {
    background-color: #f44336; /* Red for taken seats */
    border-radius: 50%;
    cursor: not-allowed;
    opacity: 0.6;
}
</style>
