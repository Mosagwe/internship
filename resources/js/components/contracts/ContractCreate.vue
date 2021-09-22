<template>
    <div class="card card-success card-outline">
        <form @submit.prevent="submit">
            <div class="card-header">New Contract</div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label>Employee</label>
                        <select name="employee_id" id="employee_id" v-model="form.employee_id"
                                class="form-control">
                            <option value="" disabled selected> --select option--</option>
                            <option v-for="employee in employees" :value="employee.id">{{ employee.idno }}
                                {{ employee.full_name }}
                            </option>
                        </select>
                        <HasError :form="form" field="employee_id"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label>Start Date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control" v-model="form.start_date">
                            <HasError :form="form" field="start_date"/>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label>Station</label>
                        <select name="station_id" id="station_id" v-model="form.station_id"
                                class="form-control">
                            <option value="" disabled selected> --select option--</option>
                            <option v-for="station in stations" :value="station.id">{{ station.name }}</option>
                        </select>
                        <HasError :form="form" field="station_id"/>
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
            employees: null,

            form: new Form({
                'employee_id': '',
                'station_id': '',
                'start_date': '',
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
                    title: 'Contract Created',
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
        this.getEmployees();
    }
}
</script>
