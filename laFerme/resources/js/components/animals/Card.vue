<template>
    <div
        class="min-w-80 max-w-sm bg-white border border-gray-200 rounded-lg shadow"
    >
        <img
            class="rounded-t-lg object-cover h-56 w-full"
            :src="animal.pictures[0]"
            alt=""
        />

        <div class="p-5">
            <h5
                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 capitalize"
            >
                {{ animal.name }}
            </h5>
            <p class="mb-2">
                <span class="text-gray-900 font-bold">Age : </span>
                <span class="text-gray-700">{{ animal.age }} mois</span>
            </p>
            <p>
                <span class="text-gray-900 font-bold">Type : </span>
                <span class="text-gray-700 capitalize">{{ animal.type }}</span>
            </p>
            <p class="mb-2">
                <span class="text-gray-900 font-bold">Race : </span>
                <span class="text-gray-700 capitalize">{{ animal.race }}</span>
            </p>

            <p class="mb-3 font-normal text-gray-700">
                {{ animal.description }}
            </p>

            <h6 class="mb-2">
                <span class="text-gray-900 font-bold">Prix : </span>
                <span class="text-gray-700"
                    >{{ Math.round(animal.price * (animal.tax / 100 + 1)) }} €
                    TTC</span
                >
            </h6>
            <div class="flex justify-between">
                <router-link
                    :to="'/animals/' + animal.id"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                >
                    En savoir plus
                    <svg
                        class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 14 10"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9"
                        />
                    </svg>
                </router-link>
                <router-link
                    v-if="isAuthenticated"
                    :to="'/animals/edit/' + animal.id"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                    >Modifier</router-link
                >
            </div>
            <button
                v-if="isAuthenticated"
                @click="deleteAnimal"
                class="mt-2 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300"
            >
                Supprimer
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, defineProps } from "vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();
const store = useStore();

const props = defineProps({
    animal: Object,
});
const deleteAnimal = async () => {
    try {
        if (confirm("Voulez-vous vraiment supprimer cet animal ?")) {
            await axios.post(`/api/animals/delete/${props.animal.id}`, null, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            });
            window.location.reload();
        }
    } catch (error) {
        console.error(error);
    }
};
const isAuthenticated = computed(() => store.getters.isAuthenticated);
</script>
