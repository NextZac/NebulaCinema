<script setup>
import { ChevronDownIcon } from "@heroicons/vue/24/outline";
import ApplicationLogo from "@/Components/inertia/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen bg-[#1E1B4B]">
        <!-- Header -->
        <header
            class="flex justify-between items-center px-6 py-4 bg-[#171532] shadow"
        >
            <!-- Logo -->
            <div class="flex items-center space-x-10">
                <!-- Application Logo -->
                <Link href="/">
                    <ApplicationLogo
                        class="w-40 h-40 -my-14 fill-current text-gray-500"
                    />
                </Link>

                <!-- Buttons Section -->
                <div class="hidden sm:flex space-x-10">
                    <a class="text-white px-4 py-2 rounded"> Kinokava </a>
                    <a
                        class="text-white px-4 py-2 rounded rounded inline-flex items-center"
                    >
                        Kinod <ChevronDownIcon class="w-4 h-4 ml-2" />
                    </a>
                    <a class="text-white px-4 py-2 rounded"> Filmid </a>
                    <a
                        class="text-white px-4 py-2 rounded inline-flex items-center"
                    >
                        Grupikülastus
                        <ChevronDownIcon class="w-4 h-4 ml-2" />
                    </a>
                    <a class="text-white px-4 py-2 rounded"> Kinkekaardid </a>
                </div>
            </div>

            <!-- Avatar -->
            <div class="flex-shrink-0">
                <img
                    src="https://via.placeholder.com/40"
                    alt="User Avatar"
                    class="w-10 h-10 rounded-full border-2 border-gray-300"
                />
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex sm:justify-center items-center pt-6 sm:pt-0">
            <div
                class="w-full mx-4 mt-6 px-6 py-4 bg-brand-dark-darker shadow-md sm:rounded-lg"
            >
                <slot />
            </div>
        </main>
    </div>
</template>
