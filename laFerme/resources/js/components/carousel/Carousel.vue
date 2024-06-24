<template>
    <div class="flex justify-center items-center gap-4">
        <button
            @click="prevSlide"
            :disabled="props.images.length <= 1"
            class="p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-full focus:outline-none"
        >
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
                    d="M15 19l-7-7 7-7"
                />
            </svg>
        </button>
        <img
            :src="currentImage"
            :alt="altText"
            class="w-80 h-80 object-cover rounded-lg mt-5"
        />
        <button
            @click="nextSlide"
            :disabled="props.images.length <= 1"
            class="p-2 bg-blue-700 hover:bg-blue-800 text-white rounded-full focus:outline-none"
        >
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
                    d="M9 5l7 7-7 7"
                />
            </svg>
        </button>
    </div>
</template>

<script setup>
import { ref, computed, defineProps, watch } from "vue";

const props = defineProps({
    images: Array,
    altText: String,
});

const currentIndex = ref(0);

const currentImage = computed(() => {
    return props.images[currentIndex.value];
});

const nextSlide = () => {
    if (props.images.length > 1) {
        currentIndex.value = (currentIndex.value + 1) % props.images.length;
    }
};

const prevSlide = () => {
    if (props.images.length > 1) {
        currentIndex.value =
            (currentIndex.value - 1 + props.images.length) %
            props.images.length;
    }
};

// Reset index when images change
watch(
    () => props.images,
    () => {
        currentIndex.value = 0;
    }
);
</script>
