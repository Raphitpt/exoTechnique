<template>
    <h2 class="text-center mt-10 font-semibold text-2xl">
        Voici la liste des animaux en vente :
    </h2>
    <div class="mt-10 flex md:justify-start justify-center">
        <router-link
            v-if="isAuthenticated"
            to="/animals/add"
            class="p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-md md:ml-10"
        >
            Ajouter un animal
        </router-link>
    </div>

    <div
        class="flex sm:flex-wrap gap-10 mt-10 flex-nowrap items-center flex-col md:flex-row md:ml-10"
    >
        <Card v-for="animal in animals" :key="animal.id" :animal="animal" />
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, computed } from "vue";
import Card from "../components/animals/Card.vue";
import { useStore } from "vuex";

const store = useStore();

const animals = ref([]);

const fetchAnimals = () => {
    axios
        .get("/api/animals")
        .then((response) => {
            animals.value = response.data;
        })
        .catch((error) => {
            console.error(error);
        });
};
fetchAnimals();

const isAuthenticated = computed(() => store.getters.isAuthenticated);
</script>
