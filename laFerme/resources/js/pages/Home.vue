<template>
    <h2 class="text-center mt-10 font-semibold text-2xl">
        Voici la liste des animaux en vente :
    </h2>
    <div
        class="flex sm:flex-wrap gap-10 mt-10 flex-nowrap items-center flex-col md:flex-row md:ml-10"
    >
        <Card v-for="animal in animals" :key="animal.id" :animal="animal" />
    </div>
</template>

<script setup>
import axios from "axios";
import { ref } from "vue";
import Card from "../components/animals/Card.vue";

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
</script>
