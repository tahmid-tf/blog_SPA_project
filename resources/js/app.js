// window.Vue = require("vue").default;

require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import { router } from "./router/index.js";

Vue.use(VueRouter);

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );

const app = new Vue({
    el: "#app",
    router
});
