import ExampleComponent from "../components/ExampleComponent";
import BlogMainPage from "../components/blog/mainPage.vue";

export const routes = [
    {
        path: "/",
        component: ExampleComponent
    },
    {
        path: "/test",
        component: BlogMainPage
    }
];
