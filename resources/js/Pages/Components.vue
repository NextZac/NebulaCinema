<script setup>
import Breadcrumb from '@/Components/Breadcrumb.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />
    <GuestLayout>
        <div class="py-12 w-full">
            <div>
                <h2>Breadcrumb</h2>
                <Breadcrumb />
            </div>
        </div>
    </GuestLayout>
</template>
