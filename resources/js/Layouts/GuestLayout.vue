<script setup>
import { ref } from "vue";
import { ChevronDown, Search, Github } from "lucide-vue-next";

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Input from "@/Components/Input.vue";
import Dropdown from "@/Components/Dropdown.vue";

const dropdowns = ref({
    kinod: false,
    grupid: false,
    avatar: false,
    language: false
});

const toggleDropdown = (key) => {
    dropdowns.value[key] = !dropdowns.value[key];
};

const dropdownOptions = ref({
    kinod: [
        { title: "Ülemiste Keskus", href: "#" },
        { title: "T1 Keskus", href: "#" },
        { title: "Viru Keskus", href: "#" },
        { title: "Tasku Keskus", href: "#" },
    ],
    grupid: [
        { title: "Privaatseanss kinos", href: "#" },
        { title: "Sünnipäev kinos", href: "#" },
        { title: "Lasteaed/kool kinno", href: "#" },
    ],
    avatar: [
        { title: "Profile", href: "#" },
        { title: "Log out", href: "#", color: "brand-error" },
    ],
    language: [
        { title: "Estonian", href: "#" },
        { title: "English", href: "#" },
    ],
});

const navLinks = [
    { name: 'Kinokava', route: 'Components' },
    { name: 'Kinod', dropdown: 'kinod' },
    { name: 'Filmid', route: 'Films' },
    { name: 'Grupikülastus', dropdown: 'grupid' },
    { name: 'Kinkekaardid', route: 'Giftcards' }
];
</script>

<template>
    <div class="min-h-screen bg-[#1E1B4B]">
        <header
            class="flex sticky top-0 w-full items-center gap-[40px] px-[25px] py-[15px] bg-[#171532] border-b border-brand-900 z-50">
            <a :href="route('Home')" class="h-full">
                <ApplicationLogo class="w-40 h-20" />
            </a>

            <template v-for="link in navLinks" :key="link.name">
                <a v-if="link.route" :href="route(link.route)" :class="['text-subtitle hover:text-brand-400 select-none',
                    route().current(link.route) ? 'underline underline-offset-4 text-brand-400' : 'text-white']">
                    {{ link.name }}
                </a>
                <div v-else-if="link.dropdown" class="h-full">
                    <a @click="toggleDropdown(link.dropdown)"
                        :class="[dropdowns[link.dropdown] ? 'text-brand-400' : 'text-white',
                            'group text-subtitle inline-flex items-center hover:text-brand-400 cursor-pointer select-none']">
                        {{ link.name }}
                        <ChevronDown :class="['w-4 h-4 ml-2 transition-transform duration-100',
                            dropdowns[link.dropdown] ? 'rotate-180' : '']" />
                    </a>
                    <Dropdown class="top-[110%]" v-model:isOpen="dropdowns[link.dropdown]"
                        :options="dropdownOptions[link.dropdown]" />
                </div>
            </template>

            <div class="flex w-full justify-end items-center gap-[40px]">
                <Input type="text" placeholder="Otsing">
                <Search class="w-5 h-5 text-brand-white" />
                </Input>
                <div class="flex-shrink-0">
                    <img src="https://via.placeholder.com/40" alt="User Avatar"
                        class="w-full h-full rounded-full border-2 border-gray-300 cursor-pointer transition duration-100 hover:scale-110 active:scale-100"
                        @click="toggleDropdown('avatar')" />
                    <Dropdown class="top-[110%] right-5" v-model:isOpen="dropdowns.avatar"
                        :options="dropdownOptions.avatar" />
                </div>
            </div>
        </header>

        <main class="flex sm:justify-center items-center pt-6 sm:pt-0 overflow-x-hidden">
            <div class="w-full min-h-screen mx-4 mt-6 px-[25px] py-[15px] bg-brand-dark-darker sm:rounded-lg">
                <slot />
            </div>
        </main>

        <footer class="flex mt-6 bg-brand-975 border-t border-brand-900 text-white px-[25px] py-[25px] text-center">
            <div class="flex w-full items-center gap-6">
                <p class="text-brand-white/50 text-detail font-light">© 2024 Nebula Cinemas.</p>
                <a :href="route('Home')"
                    class="font-light text-brand-white/50 hover:text-brand-400 underline underline-offset-2">Terms</a>
                <a :href="route('Home')"
                    class="font-light text-brand-white/50 hover:text-brand-400 underline underline-offset-2">Privacy</a>
            </div>
            <div class="flex w-full justify-end items-center gap-6">
                <div class="flex gap-2">
                    <a class="group" :href="route('Home')">
                        <svg class="w-6 h-6 text-brand-white/50 group-hover:text-brand-600"
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                        </svg>
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>