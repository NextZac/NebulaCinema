<template>
    <div class="admin-container">
        <Sidebar />
        <div class="main-content">
            <Header :user="user.value" />
            <div class="content">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Sidebar from "@/Components/Admin/Sidebar.vue";
import Header from "@/Components/Admin/Header.vue";
import { usePage, router } from "@inertiajs/vue3";

const { props } = usePage();
const user = ref(router.page.props.auth.user);
</script>

<style>
.admin-container {
    display: flex;
    height: 100vh;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.main-content {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
}

.content {
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
