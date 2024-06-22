import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import Contact from "../pages/Contact.vue";
import Login from "../pages/Login.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/contact", component: Contact },
    { path: "/login", component: Login },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
