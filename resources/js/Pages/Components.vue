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
import Dropdown from "@/Components/Dropdown.vue";
import SelectOption from "@/Components/SelectOption.vue";
import MovieSchedule from "@/Components/MovieSchedule.vue";
import Alert from "@/Components/Alert.vue";

import { Search, Check, Info, OctagonAlert } from "lucide-vue-next";
import { Head, usePage } from "@inertiajs/vue3";

const modalOpen = ref(false);

const toggleModal = () => {
    modalOpen.value = !modalOpen.value;
}

const dropdowns = ref({
    test1: false,
    test2: false,
    test3: false,
    test4: false
});

const toggleDropdown = (key) => {
    dropdowns.value[key] = !dropdowns.value[key];
    console.log(dropdowns.value[key]);
};

const dropdownOptions = {
    test1: [
        { title: "Ülemiste Keskus", href: "#" },
        { title: "T1 Keskus", href: "#" },
        { title: "Viru Keskus", href: "#" },
        { title: "Tasku Keskus", href: "#" },
    ],
    test2: [
        { title: "Ülemiste Keskus", href: "#" },
        { title: "T1 Keskus", href: "#" },
        { title: "Viru Keskus", href: "#" },
        { title: "Tasku Keskus", href: "#" },
    ],
    test3: [
        { title: "Ülemiste Keskus", href: "#" },
        { title: "T1 Keskus", href: "#" },
        { title: "Viru Keskus", href: "#" },
        { title: "Tasku Keskus", href: "#" },
    ],
    test4: [
        { title: "Ülemiste Keskus", href: "#" },
        { title: "T1 Keskus", href: "#" },
        { title: "Viru Keskus", href: "#" },
        { title: "Tasku Keskus", href: "#" },
    ],
};

const options = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']

const selectedOption = ref(0);

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

    <Head title="Components" />

    <GuestLayout>
        <div class="w-full flex flex-col gap-12">

            <!-- Breadcrumb -->
            <div class="flex gap-8 flex-col">
                <h2 class="text-brand-white">Breadcrumb</h2>
                <Breadcrumb
                    :crumbs="[{ title: __('link.home'), href: route('Home') }, { title: 'Components', href: route('Home') }, { title: 'Breadcrumb', href: route('Home') }]" />
            </div>

            <!-- Buttons -->
            <div class="flex gap-8 flex-col">
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
            <div class="flex gap-8 flex-col">
                <h2 class="text-brand-white">DatePicker</h2>
                <DatePicker />
                <DatePicker :selector="true" />
                <DatePicker :hidePrevious="true" />
            </div>

            <!-- Input -->
            <div class="flex gap-8 flex-col">
                <h2 class="text-brand-white">Input</h2>
                <Input type="text" placeholder="Otsing" class="bg-brand-975">
                <Search class="w-5 h-5 text-brand-white" />
                </Input>
            </div>

            <!-- Badges -->
            <div class="flex gap-8 flex-col">
                <h2 class="text-brand-white">Badge</h2>
                <Badge>Outline/Default</Badge>
                <Badge type="solid">Solid</Badge>
            </div>

            <!-- Movie Card -->
            <div class="flex gap-8 flex-col">
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

                <MovieCard image="https://via.placeholder.com/300" title="Title" titleEng="Title English" href="#"
                    :animated="true">
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

            <!-- Movie Schedule -->
            <div class="flex gap-8 flex-col">
                <h2 class="text-brand-white">Movie Schedule</h2>
                <MovieSchedule image="https://via.placeholder.com/300" title="Title" titleEng="Title English" href="#"
                    startingTime="10:00" cinema="Nebula Ülemiste" cinemaRoom="Room 1" freeSeats="5"
                    subtitles="Eesti, Vene" language="Eesti">
                    <template #imageBadges>
                        <Badge type="solid">3D</Badge>
                        <Badge>12+</Badge>
                    </template>

                    <template #badges>
                        <Badge>Komöödia</Badge>
                        <Badge>Seiklus</Badge>
                        <Badge>Animatsioon</Badge>
                    </template>
                </MovieSchedule>
            </div>

            <!-- Top Movie -->
            <div class="flex gap-8 flex-col">
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
            <div class="flex gap-8 flex-col">
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
            <div class="flex gap-8 flex-col">
                <h2 class="text-brand-white">Modal</h2>
                <Button @click="toggleModal">Show Modal</Button>
                <Modal v-model:isOpen="modalOpen" title="Modal">
                    <template #content>
                        <p class="text-brand-100/75">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
                            iusto deserunt at est, et nostrum modi quia ullam incidunt illum similique rerum recusandae
                            repellat ducimus sint. Impedit quae soluta iure.</p>
                    </template>

                    <template #buttons>
                        <Button @click="toggleModal" class="py-[5px]">Close</Button>
                    </template>
                </Modal>
            </div>

            <!-- Select Option -->
            <div class="flex gap-8 flex-col w-[15%]">
                <h2 class="text-brand-white">Select Option</h2>
                <SelectOption :options="options" v-model="selectedOption" align="top"></SelectOption>
                <SelectOption :options="options" v-model="selectedOption" align="right"></SelectOption>
                <SelectOption :options="options" v-model="selectedOption" align="left"></SelectOption>
                <SelectOption :options="options" v-model="selectedOption" align="bottom"></SelectOption>
            </div>

            <!-- Dropdown  -->
            <div class="flex gap-8 flex-col relative">
                <h2 class="text-brand-white">Dropdown</h2>
                <Button @click="toggleDropdown('test2')">Dropdown Top
                    <Dropdown v-model:isOpen="dropdowns.test2" :options="dropdownOptions.test2" align="top" />
                </Button>
                <Button @click="toggleDropdown('test3')">Dropdown Right
                    <Dropdown v-model:isOpen="dropdowns.test3" :options="dropdownOptions.test3" align="right" />
                </Button>
                <Button @click="toggleDropdown('test4')">Dropdown Left
                    <Dropdown v-model:isOpen="dropdowns.test4" :options="dropdownOptions.test4" align="left" />
                </Button>
                <Button @click="toggleDropdown('test1')">Dropdown Bottom
                    <Dropdown v-model:isOpen="dropdowns.test1" :options="dropdownOptions.test1" />
                </Button>
            </div>

            <!-- Alert -->
            <div class="flex gap-8 flex-col">
                <h2 class="text-brand-white">Alert</h2>
                <Alert>
                    <template #title>
                        Warning
                    </template>
                    <template #description>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
                        iusto deserunt at est, et nostrum modi quia ullam incidunt illum similique rerum recusandae
                        repellat ducimus sint. Impedit quae soluta iure.
                    </template>
                </Alert>
                <Alert type="error">
                    <template #icon>
                        <OctagonAlert class="size-5 text-brand-error" />
                    </template>
                    <template #title>
                        Error
                    </template>
                    <template #description>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
                        iusto deserunt at est, et nostrum modi quia ullam incidunt illum similique rerum recusandae
                        repellat ducimus sint. Impedit quae soluta iure.
                    </template>
                </Alert>
                <Alert type="warning">
                    <template #icon>
                        <OctagonAlert class="size-5 text-brand-warning" />
                    </template>
                    <template #title>
                        Warning
                    </template>
                    <template #description>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
                        iusto deserunt at est, et nostrum modi quia ullam incidunt illum similique rerum recusandae
                        repellat ducimus sint. Impedit quae soluta iure.
                    </template>
                </Alert>
                <Alert type="success">
                    <template #icon>
                        <Check class="size-5 text-brand-success" />
                    </template>
                    <template #title>
                        Success
                    </template>
                    <template #description>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
                        iusto deserunt at est, et nostrum modi quia ullam incidunt illum similique rerum recusandae
                        repellat ducimus sint. Impedit quae soluta iure.
                    </template>
                </Alert>
                <Alert type="info">
                    <template #icon>
                        <Info class="size-5 text-brand-info" />
                    </template>
                    <template #title>
                        Info
                    </template>
                    <template #description>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione
                        iusto deserunt at est, et nostrum modi quia ullam incidunt illum similique rerum recusandae
                        repellat ducimus sint. Impedit quae soluta iure.
                    </template>
                </Alert>
            </div>

        </div>
    </GuestLayout>
</template>
