// window.Vue = require("vue").default;

require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import { router } from "./router/index.js";

Vue.use(VueRouter);

Vue.component("pagination", require("laravel-vue-pagination"));

Vue.component(
    "admin-index-page",
    require("./components/admin/admin_index").default
);

const app = new Vue({
    el: "#app",
    router
});
