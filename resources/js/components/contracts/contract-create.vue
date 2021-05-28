<template>
            <div class="card card-success card-outline">
                <form >
                    <div class="card-header">New Contract</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Employee</label>
                                <select name="type"  v-model="form.type" id="type"
                                        class="form-control">
                                    <option value="" disabled selected> please select one</option>
                                    <option v-for="employee in employees" :value="employee.id">{{ employee.full_name}}</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-row justify-content-between mx-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success" @click.prevent="createContract">Submit</button>
                            </div>
                            <div>
                                <a href="#" class="btn btn-danger btn-sm">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

</template>
<script>
export default {
    data(){

        return{
            employees:[],

            form:new Form({
                'type':''
            })
        }

    },
    methods:{
        createContract(){
            this.form.post('/api/test')
                .then((response)=>{

            });

        }


    },
    created() {
        axios.get('/getEmployees').then((response)=>{
            this.employees=response.data.employees;
        })
    }
}
</script>
