<template>
    <div class="flex justify-center flex-col gap-10">
        <div
            class="flex flex-col-reverse md:flex-row items-center justify-center gap-10"
        >
            <div>
                <h3 class="capitalize">
                    <strong>Nom :</strong>
                    {{ animalData.name || "indisponible" }}
                </h3>

                <p>
                    <strong>Age :</strong>
                    {{ animalData.age || "indisponible" }} mois
                </p>

                <p class="capitalize">
                    <strong>Type :</strong> {{ animalData.type }}
                </p>
                <p class="capitalize">
                    <strong> Race :</strong>
                    {{ animalData.race || "indisponible" }}
                </p>
                <p class="md:max-w-80">
                    <strong>Description :</strong>
                    {{ animalData.description || "indisponible" }}
                </p>
                <p>
                    <strong>Prix :</strong>
                    {{
                        Math.round(
                            animalData.price * (animalData.tax / 100 + 1)
                        ) || "indisponible"
                    }}
                    € TTC
                </p>
                <!-- Remaining details -->
            </div>
            <carousel
                v-if="animalData.pictures"
                :images="animalData.pictures"
                alt-text="Photo de {{ animalData.name }}"
            ></carousel>
        </div>
        <a
            href="tel:+33612345678"
            class="mt-5 p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-md max-w-xs m-auto text-center"
        >
            Nous contacter : 06 12 34 56 78
        </a>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, defineProps, onMounted } from "vue";
import Carousel from "../components/carousel/Carousel.vue";

const animalData = ref({});
const props = defineProps({
    id: String,
});

const fetchAnimal = async () => {
    try {
        const response = await axios.get(`/api/animals/${props.id}`);
        animalData.value = response.data;
    } catch (error) {
        console.error(error);
    }
};

onMounted(() => {
    fetchAnimal();
});
</script>
