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
                            <option v-for="employee in employees" :value="employee.id">{{ employee.idno }} {{ employee.full_name}}</option>

                        </select>


                    </div>
                    <div class="form-group col-md-4">
                        <label for="emptype">Employee Type</label>
                        <select name="emptype" id="emptype" v-model="form.emptype"
                                class="form-control">
                            <option value="" disabled selected> --select option--</option>
                            <option value="casual">Casual</option>
                            <option value="attachee">Attachee</option>
                        </select>


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

                    </div>
                    <div class="form-group col-md-4">

                        <label for="unit_id">Unit</label>
                        <select name="unit_id" id="unit_id" v-model="form.unit_id"
                                class="form-control">
                            <option value="" disabled selected> --select option--</option>
                            <option v-for="unit in units" :value="unit.id">{{ unit.name }}</option>

                        </select>

                    </div>
                    <div class="form-group col-md-4">
                        <label for="salary">Salary</label>
                        <input type="text" name="salary" id="salary" v-model="form.salary"
                               class="form-control"
                        >
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

                    </div>
                    <div class="form-group col-md-4">
                        <label for="bank_branch">Bank Branch</label>
                        <input type="text" name="bank_branch" id="bank_branch" v-model="form.bank_branch"
                               class="form-control"
                        >


                    </div>
                    <div class="form-group col-md-4">
                        <label for="bank_account">Account Number</label>
                        <input type="text" name="bank_account" id="bank_account" v-model="form.bank_account"
                               class="form-control"
                        >

                    </div>
                </div>

            </div>


            <div class="card-footer">
                <div class="form-row justify-content-between mx-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                    </div>
                    <div>
                        <a class="btn btn-danger btn-sm">Cancel</a>
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
    components:{
        Datepicker
    },
    data(){
        return{
            stations:null,
            units:null,
            banks:null,
            employees:null,

          /*  form:{
                'employee_id':'',
                'emptype':'',
                'station_id':'',
                'unit_id':'',
                'bank_id':'',
                'salary':'',
                'start_date':'',
                'bank_branch':'',
                'bank_account':'',
            },*/
            form:{
                start_date:'',
            }


        }
    },
    methods:{
        submit(){

            axios.post('/api/contracts',this.form).then((response)=>{

            }).catch(()=>{
                console.log('Error');
            });
        },

        getStations(){
            axios.get('/api/stations').then((response)=>{
                this.stations=response.data.data;
            })
        },
        getUnits(){
            axios.get('/api/units').then((response)=>{
                this.units=response.data.data;
            })
        },
        getBanks(){
            axios.get('/api/banks').then((response)=>{
                this.banks=response.data.data;
            })
        },
        getEmployees(){
            axios.get('/api/employees').then((response)=>{
                this.employees=response.data.data;
            })
        },
        customFormatter(date) {
            return moment(date).format('dd/MM/YYYY');
        }
    },
    created() {
        this.getStations();
        this.getBanks();
        this.getUnits();
        this.getEmployees();
    }
}
</script>
