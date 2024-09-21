<script setup>
import { ref } from "vue";

import Breadcrumb from "@/Components/Breadcrumb.vue";
import Button from "@/Components/Button.vue";
import DatePicker from "@/Components/DatePicker.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Input from "@/Components/Input.vue";
import Badge from "@/Components/Badge.vue";
import MovieCard from "@/Components/MovieCard.vue";
import TopMovie from "@/Components/TopMovie.vue";
import Slider from "@/Components/Slider.vue";
import Modal from "@/Components/Modal.vue";

import { Search } from "lucide-vue-next";
import { Head, usePage } from "@inertiajs/vue3";

const modalOpen = ref(false);

const toggleModal = () => {
    modalOpen.value = !modalOpen.value;
}

const movies = [
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Kollide Kompanii",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Monster's INC."
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
    {
        categories: [
            { name: "Komöödia" },
            { name: "Seiklus" },
            { name: "Animatsioon" },
        ], title: "Another Movie",
        image: "https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg",
        titleEng: "Another Movie English"
    },
];
</script>

<template>

    <Head title="Dashboard" />
    <GuestLayout>
        <div class="py-12 w-full flex flex-col gap-12">

            <!-- Breadcrumb -->
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Breadcrumb</h2>
                <Breadcrumb
                    :crumbs="[{ title: __('link.home'), href: route('Home') }, { title: 'Components', href: route('Home') }, { title: 'Breadcrumb', href: route('Home') }]" />
            </div>

            <!-- Buttons -->
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Buttons</h2>
                <Button>Solid Default</Button>
                <Button type="outline">Outlined Default</Button>
                <Button color="brand-100">Solid 100</Button>
                <Button type="outline" color="brand-100">Outlined 100</Button>
                <Button color="brand-200">Solid 200</Button>
                <Button type="outline" color="brand-200">Outlined 200</Button>
                <Button color="brand-300">Solid 300</Button>
                <Button type="outline" color="brand-300">Outlined 300</Button>
                <Button color="brand-400">Solid 400</Button>
                <Button type="outline" color="brand-400">Outlined 400</Button>
                <Button color="brand-500">Solid 500</Button>
                <Button type="outline" color="brand-500">Outlined 500</Button>
                <Button color="brand-600">Solid 600</Button>
                <Button type="outline" color="brand-600">Outlined 600</Button>
                <Button color="brand-700">Solid 700</Button>
                <Button type="outline" color="brand-700">Outlined 700</Button>
                <Button color="brand-800">Solid 800</Button>
                <Button type="outline" color="brand-800">Outlined 800</Button>
                <Button color="brand-900">Solid 900</Button>
                <Button type="outline" color="brand-900">Outlined 900</Button>
            </div>

            <!-- Datepicker -->
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">DatePicker</h2>
                <DatePicker />
            </div>

            <!-- Input -->
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Input</h2>
                <Input type="text" placeholder="Otsing" class="bg-brand-975">
                <Search class="w-5 h-5 text-brand-white" />
                </Input>
            </div>

            <!-- Badges -->
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Badge</h2>
                <Badge>Outline/Default</Badge>
                <Badge type="solid">Solid</Badge>
            </div>

            <!-- Movie Card -->
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Movie Card</h2>
                <MovieCard image="https://via.placeholder.com/300" title="Title" titleEng="Title English" href="#">
                    <template #imageBadges>
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

            <!-- Top Movie -->
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Top Movie</h2>
                <TopMovie
                    image="https://r4.wallpaperflare.com/wallpaper/59/28/989/monsters-inc-sulley-pixar-animation-wallpaper-7a099957313565bcca9656ffe8da0319.jpg"
                    engTitle="Monsters, INC." title="Kollide Kompanii">
                    <template #badges>
                        <Badge type="solid">Komöödia</Badge>
                        <Badge type="solid">Seiklus</Badge>
                        <Badge type="solid">Animatsioon</Badge>
                    </template>

                    <template #description>
                        Animeeritud film mis avastab Monstropolise maailma, kus
                        koletised toodavad linna energiat hirmutades lapsi
                        öösel.
                    </template>
                </TopMovie>
            </div>

            <!-- Slider -->
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Slider</h2>
                <Slider :length="movies.length">
                    <template #cards>
                        <MovieCard v-for="i in movies" :image="i.image" :title="i.title" :titleEng="i.titleEng"
                            href="#">
                            <template #imageBadges>
                                <Badge type="solid">3D</Badge>
                                <Badge>12+</Badge>
                            </template>

                            <template #badges>
                                <Badge type="solid" v-for="cat in i.categories">{{ cat.name }}</Badge>
                            </template>
                        </MovieCard>
                    </template>
                </Slider>
            </div>

            <!-- Modal -->
            <div class="flex gap-2 flex-col">
                <h2 class="text-brand-white">Modal</h2>
                <Button @click="toggleModal">Show Modal</Button>
                <Modal v-model:isOpen="modalOpen" title="Modal">
                    <template #content>
                        <p class="text-brand-100/75">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione iusto deserunt at est, et nostrum modi quia ullam incidunt illum similique rerum recusandae repellat ducimus sint. Impedit quae soluta iure.</p>
                    </template>

                    <template #buttons>
                        <Button @click="toggleModal" class="py-[5px]">Close</Button>
                    </template>
                </Modal>
            </div>
        </div>
    </GuestLayout>
</template>
