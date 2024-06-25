import { createRouter, createWebHistory } from "vue-router";
import Home from "../pages/Home.vue";
import Contact from "../pages/Contact.vue";
import Login from "../pages/Login.vue";
import Animal from "../pages/Animal.vue";
import store from "../store/index";
import Edit from "../components/animals/Edit.vue";
import Add from "../components/animals/Add.vue";
import Delete from "../components/animals/Delete.vue";

const routes = [
    { path: "/", component: Home },
    { path: "/contact", component: Contact },
    { path: "/login", component: Login },
    { path: "/animals/:id", component: Animal, props: true },
    {
        path: "/animals/edit/:id",
        component: Edit,
        props: true,
        beforeEnter: (to, from, next) => {
            if (store.getters.isAuthenticated) {
                next();
            } else {
                next("/login");
            }
        },
    },
    {
        path: "/animals/add",
        component: Add,
        props: true,
        beforeEnter: (to, from, next) => {
            if (store.getters.isAuthenticated) {
                next();
            } else {
                next("/login");
            }
        },
    },
    {
        path: "/animals/delete/:id",
        component: Delete,
        props: true,
        name: "deleteAnimal",
        beforeEnter: (to, from, next) => {
            if (store.getters.isAuthenticated) {
                next();
            } else {
                next("/login");
            }
        },
    },
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
