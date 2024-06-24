<template>
    <div class="flex items-center justify-center flex-col">
        <img
            src="../../assets/logo/logo.svg"
            alt="Logo de la ferme"
            class="w-64 h-64"
        />
        <p v-if="errorMes" class="text-red-500">{{ errorMes }}</p>
        <form @submit.prevent="login" class="max-w-lg w-full m-auto h-72">
            <div class="mb-4">
                <label
                    for="email"
                    class="block text-sm font-medium text-gray-700"
                    >Email</label
                >
                <input
                    v-model="email"
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
            <div class="mb-4">
                <label
                    for="password"
                    class="block text-sm font-medium text-gray-700"
                    >Mot de passe</label
                >
                <input
                    v-model="password"
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
            <div class="mb-4">
                <button
                    type="submit"
                    class="w-full p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-md"
                >
                    Se connecter
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useStore } from "vuex";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

const errorMes = ref(null);
const email = ref("");
const password = ref("");

const store = useStore();

const login = () => {
    store
        .dispatch("login", { email: email.value, password: password.value })
        .then(() => {
            router.push("/");
        })
        .catch((error) => {
            console.error(error);
            errorMes.value =
                error.response.status === 401
                    ? "Email ou mot de passe incorrect"
                    : "Une erreur est survenue";
        });
};
</script>
