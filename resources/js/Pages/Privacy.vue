<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const terms = ref([
    {
        title: "Introduction",
        content: "This Privacy Policy describes how we collect, use, process, and disclose your information, including personal information, in conjunction with your access to and use of our services."
    },
    {
        title: "Information We Collect",
        content: "We collect various types of information, including: personal information you provide directly, information automatically collected from your use of our services, and information from third-party sources."
    },
    {
        title: "How We Use Your Information",
        content: "We use the information we collect for purposes including: providing and improving our services, communicating with you, conducting analytics and research, and complying with legal obligations."
    },
    {
        title: "Information Sharing and Disclosure",
        content: "We may share your information with: service providers, business partners, for legal reasons, and in connection with a business transfer."
    },
    {
        title: "Your Rights and Choices",
        content: "Depending on your location, you may have certain rights regarding your personal information, including the right to access, correct, delete, or restrict use of your information."
    },
    {
        title: "Data Retention and Deletion",
        content: "We retain your personal information for as long as necessary to provide our services, comply with legal obligations, resolve disputes, and enforce our agreements."
    },
    {
        title: "Security",
        content: "We implement appropriate technical and organizational measures to protect the security of your personal information against unauthorized or unlawful processing, accidental loss, destruction, or damage."
    },
    {
        title: "International Data Transfers",
        content: "Your information may be transferred to, and processed in, countries other than the country you live in. We ensure that appropriate safeguards are in place for such transfers."
    },
    {
        title: "Children's Privacy",
        content: "Our services are not directed to children under the age of 13. If you believe we have collected personal information from a child under 13, please contact us."
    },
    {
        title: "Changes to This Privacy Policy",
        content: "We may modify this Privacy Policy from time to time. We will notify you of material changes by posting a notice on our website or sending you a notification."
    },
    {
        title: "Third-Party Services",
        content: "Our services may contain links to third-party websites or services. We are not responsible for the privacy practices or content of these third-party sites."
    },
    {
        title: "Contact Us",
        content: "If you have any questions about this Privacy Policy or our privacy practices, please contact us at [Your Contact Information]."
    },
    {
        title: "Cookies and Tracking Technologies",
        content: "We use cookies and similar tracking technologies to collect and use personal information about you, including to serve interest-based advertising."
    },
    {
        title: "Data Protection Officer",
        content: "We have appointed a Data Protection Officer who is responsible for overseeing questions in relation to this Privacy Policy. You can contact our DPO at [DPO Contact Information]."
    },
    {
        title: "Legal Basis for Processing (EU Users)",
        content: "For users in the European Union, we collect and process information about you only where we have legal bases for doing so under applicable EU laws."
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
            <h1 class="text-3xl font-bold">Privacy Policy</h1>

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
