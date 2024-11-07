<template>
    <AdminLayout>
        <div class="dashboard">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>Current User: {{ user.name }}</p>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const { props } = usePage();
const user = ref(props.user);
</script>

<style>
.dashboard {
    text-align: center;
}

.dashboard h2 {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
}

.dashboard p {
    font-size: 18px;
    color: #333;
}
</style>
