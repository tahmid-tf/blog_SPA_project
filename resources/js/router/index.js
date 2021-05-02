import ExampleComponent from "../components/ExampleComponent";
import VueRouter from "vue-router";
import BlogMainPage from "../components/blog/main_page.vue";
import SinglePage from "../components/blog/single_page";
import AdminPage from "../components/admin/admin_index";
import AdminDashboard from "../components/admin/dashboard/dashboard";

const routes = [
    {
        path: "/",
        component: BlogMainPage
    },
    {
        path: "/single",
        component: SinglePage
    },
    {
        path: "/admin",
        component: AdminPage
    },
    {
        path: "/admin/dashboard",
        component: AdminDashboard,
        name: "Dashboard"
    }
];

export const router = new VueRouter({
    routes,
    mode: "history"
});
