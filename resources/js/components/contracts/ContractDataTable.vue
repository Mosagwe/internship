<template>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Contracts List</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-1">
                        <button class="btn btn-success" ><i class="fas fa-plus-circle fa-fw"></i>Add New
                        </button>
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-body">
            <v-data-table
                :headers="headers"
                :items="tableData"
                :items-per-page="5"
                class="elevation-1"
            ></v-data-table>
            <template slot="items" slot-scope="props">
                <td>{{ props.item.start_date}}</td>
                <td class="text-sm-right">{{ props.item.employee_id}}</td>
                <td class="text-sm-right">{{ props.item.created_at}}</td>
                <td class="text-sm-right">{{ props.item.salary}}</td>
                <td class="justify-center layout px-0">
                    <v-icon
                        small class="mr-2"
                    >Edit</v-icon>
                    <v-icon
                        small
                    >Delete</v-icon>
                </td>


            </template>
        </div>
    </div>
</template>

<script>
import Vuetify from "vuetify";

Vuetify
export default {


    data(){

        return {
            headers: [
                { text: 'Username', value: 'start_date' },
                { text: 'Empl ID', value: 'employee_id' },
                { text: 'Date (g)', value: 'created_at' },
                { text: 'Salary (g)', value: 'firstname' },
                { text: 'Actions', value: 'name',sortable:false },
            ],

            tableData:[],
        }

    },
    methods:{
        getContracts(){
            axios.get('/api/contracts').then((response)=>{
                this.tableData=response.data.data;
            });

        }

    },
    created() {
        this.getContracts();

    }
}
</script>


