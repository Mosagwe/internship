<template>
    <div class="card card-success card-outline">
        <form @submit.prevent="submit">

            <div class="card-header">New Contract</div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="employee_id">Employee</label>
                        <select name="employee_id" id="employee_id" v-model="form.employee_id"
                                class="form-control">
                            <option value="" disabled selected> --select option--</option>
                            <option v-for="employee in employees" :value="employee.id">{{ employee.idno }}
                                {{ employee.full_name }}
                            </option>
                        </select>
                        <HasError :form="form" field="employee_id"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Employee Type</label>
                        <select name="employee_type" id="employee_type" v-model="form.employee_type"
                                class="form-control">
                            <option value="" disabled selected> --select option--</option>
                            <option value="casual">Casual</option>
                            <option value="attachee">Attachee</option>
                        </select>
                        <HasError :form="form" field="employee_type"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Start Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <!-- <input type="text"
                                   class="form-control datepicker"
                                   id="start_date" name="start_date" v-model="form.start_date"
                                   autocomplete="off"> -->
                            <!--                           <Datepicker name="start_date" v-model="form.start_date"
                                                                   format="dd/MM/yyyy"
                                                                   input-class="form-control"
                                                                   lang="en" type=""
                                                       >

                                                       </Datepicker>-->
                            <input type="date" class="form-control" v-model="form.start_date">
                            <HasError :form="form" field="start_date"/>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="station_id">Station</label>
                        <select name="station_id" id="station_id" v-model="form.station_id"
                                class="form-control">
                            <option value="" disabled selected> --select option--</option>
                            <option v-for="station in stations" :value="station.id">{{ station.name }}</option>
                        </select>
                        <HasError :form="form" field="station_id"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="unit_id">Unit</label>
                        <select name="unit_id" id="unit_id" v-model="form.unit_id"
                                class="form-control">
                            <option value="" disabled selected> --select option--</option>
                            <option v-for="unit in units" :value="unit.id">{{ unit.name }}</option>
                        </select>
                        <HasError :form="form" field="unit_id"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="salary">Salary</label>
                        <input type="text" name="salary" id="salary" v-model="form.salary"
                               class="form-control"
                        >
                        <HasError :form="form" field="salary"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="bank_id">Bank</label>
                        <select name="bank_id" id="bank_id" v-model="form.bank_id"
                                class="form-control">
                            <option value="" disabled selected> --select option--</option>
                            <option v-for="bank in banks" :value="bank.id">{{ bank.bank_name }}</option>
                        </select>
                        <HasError :form="form" field="bank_id"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bank_branch">Bank Branch</label>
                        <input type="text" name="bank_branch" id="bank_branch" v-model="form.bank_branch"
                               class="form-control"
                        >
                        <HasError :form="form" field="bank_branch"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bank_account">Account Number</label>
                        <input type="text" name="bank_account" id="bank_account" v-model="form.bank_account"
                               class="form-control"
                        >
                        <HasError :form="form" field="bank_account"/>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-row justify-content-between mx-4">
                    <div class="form-group">
                        <b-button type="submit" variant="success" class="btn-lg btn-success" v-if="!dis" disabled>
                            <b-spinner small type="grow"></b-spinner>
                            {{ action }}
                        </b-button>
                        <button type="submit" v-if="dis" class="btn btn-sm btn-success"
                        @click.prevent="submit">
                            <i class="fas fa-save"></i>
                            Save</button>
                    </div>
                    <div>
                        <button class="btn btn-danger btn-sm" @click.prevent="cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</template>
<script>
import Datepicker from "vuejs-datepicker";
import moment from "moment";

export default {
    components: {
        Datepicker
    },
    data() {
        return {
            dis:true,
            action:'',
            stations: null,
            units: null,
            banks: null,
            employees: null,

            form: new Form({
                'employee_id': '',
                'employee_type': '',
                'station_id': '',
                'unit_id': '',
                'bank_id': '',
                'salary': '',
                'start_date': '',
                'bank_branch': '',
                'bank_account': '',
            }),
        }
    },
    methods: {
        submit() {
            this.dis=false;
            this.action='Saving...'
            this.form.post('/api/contracts').then((response) => {
                this.dis=true;
                swal.fire({
                    icon: 'success',
                    title: 'Role Created',
                    text: 'The Contract has been created.'
                })
                window.location = '/contract';
                this.form.reset();

            }).catch(() => {
                this.dis=true;
                toast.fire({
                    icon: 'error',
                    title: 'Oops...Something went wrong!',
                    //text: 'Something went wrong!'
                })
            });

        },
        cancel(){
            axios.get('/contract').then((response)=>{
                window.location='/contract';
            }).catch(()=>{
                console.log('error occurred');
            });
        },

        getStations() {
            axios.get('/api/stations').then((response) => {
                this.stations = response.data.data;
            })
        },
        getUnits() {
            axios.get('/api/units').then((response) => {
                this.units = response.data.data;
            })
        },
        getBanks() {
            axios.get('/api/banks').then((response) => {
                this.banks = response.data.data;
            })
        },
        getEmployees() {
            axios.get('/api/employees').then((response) => {
                this.employees = response.data.data;
            })
        },
        customFormatter(date) {
            return moment(date).format('dd/MM/YYYY');
        },



    },
    created() {
        this.getStations();
        this.getBanks();
        this.getUnits();
        this.getEmployees();
    }
}
</script>
