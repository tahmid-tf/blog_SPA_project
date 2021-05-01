import ExampleComponent from "../components/ExampleComponent";
import BlogMainPage from "../components/blog/main_page.vue";
import SinglePage from "../components/blog/single_page";
import AdminPage from "../components/admin/admin_index";

export const routes = [
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
    }
];
