<script setup>
import ApplicationLogo from '@/Components/inertia/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen bg-gray-100">
      <!-- Header -->
      <header class="flex justify-between items-center px-6 py-4 bg-white shadow">
        <!-- Logo -->
        <div class="flex-shrink-0">
          <Link href="/">
            <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
          </Link>
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
      <main class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div
          class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
          <slot />
        </div>
      </main>
    </div>
  </template>
  
