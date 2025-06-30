<template>
    <AdminLayout title="Create User">
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h1 class="text-2xl font-semibold text-gray-700 mb-6">Create New User</h1>
                    <form @submit.prevent="submit">
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" v-model="form.name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.name }">
                            <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" v-model="form.email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.email }">
                            <p v-if="form.errors.email" class="mt-2 text-sm text-red-600">{{ form.errors.email }}</p>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="password" v-model="form.password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :class="{ 'border-red-500': form.errors.password }">
                            <p v-if="form.errors.password" class="mt-2 text-sm text-red-600">{{ form.errors.password }}</p>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" id="password_confirmation" v-model="form.password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Roles -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Roles</label>
                            <div v-if="form.errors.roles" class="mt-2 text-sm text-red-600">{{ form.errors.roles }}</div>
                            <div class="mt-2 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                <div v-for="role in availableRoles" :key="role" class="flex items-center">
                                    <input :id="'role_' + role" type="checkbox" :value="role" v-model="form.roles" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <label :for="'role_' + role" class="ml-2 block text-sm text-gray-900">{{ role }}</label>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end">
                            <Link :href="route('admin.users.index')" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Cancel
                            </Link>
                            <button type="submit" :disabled="form.processing" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" :class="{ 'opacity-50': form.processing }">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    roles: Array, // All available roles from backend
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    roles: [], // Selected roles
});

const availableRoles = props.roles;

const submit = () => {
    form.post(route('admin.users.store'), {
        onFinish: () => {
            // form.reset('password', 'password_confirmation'); // Reset password fields on finish
        },
    });
};
</script>
