import Vue from "vue";

Vue.component('loading',require('./components/loading.vue').default)
Vue.component('contract-create',require('./components/contracts/ContractCreate.vue').default);
Vue.component('department-list',require('./components/departments/Departments.vue').default)
Vue.component('station-create',require('./components/stations/StationCreate.vue').default)
Vue.component('bank-create',require('./components/banks/BankCreate.vue').default)
Vue.component('unit-create',require('./components/units/UnitCreate.vue').default);
Vue.component('category-create',require('./components/categories/CategoryCreate.vue').default);
Vue.component('users',require('./components/users/User.vue').default);
Vue.component('role',require('./components/users/Role.vue').default);

Vue.component('approve-payroll',require('./components/payrolls/Approve.vue').default);
Vue.component('payslip-search',require('./components/payrolls/Payslip.vue').default);

Vue.component('contract-datatable',require('./components/contracts/ContractDataTable.vue').default);
