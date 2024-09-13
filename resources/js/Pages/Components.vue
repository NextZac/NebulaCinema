<script setup>
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Button from "@/Components/Button.vue";
import DatePicker from "@/Components/DatePicker.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />
    <GuestLayout>
        <div class="py-12 w-full">
            <div>
                <h2>Breadcrumb</h2>
                <Breadcrumb />
            </div>
            <div>
                <h2>Buttons</h2>
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
            <div>
                <h2>DatePicker</h2>
                <DatePicker />
            </div>
        </div>
    </GuestLayout>
</template>
