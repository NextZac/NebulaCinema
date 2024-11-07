<template>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Backoffice</h2>
        </div>
        <ul>
            <li v-for="page in pages">
                <Link :href="page.route" class="sidebar-link">{{
                    page.name
                }}</Link>
            </li>
            <!-- Add more links as needed -->
        </ul>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const pages = [
    {
        name: "Dashboard",
        route: "/admin",
    },
    {
        name: "Movies",
        route: "/admin/movies",
    },
    // Add more pages as needed
];
</script>

<style>
.sidebar {
    width: 250px;
    background: linear-gradient(135deg, #0023ff 0%, #000c54 100%);
    color: #fff;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.sidebar-header {
    margin-bottom: 20px;
}

.sidebar-header h2 {
    font-size: 24px;
    font-weight: bold;
    margin: 0;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    width: 100%;
}

.sidebar li {
    margin-bottom: 10px;
}

.sidebar-link {
    display: block;
    padding: 10px 15px;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background 0.3s;
}

.sidebar-link:hover {
    background: rgba(255, 255, 255, 0.1);
}
</style>
