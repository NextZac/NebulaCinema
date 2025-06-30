<template>
    <AdminLayout title="View User">
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h1 class="text-2xl font-semibold text-gray-700 mb-2">User Details</h1>
                    <Link :href="route('admin.users.index')" class="text-sm text-blue-500 hover:text-blue-700 mb-6 block">&larr; Back to Users</Link>

                    <div class="mb-4">
                        <strong class="block text-gray-700">Name:</strong>
                        <p class="text-gray-900">{{ user.name }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="block text-gray-700">Email:</strong>
                        <p class="text-gray-900">{{ user.email }}</p>
                    </div>
                    <div class="mb-4">
                        <strong class="block text-gray-700">Roles:</strong>
                        <div v-if="user.roles && user.roles.length > 0">
                            <span v-for="role in user.roles" :key="role.id" class="bg-gray-200 text-gray-700 px-2 py-1 text-xs rounded-full mr-1">
                                {{ role.name }}
                            </span>
                        </div>
                        <p v-else class="text-gray-600">No roles assigned.</p>
                    </div>
                     <div class="mb-4">
                        <strong class="block text-gray-700">Registered At:</strong>
                        <p class="text-gray-900">{{ new Date(user.created_at).toLocaleDateString() }}</p>
                    </div>

                    <div class="mt-6 border-t pt-4">
                         <Link :href="route('admin.users.edit', user.id)" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                            Edit User
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
});
</script>
