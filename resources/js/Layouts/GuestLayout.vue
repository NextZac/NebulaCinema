<script setup>
import { ref, getCurrentInstance } from "vue";
import { router } from "@inertiajs/vue3";
import { ChevronDown, Search, Github, User } from "lucide-vue-next";

import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Input from "@/Components/Input.vue";
import Dropdown from "@/Components/Dropdown.vue";
import SelectOption from "@/Components/SelectOption.vue";

const instance = getCurrentInstance();
const __ = instance.appContext.config.globalProperties.__;

const dropdowns = ref({
    kinod: false,
    grupid: false,
    avatar: false,
    language: false,
});

const toggleDropdown = (key) => {
    dropdowns.value[key] = !dropdowns.value[key];
};

const dropdownOptions = ref({
    kinod: [
        { title: "Ülemiste Keskus", href: "#" },
        { title: "T1 Keskus", href: "#" },
        { title: "Viru Keskus", href: "#" },
        { title: "Tasku Keskus", href: "#" },
    ],
    grupid: [
        { title: __("header.grupid.privaatseanss"), href: "#" },
        { title: __("header.grupid.birthday"), href: "#" },
        { title: __("header.grupid.school"), href: "#" },
    ],
    avatar: [
        ...(router.page.props.auth.user
            ? [{ title: __("header.avatar.profiil"), href: "#" }]
            : []),
        ...(router.page.props.auth.user
            ? [{ title: __("header.avatar.ajalugu"), href: "#" }]
            : []),
        ...(router.page.props.auth.user
            ? [
                  {
                      title: __("header.avatar.logout"),
                      action: "logout",
                      color: "error",
                  },
              ]
            : []),
        ...(router.page.props.auth.user
            ? []
            : [
                  {
                      title: __("header.avatar.login"),
                      href: route("login"),
                  },
              ]),
    ],
    language: [
        { title: "Estonian", href: "/lang/et" },
        { title: "English", href: "/lang/en" },
    ],
});

const htmlLang = document.documentElement.lang;

const selectedLanguage = ref(dropdownOptions.value.language[1].title);

if (htmlLang === "et") {
    selectedLanguage.value = dropdownOptions.value.language[0].title;
} else if (htmlLang === "en") {
    selectedLanguage.value = dropdownOptions.value.language[1].title;
}

const searchModel = ref("");
const searchResults = ref([]);
const search = () => {
    axios
        .get(route("Movie.search"), { params: { query: searchModel.value } })
        .then((response) => {
            searchResults.value = [];
            searchResults.value.push(...response.data);
        });
};

const navLinks = [
    { name: __("header.kinokava"), route: "Schedule" },
    { name: __("header.kinod"), dropdown: "kinod" },
    { name: __("header.filmid"), route: "Movies" },
    { name: __("header.grupid.name"), dropdown: "grupid" },
    { name: __("header.kinkekaardid"), route: "Giftcards" },
    { name: "Components", route: "Components" },
];

const logout = async () => {
    try {
        await axios.post(route("logout"));
        window.location.href = route("Home");
    } catch (error) {
        console.error("Logout failed:", error);
    }
};

const parseDropdown = (event) => {
    if (event.action === "logout") {
        logout();
    }
    if (event.href) {
        window.location.href = event.href;
    }
};
</script>

<template>
    <div class="min-h-screen bg-brand-950">
        <!-- Header -->
        <header
            class="flex sticky top-0 w-full items-center gap-[40px] px-[25px] py-[15px] bg-brand-975 border-b border-brand-900 z-50"
        >
            <!-- Logo (on Left side)-->
            <a :href="route('Home')" class="h-full">
                <ApplicationLogo class="w-40 h-20" />
            </a>

            <!-- Navigation Links (aka Left side) -->
            <template v-for="link in navLinks" :key="link.name">
                <a
                    v-if="link.route"
                    :href="route(link.route)"
                    :class="[
                        'text-subtitle hover:text-brand-400 select-none text-nowrap',
                        route().current(link.route)
                            ? 'underline underline-offset-4 text-brand-400'
                            : 'text-white',
                    ]"
                >
                    {{ link.name }}
                </a>
                <div v-else-if="link.dropdown" class="h-full cursor-pointer">
                    <a
                        @click="toggleDropdown(link.dropdown)"
                        :class="[
                            dropdowns[link.dropdown]
                                ? 'text-brand-400 pointer-events-none'
                                : 'text-white pointer-events-auto',
                            'group text-subtitle inline-flex items-center hover:text-brand-400 cursor-pointer select-none text-nowrap',
                        ]"
                    >
                        {{ link.name }}
                        <ChevronDown
                            :class="[
                                'w-4 h-4 ml-2 transition-transform duration-100',
                                dropdowns[link.dropdown] ? 'rotate-180' : '',
                            ]"
                        />
                    </a>
                    <Dropdown
                        class="top-[110%]"
                        v-model:isOpen="dropdowns[link.dropdown]"
                        :options="dropdownOptions[link.dropdown]"
                    />
                </div>
            </template>

            <!-- Right side-->
            <div class="flex w-full justify-end items-center gap-[40px]">
                <Input
                    v-model="searchModel"
                    @update:model-value="search()"
                    type="text"
                    :placeholder="__('header.otsing')"
                >
                    <Dropdown
                        class="-mt-8"
                        :isOpen="searchModel.length > 0"
                        :options="searchResults"
                        @select="parseDropdown"
                    />
                    <Search class="w-5 h-5 text-brand-white" />
                </Input>
                <div class="flex-shrink-0">
                    <img v-if="router.page.props.auth.user"
                        src="https://via.placeholder.com/40"
                        alt="User Avatar"
                        class="w-full h-full rounded-full border-2 border-gray-300 cursor-pointer transition duration-100 hover:scale-110 active:scale-100"
                        @click="toggleDropdown('avatar')"
                    />

                    <User
                        v-else
                        class="w-6 h-6 text-brand-white cursor-pointer transition duration-100 hover:scale-110 active:scale-100"
                        @click="toggleDropdown('avatar')"
                    />

                    <Dropdown
                        class="top-[110%] right-5"
                        v-model:isOpen="dropdowns.avatar"
                        :options="dropdownOptions.avatar"
                        @select="parseDropdown"
                    />
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main
            class="flex sm:justify-center items-center pt-6 sm:pt-0 overflow-x-hidden"
        >
            <div class="w-full min-h-screen mt-6 px-[300px] py-[30px]">
                <slot />
            </div>
        </main>

        <!-- Footer -->
        <footer
            class="flex mt-6 bg-brand-975 border-t border-brand-900 text-white px-[25px] py-[25px] text-center"
        >
            <!--Left side-->
            <div class="flex w-full items-center gap-6">
                <p class="text-brand-white/50 text-detail font-light">
                    © {{ new Date().getFullYear() }} Nebula Cinemas.
                </p>
                <a
                    :href="route('Terms')"
                    class="font-light text-brand-white/50 hover:text-brand-400 underline underline-offset-2"
                    >{{ __("footer.terms") }}</a
                >
                <a
                    :href="route('Privacy')"
                    class="font-light text-brand-white/50 hover:text-brand-400 underline underline-offset-2"
                    >{{ __("footer.privacy") }}</a
                >
            </div>

            <!--Right side-->
            <div class="flex w-full justify-end items-center gap-6">
                <SelectOption
                    :options="dropdownOptions.language"
                    v-model="selectedLanguage"
                    align="top"
                    class="w-min rounded-lg"
                />
                <div class="flex gap-2">
                    <a class="group" :href="route('Home')">
                        <svg
                            class="w-6 h-6 text-brand-white/50 group-hover:text-brand-600"
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </footer>
    </div>
</template>
