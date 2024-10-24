<template>
    <div class="flex items-center justify-center min-h-screen bg-brand-975">
        <div class="w-full max-w-md p-8 bg-brand-950 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center mb-6 text-white">
                Login
            </h2>

            <form @submit.prevent="submitLogin">
                <div class="mb-4">
                    <label
                        class="block text-white text-sm font-bold mb-2"
                        for="email"
                    >
                        {{ __("login.input.email") }}
                    </label>
                    <Input
                        v-model="form.email"
                        type="text"
                        :placeholder="__('login.input.email')"
                    />
                </div>

                <div class="mb-6">
                    <label
                        class="block text-white text-sm font-bold mb-2"
                        for="password"
                    >
                        {{ __("login.input.password") }}
                    </label>
                    <Input
                        v-model="form.password"
                        type="password"
                        :placeholder="__('login.input.password')"
                    />
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-brand-975 hover:bg-brand-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Login
                    </button>
                </div>
                <Alert
                    type="error"
                    class="my-8 mx-4"
                    v-if="form.errors.password || form.errors.email"
                >
                    <template #icon>
                        <OctagonAlert class="size-5 text-brand-error" />
                    </template>
                    <template #title> Error </template>
                    <template #description>
                        {{ form.errors.password }}<br />
                        {{ form.errors.email }}
                    </template>
                </Alert>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Input from "@/Components/Input.vue";
import Alert from "@/Components/Alert.vue";

const form = useForm({
    email: "",
    password: "",
});

const submitLogin = () => {
    form.post("/login", {
        onError: () => {
            console.log("There were validation errors.");
        },
        onSuccess: () => {
            console.log("Login successful!");
        },
    });
};
</script>
