<template>
    <div class="flex items-start justify-start flex-col max-h-screen h-screen">
        <p v-if="errorMes" class="text-red-500">{{ errorMes }}</p>
        <form
            @submit.prevent="createAnimal"
            class="max-w-lg w-full mx-auto h-72 mt-52"
        >
            <div class="mb-4">
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                    >Nom</label
                >
                <input
                    type="text"
                    id="name"
                    name="name"
                    v-model="animalData.name"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
            <div class="mb-4">
                <label for="age" class="block text-sm font-medium text-gray-700"
                    >Age (en mois)</label
                >
                <input
                    type="number"
                    id="age"
                    name="age"
                    v-model="animalData.age"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
            <div class="mb-4">
                <label
                    for="type"
                    class="block text-sm font-medium text-gray-700"
                    >Type</label
                >
                <select
                    id="type"
                    name="type"
                    v-model="animalData.type_id"
                    @change="fetchRaces"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                    <option value="" disabled selected>
                        Choisissez un type
                    </option>
                    <option
                        v-for="type in types"
                        :key="type.id"
                        :value="type.id"
                    >
                        {{ type.name }}
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <label
                    for="race"
                    class="block text-sm font-medium text-gray-700"
                    >Race</label
                >
                <select
                    id="race"
                    name="race"
                    v-model="animalData.race_id"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                    <option value="" disabled selected>
                        Choisissez une race
                    </option>
                    <option
                        v-for="race in races"
                        :key="race.id"
                        :value="race.id"
                    >
                        {{ race.name }}
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <label
                    for="state"
                    class="block text-sm font-medium text-gray-700"
                    >État</label
                >
                <select
                    id="state"
                    name="state"
                    v-model="animalData.state"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                    <option value="en vente">En vente</option>
                    <option value="vendu">Vendu</option>
                </select>
            </div>
            <div class="mb-4">
                <label
                    for="state"
                    class="block text-sm font-medium text-gray-700"
                    >Description</label
                >
                <textarea
                    id="description"
                    name="description"
                    v-model="animalData.description"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                >
                </textarea>
            </div>
            <div class="mb-4">
                <label
                    for="price"
                    class="block text-sm font-medium text-gray-700"
                    >Prix (hors taxe)</label
                >
                <input
                    type="number"
                    id="price"
                    name="price"
                    v-model="animalData.price"
                    required
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
            <div class="mb-4">
                <label
                    for="photos"
                    class="block text-sm font-medium text-gray-700"
                    >Photos</label
                >
                <div class="flex gap-2 max-w-auto overflow-x-auto">
                    <img
                        v-for="(photo, index) in animalData.pictures"
                        :key="index"
                        :src="photo"
                        :alt="`Photo ${index + 1}`"
                        class="h-20 w-20 object-cover rounded-md"
                    />
                </div>
                <input
                    type="file"
                    id="photos"
                    name="photos"
                    accept="image/*"
                    multiple
                    @change="handleFilesUpload($event)"
                    class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                />
            </div>
            <div class="mb-4">
                <button
                    type="submit"
                    class="w-full p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-md"
                >
                    Créer
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, defineProps } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

const animalData = ref({
    name: "",
    age: null,
    type_id: null,
    race_id: null,
    state: "en vente",
    description: "",
    price: null,
    pictures: [],
});
const types = ref([]);
const races = ref([]);
const errorMes = ref("");
const files = ref([]);

const props = defineProps();

const fetchTypes = async () => {
    try {
        const response = await axios.get(`/api/types`);
        types.value = response.data;
    } catch (error) {
        console.error(error);
        errorMes.value = "Erreur lors de la récupération des types.";
    }
};

const fetchRaces = async () => {
    try {
        const response = await axios.get(
            `/api/races/${animalData.value.type_id}`
        );
        races.value = response.data;
    } catch (error) {
        console.error(error);
        errorMes.value = "Erreur lors de la récupération des races.";
    }
};

const handleFilesUpload = (event) => {
    files.value = Array.from(event.target.files);
};

const createAnimal = async () => {
    const formData = new FormData();
    formData.append("name", animalData.value.name);
    formData.append("type_id", animalData.value.type_id);
    formData.append("age", animalData.value.age);
    formData.append("state", animalData.value.state);
    formData.append("race_id", animalData.value.race_id);
    formData.append("description", animalData.value.description);
    formData.append("price", animalData.value.price);

    if (files.value.length) {
        files.value.forEach((file, index) => {
            formData.append(`pictures[${index}]`, file);
        });
    }

    try {
        await axios.post(`/api/animals/save`, formData, {
            headers: {
                "Content-Type": "multipart/form-data",
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        });
        alert("L'animal a bien été créé.");
        router.push("/");
    } catch (error) {
        console.error(error);
        errorMes.value = "Erreur lors de la création de l'animal.";
    }
};

fetchTypes();
</script>
