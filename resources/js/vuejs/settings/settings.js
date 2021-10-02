window.Vue = require("vue").default;

import VueRouter from "vue-router";

import Settings from "./components/Settings"
import EditSettings from './components/EditSettings'
import EditPassword from './components/EditPassword'

Vue.use(VueRouter);

const routes = [{
        path: "/",
        name: "Settings",
        component: Settings
    },
    {
        path: "/edit",
        name: "EditSettings",
        component: EditSettings
    },
    {
        path: "/editpassword",
        name: "EditPassword",
        component: EditPassword
    }
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    el: "#settings",
    router,
    data() {
        return {
            user: null,
        }
    },
    beforeMount() {
        fetch('/getuser', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                }
            })
            .then(res => res.json())
            .then(res => {
                this.user = res
            });
    },
});