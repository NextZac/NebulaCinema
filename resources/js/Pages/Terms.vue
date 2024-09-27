<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const terms = ref([
    {
        title: 'Introduction',
        content: 'Welcome to our service. By using our platform, you agree to these terms. Please read them carefully.'
    },
    {
        title: 'Definitions',
        content: 'In these Terms of Service, "we", "us", and "our" refer to the company providing the service. "You" refers to the user or viewer of our website.'
    },
    {
        title: 'Account Registration',
        content: 'You may need to create an account to use some of our services. You are responsible for maintaining the confidentiality of your account and password.'
    },
    {
        title: 'User Obligations',
        content: 'You agree to use our services only for lawful purposes and in accordance with these Terms of Service.'
    },
    {
        title: 'Intellectual Property Rights',
        content: 'The content on our platform, including text, graphics, logos, and software, is the property of our company or our content suppliers and is protected by copyright laws.'
    },
    {
        title: 'User-Generated Content',
        content: 'By posting content on our platform, you grant us a non-exclusive, royalty-free license to use, modify, publicly perform, publicly display, reproduce, and distribute such content.'
    },
    {
        title: 'Privacy Policy',
        content: 'Your use of our service is also governed by our Privacy Policy. Please review our Privacy Policy, which also governs the site and informs users of our data collection practices.'
    },
    {
        title: 'Disclaimer of Warranties',
        content: 'Our services are provided "as is" without any warranties, expressed or implied. We do not guarantee that our services will always be safe, secure or error-free.'
    },
    {
        title: 'Limitation of Liability',
        content: 'We will not be liable for any indirect, incidental, special, consequential or punitive damages resulting from your use of or inability to use our services.'
    },
    {
        title: 'Termination',
        content: 'We may terminate or suspend your account and bar access to the service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever.'
    },
    {
        title: 'Governing Law',
        content: 'These Terms shall be governed and construed in accordance with the laws of [Your Country/State], without regard to its conflict of law provisions.'
    },
    {
        title: 'Changes to Terms',
        content: 'We reserve the right, at our sole discretion, to modify or replace these Terms at any time. It is your responsibility to check these Terms periodically for changes.'
    },
    {
        title: 'Contact Information',
        content: 'If you have any questions about these Terms, please contact us at [Your Contact Information].'
    }
]);

const sectionRefs = ref(terms.value.map(() => null));
const headerHeight = ref(111);

const scrollToSection = (index) => {
    if (sectionRefs.value[index]) {
        const yOffset = -headerHeight.value - 20; // Additional 20px for some padding
        const element = sectionRefs.value[index];
        const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

        window.scrollTo({ top: y, behavior: 'smooth' });
    }
};
</script>

<template>

    <Head title="Terms of Service" />

    <GuestLayout>
        <main
            class="flex flex-col p-8 gap-8 justify-center w-full max-w-4xl mx-auto bg-brand-975 rounded-lg text-brand-white">
            <h1 class="text-3xl font-bold">Terms of Service</h1>

            <nav class="bg-brand-950 p-4 rounded-lg">
                <h2 class="text-xl font-semibold mb-2">Table of Contents</h2>
                <ul class="flex flex-wrap gap-4">
                    <li v-for="(section, index) in terms" :key="index">
                        <button @click="scrollToSection(index)"
                            class="text-brand-400 hover:text-brand-500 transition-colors rounded px-2 py-1">
                            {{ section.title }}
                        </button>
                    </li>
                </ul>
            </nav>

            <article class="space-y-12">
                <section v-for="(section, index) in terms" :key="index" :ref="el => { if (el) sectionRefs[index] = el }"
                    class="scroll-mt-8">
                    <h2 class="text-2xl font-semibold mb-4">{{ section.title }}</h2>
                    <p class="text-body text-pretty">{{ section.content }}</p>
                </section>
            </article>

            <footer class="mt-8 text-sm text-brand-400 border-t border-brand-800 pt-4">
                <p>Last updated: {{ new Date().toLocaleDateString() }}</p>
                <p class="mt-2">© {{ new Date().getFullYear() }} Nebula Cinemas.</p>
            </footer>
        </main>
    </GuestLayout>
</template>
