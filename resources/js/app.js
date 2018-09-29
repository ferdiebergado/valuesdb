/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
require("datatables.net");
require("datatables.net-bs4");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("image-upload", require("./components/ImageUpload.vue"));

const app = new Vue({
    el: "#app",
    data() {
        return {
            region: "",
            divisions: {},
            disabled: true,
            loading: false
        };
    },
    methods: {
        fetchDivisions() {
            var vm = this;
            this.loading = true;
            if (this.region === "" || this.region === 19) {
                this.disabled = true;
            } else {
                this.disabled = false;
            }
            axios
                .get("/values/divisions", {
                    params: { region_id: this.region }
                })
                .then(function(res) {
                    vm.$set(vm.$data, "divisions", res.data);
                    vm.$set(vm.$data, "loading", false);
                })
                .catch(function(err) {
                    console.log(err.response.data);
                });
        }
    }
});
