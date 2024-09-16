<script setup>
import { ChevronDown } from "lucide-vue-next";
import { Search } from "lucide-vue-next";
import ApplicationLogo from "@/Components/inertia/ApplicationLogo.vue";
import Input from "@/Components/Input.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen bg-[#1E1B4B]">
        <!-- Header -->
        <header
            class="flex items-center gap-[40px] px-[25px] py-[15px] bg-[#171532] overflow-hidden"
        >
            <!-- Application Logo -->
            <Link :href="route('Home')" class="">
                <ApplicationLogo class="w-40 h-40 -my-14" />
            </Link>

            <!-- Buttons Section -->
            <a
                :href="route('Components')"
                class="text-white text-subtitle hover:text-brand-400"
                >Kinokava</a
            >
            <a
                href="#"
                class="group text-white text-subtitle inline-flex items-center hover:text-brand-400"
            >
                Kinod
                <ChevronDown
                    class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:rotate-180"
                />
            </a>
            <a href="#" class="text-white text-subtitle hover:text-brand-400"
                >Filmid</a
            >
            <a
                href="#"
                class="group text-white text-subtitle inline-flex items-center hover:text-brand-400"
            >
                Grupikülastus
                <ChevronDown
                    class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:rotate-180"
                />
            </a>
            <a href="#" class="text-white text-subtitle hover:text-brand-400"
                >Kinkekaardid</a
            >

            <!-- Avatar + Search -->
            <div class="flex w-full justify-end items-center gap-[40px]">
                <!-- Search -->
                <Input type="text" placeholder="Otsing">
                    <Search class="w-5 h-5 text-brand-white" />
                </Input>
                <!-- Avatar -->
                <div class="flex-shrink-0">
                    <img
                        src="https://via.placeholder.com/40"
                        alt="User Avatar"
                        class="w-10 h-10 rounded-full border-2 border-gray-300"
                    />
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex sm:justify-center items-center pt-6 sm:pt-0">
            <div
                class="w-full mx-4 mt-6 px-6 py-4 bg-brand-dark-darker sm:rounded-lg"
            >
                <slot />
            </div>
        </main>
    </div>
</template>
