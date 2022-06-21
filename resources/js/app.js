require('./bootstrap');
//ดึง key api google map มาจาก ENV
var googleMapAPI = process.env.MIX_GOOGLE_MAP_KEY;

import Vue from 'vue';
import * as VueGoogleMaps from 'vue2-google-maps'
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'

window.Vue = require('vue').default;
//เรียกใช้ component หน้าหลัก
Vue.component('main-component', require('./components/main.vue').default);
// เรียกใช้ VueBootstrapTypeahead มาใช้ตรงช่องค้นหา
Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)

Vue.use(VueGoogleMaps, {
    load: {
        key: googleMapAPI
    }
})
new Vue({
    el: '#app',
    components: {
        VueBootstrapTypeahead
    }
});
