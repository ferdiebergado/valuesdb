/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
require("datatables.net");
require("datatables.net-bs4");
//  require('bootstrap-select');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component("image-upload", require("./components/ImageUpload.vue"));
Vue.component("region-select", require("./components/RegionSelect.vue"));
Vue.component("division-select", require("./components/DivisionSelect.vue"));
// Vue.component("data-viewer", require("./components/DataViewer.vue"));
Vue.component("activity-list", require("./components/ActivityList.vue"));

import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
window.flatpickrhtml = require("flatpickr");
// require('bootstrap-select');

Vue.use(flatPickr);

window.eventBus = new Vue();

const app = new Vue({
    el: "#app"
});

$("#divAlertSuccess")
    .delay(4000)
    .fadeOut(600);
