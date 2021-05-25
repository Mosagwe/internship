require('./bootstrap');

import 'jquery-ui/ui/widgets/datepicker.js';

$(function(){
    $('form select').select2();
})

//Vue
window.Vue=require('vue').default;
window.Fire=new Vue();
//import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.component('role', require('./components/role.vue').default);

const app=new Vue({
    el: '#app'
});


