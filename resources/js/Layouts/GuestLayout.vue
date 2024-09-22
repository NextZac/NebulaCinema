<script setup>
import { ref } from "vue";
import { ChevronDown, Search } from "lucide-vue-next";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Input from "@/Components/Input.vue";
import Dropdown from "@/Components/Dropdown.vue";

const dropdowns = ref({
    kinod: false,
    grupid: false,
    avatar: false
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
    ]
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
                    <a @click="toggleDropdown(link.dropdown)" :class="[dropdowns[link.dropdown] ? 'text-brand-400' : 'text-white',
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
                        class="w-full h-full rounded-full border-2 border-gray-300 cursor-pointer transition duration-100 hover:scale-110 active:scale-100" @click="toggleDropdown('avatar')" />
                    <Dropdown class="top-[110%] right-5" v-model:isOpen="dropdowns.avatar"
                        :options="dropdownOptions.avatar" />
                </div>
            </div>
        </header>

        <main class="flex sm:justify-center items-center pt-6 sm:pt-0 overflow-x-hidden">
            <div class="w-full mx-4 mt-6 px-6 py-4 bg-brand-dark-darker sm:rounded-lg">
                <slot />
            </div>
        </main>
    </div>
</template>