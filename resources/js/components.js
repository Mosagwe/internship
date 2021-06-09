import Vue from "vue";

Vue.component('loading',require('./components/loading.vue').default)
Vue.component('contract-create',require('./components/contracts/ContractCreate.vue').default);
Vue.component('department-list',require('./components/departments/Departments.vue').default)
Vue.component('station-create',require('./components/stations/StationCreate.vue').default)
Vue.component('bank-create',require('./components/banks/BankCreate.vue').default)
Vue.component('unit-create',require('./components/units/UnitCreate.vue').default);

