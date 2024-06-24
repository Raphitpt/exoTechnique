<template>
    <header class="bg-gray-50 py-3 shadow-md">
        <nav class="container mx-auto flex items-center justify-between">
            <img
                src="../../../assets/logo/logo.svg"
                alt="La Ferme"
                class="max-h-10"
            />
            <button @click="toggleMenu" class="md:hidden">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>
            </button>
            <ul
                :class="{ 'hidden md:flex': !isMenuOpen }"
                class="flex-col md:flex-row items-center justify-center gap-4 md:gap-20 flex-grow"
            >
                <router-link
                    to="/"
                    exact-active-class="text-blue-700"
                    class="my-auto"
                    ><li>Accueil</li></router-link
                >
                <router-link
                    to="/contact"
                    exact-active-class="text-blue-700"
                    class="my-auto"
                    ><li>Contact</li></router-link
                >
            </ul>
            <div
                class="hidden md:block my-auto bg-blue-700 hover:bg-blue-800 p-3 rounded-lg"
            >
                <router-link to="/login" class="text-white"
                    >Se connecter</router-link
                >
            </div>
        </nav>
        <ul
            v-if="isMenuOpen"
            class="md:hidden flex flex-col items-center gap-4 mt-3"
        >
            <router-link
                to="/"
                exact-active-class="text-sky-500"
                class="my-auto"
                ><li>Accueil</li></router-link
            >
            <router-link
                to="/contact"
                exact-active-class="text-sky-500"
                class="my-auto"
                ><li>Contact</li></router-link
            >
            <div class="my-auto bg-sky-500 p-3 rounded-lg">
                <router-link to="/login" class="text-white"
                    >Se connecter</router-link
                >
            </div>
        </ul>
    </header>
</template>

<script setup>
import { ref } from "vue";

const isMenuOpen = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};
</script>
