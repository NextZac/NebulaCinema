<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Badge from "@/Components/Badge.vue";
import Alert from "@/Components/Alert.vue";
import { AlertCircle } from "lucide-vue-next";
import { SquarePlay, ShoppingBasket } from "lucide-vue-next";
import Button from "../Components/Button.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    movie: Object,
    sessions: Object,
    image: String,
});

const formatDate = (dateString) => new Date(dateString).toLocaleDateString();
const formatTime = (timeString) =>
    new Date(timeString).toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
    });

for (const session of props.sessions) {
    console.log(session);
}

const buyTicket = (sessionId) => {
    router.visit(route("BuyTickets", sessionId));
};
</script>

<template>
    <Head :title="movie.title" />

    <GuestLayout>
        <div class="w-full flex flex-col gap-[60px]">
            <!-- Movie Header with Image -->
            <div class="relative w-full h-[400px] md:h-[500px] drop-shadow-lg">
                <img
                    :src="image"
                    class="w-full h-full object-cover object-center rounded-lg"
                />
                <div class="absolute inset-0 bg-black/50 flex items-end p-6">
                    <div>
                        <h1
                            class="text-4xl md:text-5xl font-bold text-brand-white"
                        >
                            {{ movie.title }}
                        </h1>
                        <h2 class="text-xl text-brand-white/50 italic">
                            {{ movie.titleEng }}
                        </h2>
                    </div>
                </div>
            </div>

            <!-- Movie Details Section -->
            <div class="bg-brand-975 shadow-md rounded-lg p-6">
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-3xl font-semibold text-brand-white">
                                {{ movie.title }}
                            </h1>
                            <h2 class="text-lg text-brand-white/50 italic">
                                {{ movie.titleEng }}
                            </h2>
                        </div>
                        <Badge>{{ movie.age_rating }}</Badge>
                    </div>

                    <p class="text-gray-600 mt-2">{{ movie.description }}</p>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-4">
                        <div>
                            <span class="text-sm font-semibold text-gray-500">{{
                                __("movie.director")
                            }}</span>
                            <p class="text-brand-white">{{ movie.director }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-semibold text-gray-500">{{
                                __("movie.cast")
                            }}</span>
                            <p class="text-brand-white">
                                {{ JSON.parse(movie.cast).join(", ") }}
                            </p>
                        </div>
                        <div>
                            <span class="text-sm font-semibold text-gray-500">{{
                                __("movie.release")
                            }}</span>
                            <p class="text-brand-white">
                                {{ formatDate(movie.release_date) }}
                            </p>
                        </div>
                        <div>
                            <span class="text-sm font-semibold text-gray-500">{{
                                __("movie.duration")
                            }}</span>
                            <p class="text-brand-white">{{ movie.length }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sessions Section -->
            <div class="bg-brand-975 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-brand-white">
                    {{ __("movie.available_sessions") }}
                </h2>
                <div class="flex flex-col gap-6">
                    <template v-if="sessions?.length > 0">
                        <div
                            v-for="session in sessions"
                            :key="session.id"
                            class="rounded-lg bg-brand-850 p-4 shadow-md hover:shadow-lg transition border border-brand-900"
                        >
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <p
                                        class="text-lg font-bold text-brand-white"
                                    >
                                        {{ session.cinema_name }}
                                    </p>
                                    <p class="text-sm text-gray-400">
                                        {{ formatDate(session.start_time) }} at
                                        {{ formatTime(session.start_time) }}
                                    </p>
                                </div>
                                <Badge>{{ session.format }}</Badge>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-500">
                                        {{ __("movie.room") }}
                                    </p>
                                    <p class="text-brand-white font-medium">
                                        {{ session.cinema_room }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-500">
                                        {{ __("movie.language") }}
                                    </p>
                                    <p class="text-brand-white font-medium">
                                        {{ session.language }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-500">
                                        {{ __("movie.subtitles") }}
                                    </p>
                                    <p class="text-brand-white font-medium">
                                        {{ session.subtitles }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-500">
                                        {{ __("movie.available_seats") }}
                                    </p>
                                    <p class="text-brand-white font-medium">
                                        {{ session.seats }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <div>
                                    <p class="text-sm text-gray-500">
                                        {{ __("movie.pricing") }}
                                    </p>
                                    <p class="text-brand-white font-semibold">
                                        Main: {{ session.main_price }}€ | VIP:
                                        {{ session.vip_price }}€
                                    </p>
                                </div>
                                <a
                                    class="px-4 py-2 bg-brand-primary text-white text-sm font-semibold rounded-lg shadow hover:bg-brand-primary-light transition"
                                >
                                    <Button
                                        color="brand-900"
                                        class="flex font-semibold justify-center gap-2 !w-full"
                                        @click="buyTicket(session.id)"
                                    >
                                        <ShoppingBasket class="w-4 h-4" />
                                        {{ __("movie.buy") }}
                                    </Button>
                                </a>
                            </div>
                        </div>
                    </template>
                    <Alert
                        v-else
                        type="error"
                        class="flex items-center justify-center"
                    >
                        <template #icon>
                            <AlertCircle class="size-8 text-brand-error" />
                        </template>
                        <template #description>
                            <span class="text-title1">
                                {{ __("movie.no_sessions") }}
                            </span>
                        </template>
                    </Alert>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
