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
                <img :src="image" alt="Movie Poster" class="w-full h-full object-cover object-center rounded-lg" />
                <div class="absolute inset-0 bg-black/30 rounded-lg flex items-end p-6">
                    <div class="flex flex-col gap-4">
                        <h1 class="text-display1 font-semibold text-brand-white">
                            {{ movie.title }}
                        </h1>
                        <h2 class="text-title2 text-brand-white/50">
                            {{ movie.titleEng }}
                        </h2>
                    </div>
                </div>
            </div>

            <!-- Movie Details Section -->
            <div class="flex gap-4">
                <iframe class="w-[100%] min-h-[100%] rounded-b-lg"
                    :src="`${movie.trailer}?autoplay=1&mute=1&frameborder=0`"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    :allowfullscreen="true">
                </iframe>
                <div class="flex flex-row bg-brand-975 w-full shadow-md rounded-lg p-6 gap-4 border border-brand-900 justify-between">
                    <div class="flex flex-col gap-4">
                        <span class="flex flex-col gap-3">

                            <h1 class="text-main2 font-semibold text-brand-white">
                                {{ movie.title }}
                            </h1>


                            <h2 class="text-title1 text-brand-white/50">
                                {{ movie.titleEng }}
                            </h2>
                        </span>

                        <span class="flex gap-2">
                            <Badge v-for="cat in movie.categories" :key="cat.name">{{ cat.name }}</Badge>
                        </span>
                        <p class="text-brand-white mt-2 text-body">{{ movie.description }}</p>
                        <span class="flex justify-between">
                            <div>
                                <span class="text-detail font-semibold text-gray-500">{{
                                    __("movie.director")
                                    }}</span>
                                <p class="text-brand-white">{{ movie.director }}</p>
                            </div>
                            <div>
                                <span class="text-detail font-semibold text-gray-500">{{
                                    __("movie.duration")
                                    }}</span>
                                <p class="text-brand-white">{{ movie.length }}</p>
                            </div>
                            <div>
                                <span class="text-detail font-semibold text-gray-500">{{
                                    __("movie.release")
                                    }}</span>
                                <p class="text-brand-white">
                                    {{ formatDate(movie.release_date) }}
                                </p>
                            </div>
                        </span>
                        <div>
                            <span class="text-detail font-semibold text-gray-500">{{
                                __("movie.cast")
                            }}</span>
                            <p class="text-brand-white">
                                {{ JSON.parse(movie.cast).join(", ") }}
                            </p>
                        </div>
                    </div>
                        <Badge>{{ movie.age_rating }}</Badge>
                </div>
            </div>

            <!-- Sessions Section -->
            <div class="bg-brand-975 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-brand-white">
                    {{ __("movie.available_sessions") }}
                </h2>
                <div class="flex flex-col gap-6">
                    <template v-if="sessions?.length > 0">
                        <div v-for="session in sessions" :key="session.id"
                            class="rounded-lg bg-brand-850 p-4 shadow-md hover:shadow-lg transition border border-brand-900">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <p class="text-lg font-bold text-brand-white">
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
                                    class="px-4 py-2 bg-brand-primary text-white text-sm font-semibold rounded-lg shadow hover:bg-brand-primary-light transition">
                                    <Button color="brand-900" class="flex font-semibold justify-center gap-2 !w-full"
                                        @click="buyTicket(session.id)">
                                        <ShoppingBasket class="w-4 h-4" />
                                        {{ __("movie.buy") }}
                                    </Button>
                                </a>
                            </div>
                        </div>
                    </template>
                    <Alert v-else type="error" class="flex items-center justify-center">
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
