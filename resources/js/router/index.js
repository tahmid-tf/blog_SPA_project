import ExampleComponent from "../components/ExampleComponent";
import VueRouter from "vue-router";
import BlogMainPage from "../components/blog/main_page.vue";
import SinglePage from "../components/blog/single_page";
import AdminPage from "../components/admin/admin_index";
import AdminDashboard from "../components/admin/dashboard/dashboard";
import LoginUi from "../components/administration/login_ui";
import CreatePost from "../components/admin/post/post_create";
import ViewPost from "../components/admin/post/post_view";

const routes = [
    {
        path: "/",
        component: BlogMainPage
    },
    {
        path: "/single/:id",
        component: SinglePage,
        name: "Single"
    },
    {
        path: "/admin",
        component: AdminPage
    },
    {
        path: "/admin/dashboard",
        component: AdminDashboard,
        name: "Dashboard"
    },
    {
        path: "*",
        redirect: "/"
    },
    {
        path: "/login",
        component: LoginUi,
        name: "Login"
    },
    {
        path: "/admin/post/create",
        component: CreatePost,
        name: "CreatePost"
    },
    {
        path: "/admin/post/view",
        component: ViewPost,
        name: "ViewPost"
    }
];

export const router = new VueRouter({
    routes,
    mode: "history"
});
