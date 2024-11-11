<template>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <div class="user-info">
            <span>{{ user.name }}</span>
            <!-- Add logout button or other user actions -->
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { usePage, router } from "@inertiajs/vue3";

const { props } = usePage();
const user = ref(router.page.props.auth.user);
console.log(user.value.name);
</script>

<style>
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-radius: 8px;
    margin-bottom: 20px;
}

.header h1 {
    font-size: 24px;
    font-weight: bold;
    margin: 0;
}

.user-info {
    display: flex;
    align-items: center;
}
</style>
