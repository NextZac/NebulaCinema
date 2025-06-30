<template>
    <AdminLayout title="Admin Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="text-2xl">
                            Welcome to the Admin Dashboard!
                        </div>

                        <div class="mt-6 text-gray-500">
                            This is the central place to manage your application. Use the navigation menu to access different sections.
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                        <div class="bg-gray-100 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900">Quick Stats</h3>
                            <p class="mt-2 text-sm text-gray-600">
                                Users: {{ stats.users }} <br>
                                Movies: {{ stats.movies }} <br>
                                Active Sessions: {{ stats.activeSessions }}
                            </p>
                        </div>
                        <div class="bg-gray-100 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
                            <p class="mt-2 text-sm text-gray-600">
                                - User John Doe registered. <br>
                                - Movie "New Adventure" added.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { defineProps } from 'vue';

const props = defineProps({
    stats: {
        type: Object,
        default: () => ({
            users: 0,
            movies: 0,
            activeSessions: 0,
        }),
    },
});
</script>
