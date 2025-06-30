<template>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Backoffice</h2>
        </div>
        <ul>
            <template v-for="page in pages" :key="page.route">
                <li v-if="canAccess(page.can)">
                    <Link :href="page.route" class="sidebar-link">
                        <i :class="['sidebar-icon', page.icon]" v-if="page.icon"></i>
                        <span>{{ page.name }}</span>
                    </Link>
                </li>
            </template>
            <!-- Add more links as needed -->
        </ul>
    </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3"; // Added usePage

const props = defineProps({
    // If you need to pass specific props to the sidebar
});

const pages = [
    {
        name: "Dashboard",
        route: "/admin",
        icon: "fas fa-tachometer-alt", 
        can: true, 
    },
    {
        name: "User Management",
        route: "/admin/users", 
        icon: "fas fa-users",
        // For this to work, 'manage users' permission must be passed from backend
        // to page.props.auth.user.permissions or similar structure
        can: "manage_users", // Will use the can() helper from usePage().props
    },
    {
        name: "Movie Management",
        route: "/admin/movies",
        icon: "fas fa-film",
        can: "manage_movies",
    },
    {
        name: "Ticket Management",
        route: "/admin/tickets", 
        icon: "fas fa-ticket-alt",
        can: "manage_tickets",
    },
    {
        name: "Go to Site",
        route: "/",
        icon: "fas fa-external-link-alt",
        can: true, 
    },
];

// Accessing the can helper function from Ziggy/Inertia
const page = usePage();
const canAccess = (permissionName) => {
    if (typeof permissionName === 'boolean') {
        return permissionName;
    }
    if (!page.props.auth || !page.props.auth.user) {
        return false; // No user authenticated, so no permissions
    }
    // Assuming 'can' function is available on the user object via a trait or helper in Laravel
    // This requires that the user object passed to Inertia includes their permissions
    // or a method to check them.
    // For spatie/laravel-permission, you might need to share permissions with Inertia.
    // A common way is to add a 'can' object to `auth.user` in HandleInertiaRequests middleware.
    // e.g., 'user_can_manage_users': auth()->user()->can('manage users')
    
    // For now, let's assume a simple permission check on a permissions array if `can` method is not directly available.
    // This is a simplified example. A full setup involves sharing permissions properly.
    if (page.props.auth.user.permissions && Array.isArray(page.props.auth.user.permissions)) {
        return page.props.auth.user.permissions.includes(permissionName);
    }
    // Fallback if a direct 'can' method is available (e.g. if you've added it to the user resource)
    if (typeof page.props.auth.user.can === 'function') {
         return page.props.auth.user.can(permissionName);
    }

    // If permissions are not directly available, default to false for permission strings.
    // True booleans (like for Dashboard and Go to Site) will still pass.
    return false; 
};

</script>

<style>
.sidebar-icon {
    margin-right: 10px;
    width: 20px; /* Ensures icons align nicely */
    text-align: center;
}

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
