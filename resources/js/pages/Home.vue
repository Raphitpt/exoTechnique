<template>
    <h2 class="text-center mt-10 font-semibold text-2xl">
        Voici la liste des animaux en vente :
    </h2>
    <div
        class="mt-10 md:max-w-3xl max-w-80 flex md:justify-start justify-center gap-3 md:flex-row flex-col md:ml-10 md:mx-0 mx-auto"
    >
        <div
            v-if="isAuthenticated"
            class="flex flex-col gap-2 font-bold self-end"
        >
            <router-link
                to="/animals/add"
                class="p-2 bg-green-700 hover:bg-green-900 text-white rounded-md"
                aria-label="Ajouter un animal"
            >
                + Ajouter un animal
            </router-link>
        </div>
        <div class="flex flex-col gap-2 font-bold">
            <label for="sort" class=""> Trier par :</label>
            <select
                id="sort"
                @change="sortBy"
                v-model="selectedSort"
                class="p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-md"
                aria-label="Trier par"
            >
                <option value="AZ">Nom (A-Z)</option>
                <option value="ZA">Nom (Z-A)</option>
                <option value="priceAsc">Prix (croissant)</option>
                <option value="priceDesc">Prix (décroissant)</option>
            </select>
        </div>
        <div class="flex flex-col gap-2 font-bold">
            <label for="type" class=""> Filtrer par type :</label>
            <select
                id="type"
                v-model="selectedType"
                @change="fetchAnimalByType"
                class="p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-md"
                aria-label="Filtrer par type"
            >
                <option value="null" disabled selected>
                    Choisissez un type
                </option>
                <option value="0">Tous les types</option>
                <option v-for="type in types" :key="type.id" :value="type.id">
                    {{ type.name }}
                </option>
            </select>
        </div>
        <div class="flex flex-col gap-2 font-bold">
            <label for="race" class=""> Filtrer par race :</label>
            <select
                id="race"
                v-model="selectedRace"
                @change="fetchAnimalByRace"
                class="p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-md"
                aria-label="Filtrer par race"
            >
                <option value="" disabled selected>Choisissez une race</option>
                <option
                    value="0"
                    v-if="selectedType !== 'null' && selectedType !== '0'"
                >
                    Toutes les races
                </option>
                <option v-for="race in races" :key="race.id" :value="race.id">
                    {{ race.name }}
                </option>
            </select>
        </div>
    </div>

    <div
        class="flex sm:flex-wrap gap-10 mt-10 flex-nowrap items-center flex-col md:flex-row md:ml-10"
    >
        <p v-if="!animals.length" class="text-center">Aucun animal trouvé</p>
        <Card
            v-else
            v-for="animal in animals"
            :key="animal.id"
            :animal="animal"
        />
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, computed } from "vue";
import Card from "../components/animals/Card.vue";
import { useStore } from "vuex";

const store = useStore();

const animals = ref([]);
const types = ref([]);
const races = ref([]);
const selectedType = ref("null");
const selectedRace = ref("");
const selectedSort = ref("AZ");
const isLoading = ref(false);

const handleError = (error) => {
    console.error(error);
};

const sortBy = () => {
    switch (selectedSort.value) {
        case "AZ":
            animals.value.sort((a, b) => a.name.localeCompare(b.name));
            break;
        case "ZA":
            animals.value.sort((a, b) => b.name.localeCompare(a.name));
            break;
        case "priceAsc":
            animals.value.sort((a, b) => a.price - b.price);
            break;
        case "priceDesc":
            animals.value.sort((a, b) => b.price - a.price);
            break;
    }
};

const fetchAnimals = async () => {
    isLoading.value = true;
    try {
        const response = await axios.get("/api/animals");
        animals.value = response.data;
    } catch (error) {
        handleError(error);
    } finally {
        isLoading.value = false;
    }
};

const fetchAnimalByType = async () => {
    isLoading.value = true;
    try {
        if (selectedType.value === "0") {
            await fetchAnimals();
            races.value = [];
            selectedRace.value = "";
        } else {
            const response = await axios.get(
                `/api/animals/type/${selectedType.value}`
            );
            animals.value = response.data;
            await fetchRaces();
        }
    } catch (error) {
        handleError(error);
    } finally {
        isLoading.value = false;
    }
};

const fetchAnimalByRace = async () => {
    isLoading.value = true;
    try {
        const response = await axios.get(
            `/api/animals/race/${selectedType.value}/${selectedRace.value}`
        );
        animals.value = response.data;
    } catch (error) {
        handleError(error);
    } finally {
        isLoading.value = false;
    }
};

const fetchTypes = async () => {
    try {
        const response = await axios.get("/api/types");
        types.value = response.data;
    } catch (error) {
        handleError(error);
    }
};

const fetchRaces = async () => {
    try {
        const response = await axios.get(`/api/races/${selectedType.value}`);
        races.value = response.data;
    } catch (error) {
        handleError(error);
    }
};

const isAuthenticated = computed(() => store.getters.isAuthenticated);

fetchAnimals();
fetchTypes();
</script>
