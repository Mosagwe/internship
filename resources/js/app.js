import moment from "moment";

require('./bootstrap');

import 'jquery-ui/ui/widgets/datepicker.js';

$(function(){
    $('.select2').select2();
})




import Vue from 'vue';
//window.Vue=require('vue').default;
window.Fire=new Vue();

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import VueRouter from "vue-router"
Vue.use(VueRouter)

//sweetalert2
import Swal from "sweetalert2";
window.swal=Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.toast=Toast;


//vue-toastr
import VueToastr from "vue-toastr";
// use plugin
Vue.use(VueToastr, {
    /* OverWrite Plugin Options if you need */
    defaultTimeout: 3000,
    defaultProgressBar: false,
    defaultProgressBarValue: 0,
    defaultPosition: "toast-top-right",
    defaultClassNames: ["animated", "zoomInUp"],
    /* defaultType: "error",
     defaultCloseOnHover: false,
     defaultStyle: { "background-color": "red" },
     */
});

//Filters
Vue.filter('myDate', function(date){
    return moment(date).format('MMMM Do YYYY ');
});

//V-form
import Form from 'vform';
window.Form=Form;
import {
    Button,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
} from 'vform/src/components/bootstrap5'
// 'vform/src/components/bootstrap4'
// 'vform/src/components/tailwind'

Vue.component(Button.name, Button)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertErrors.name, AlertErrors)
Vue.component(AlertSuccess.name, AlertSuccess)

//progressbar
import  VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar,{
    color:'rgb(143,255,199)',
    failedColor:'red',
    thickness:'5px'
})
//
require('./components.js');

const app=new Vue({
    el: '#app',
});


