// window.Vue = require("vue").default;

require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import { routes } from "./router/index.js";

Vue.use(VueRouter);

import jQuery from "jquery";

window.jQuery = jQuery;
window.$ = jQuery;

const router = new VueRouter({
    routes,
    mode: "history"
});

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );

const app = new Vue({
    el: "#app",
    router
});
