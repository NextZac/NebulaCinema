<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Button from '@/Components/Button.vue';
import Divider from '@/Components/Divider.vue';
import Input from '@/Components/Input.vue';

import { }
</script>

<template>

    <Head title="Login" />

    <GuestLayout>
        <div class="flex flex-col gap-[60px]">
            <main
                class="flex flex-col p-8 gap-8 justify-center w-full max-w-4xl mx-auto bg-brand-975 rounded-lg text-brand-white">
                <div class="flex flex-col gap-2 justify-center">
                    <h1 class="text-3xl font-bold text-brand-white">Log in</h1>
                    <p class="text-body text-brand-white/50">Enter your data to log in</p>
                </div>

                <!--Form and buttons -->
                <div class="flex flex-col gap-4 w-full justify-center">

                    <!-- Form -->
                    <form class="flex flex-col gap-4 w-full">
                        <Input type="email" name="email" label="Email" placeholder="Email" />
                        <Input type="password" name="password" label="Password" placeholder="Password">
                            
                        </Input>
                    </form>

                    <!-- Divider -->
                    <Divider class="w-full">OR</Divider>

                    <!-- Buttons -->
                    <div class="flex gap-4 w-full">
                        <Button class="font-medium flex gap-3 grow justify-center">
                            <svg class="size-4" viewBox="-3 0 262 262" xmlns="http://www.w3.org/2000/svg"
                                preserveAspectRatio="xMidYMid" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"
                                        fill="#ffffff"></path>
                                    <path
                                        d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"
                                        fill="#ffffff"></path>
                                    <path
                                        d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"
                                        fill="#ffffff"></path>
                                    <path
                                        d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"
                                        fill="#ffffff"></path>
                                </g>
                            </svg>
                            Continue with Google
                        </Button>
                        <Button class="font-medium flex gap-3 grow justify-center">
                            <svg class="size-4" viewBox="38.657999999999994 12.828 207.085 207.085" xmlns="http://www.w3.org/2000/svg"
                                fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M158.232 219.912v-94.461h31.707l4.747-36.813h-36.454V65.134c0-10.658 2.96-17.922 18.245-17.922l19.494-.009V14.278c-3.373-.447-14.944-1.449-28.406-1.449-28.106 0-47.348 17.155-47.348 48.661v27.149H88.428v36.813h31.788v94.461l38.016-.001z"
                                        fill="#ffffff"></path>
                                </g>
                            </svg>
                            Continue with Facebook
                        </Button>
                    </div>

                </div>


            </main>
        </div>
    </GuestLayout>
</template>