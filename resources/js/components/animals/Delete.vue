<template></template>

<script setup>
import axios from "axios";
import { ref, defineProps } from "vue";
const router = useRouter();

const props = defineProps({
    id: String,
});

const deleteAnimal = async () => {
    try {
        await axios.delete(`/api/animals/${props.id}`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
        });
        router.push("/");
    } catch (error) {
        console.error(error);
    }
};

deleteAnimal();
</script>
