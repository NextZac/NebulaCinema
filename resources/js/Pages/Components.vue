<script setup>
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Button from "@/Components/Button.vue";
import DatePicker from "@/Components/DatePicker.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Input from "@/Components/Input.vue";
import Badge from "@/Components/Badge.vue";
import MovieCard from "@/Components/MovieCard.vue";
import TopMovie from "@/Components/TopMovie.vue";

import { Search } from "lucide-vue-next";
import { Head, usePage } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />
    <GuestLayout>
        <div class="py-12 w-full flex flex-col gap-12">
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Breadcrumb</h2>
                <Breadcrumb />
            </div>
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Buttons</h2>
                <Button size="lg">Small</Button>
                <Button
                    @click="console.log('medium clicked!')"
                    class="mx-4"
                    type="danger"
                    size="sm"
                    >Medium</Button
                >
                <Button type="success" size="md">Big</Button>
            </div>
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">DatePicker</h2>
                <DatePicker />
            </div>
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Input</h2>
                <Input type="text" placeholder="Otsing" class="bg-brand-975">
                    <Search class="w-5 h-5 text-brand-white" />
                </Input>
            </div>
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Badge</h2>
                <Badge>Outline/Default</Badge>
                <Badge type="solid">Solid</Badge>
            </div>
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Movie Card</h2>
                <MovieCard
                    image="https://via.placeholder.com/300"
                    title="Title"
                    titleEng="Title English"
                    href="#"
                >
                    <template #imageBadge>
                        <Badge type="solid">3D</Badge>
                        <Badge>12+</Badge>
                    </template>

                    <template #badges>
                        <Badge>Komöödia</Badge>
                        <Badge>Seiklus</Badge>
                        <Badge>Animatsioon</Badge>
                    </template>
                </MovieCard>
            </div>
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Top Movie</h2>
                <TopMovie
                    image="https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg"
                    publisher="Monsters, INC."
                    title="Kollide Kompanii"
                >
                    <template #description>
                        Animeeritud film mis avastab Monstropolise maailma, kus
                        koletised toodavad linna energiat hirmutades lapsi
                        öösel.
                    </template>
                </TopMovie>
            </div>
        </div>
    </GuestLayout>
</template>
