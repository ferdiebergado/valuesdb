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
            divisions: {}
        };
    },
    mounted() {
        this.fetchDivisions();
    },
    methods: {
        fetchDivisions() {
            var vm = this;
            axios
                .get("/values/divisions", {
                    params: { region_id: this.region }
                })
                .then(function(res) {
                    console.log(res.data);
                    vm.$set(vm.$data, "divisions", res.data);
                })
                .catch(function(err) {
                    console.log(err.response.data);
                });
        }
    }
});

/**
 * @param  {input element}
 * @return {[file handle]}
 */
// try {
//     var readURL = function(input) {
//         if (input.files && input.files[0]) {
//             var reader = new FileReader();
//             reader.onload = function(e) {
//                 $("#avatar-preview").attr("src", e.target.result);
//             };
//             reader.readAsDataURL(input.files[0]);
//         }
//     };
// } catch (err) {
//     console.log(err.message);
// }

// $("#avatar-input").change(function() {
//     readURL(this);
// });
