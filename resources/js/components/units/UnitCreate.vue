<template>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Units List</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-1">
                        <button class="btn btn-success" @click="createMode"><i class="fas fa-plus-circle fa-fw"></i>Add New
                        </button>
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr class="bg-success">
                    <th>#</th>
                    <th>Unit</th>
                    <th>Department</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="unit in units">
                    <td>{{ unit.id }}</td>
                    <td>{{ unit.name }}</td>
                    <td>{{ unit.department.name }}</td>
                    <td>{{ unit.created_at | myDate}}</td>
                    <td>{{ unit.updated_at | myDate}}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" @click.prevent="editUnit(unit)"><i
                            class="fa fa-edit fa-fw"></i> </a>
                        <a href="" class="btn btn-sm btn-danger" @click.prevent="deleteUnit(unit.id)"><i
                            class="fa fa-trash fa-fw"></i> </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <loading :loading="loading"></loading>

            <!--modal -->
            <div class="modal fade" id="createUnit" tabindex="-1" role="dialog"
                 aria-labelledby="ceateUnitModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createUnitModalLabel" v-show="!editMode">Create
                                Bank</h5>
                            <h5 class="modal-title" id="createUnitModalLabel" v-show="editMode">Update
                                Bank Details </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? update() : save()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Unit Name</label>
                                    <input type="text" name="name" v-model="form.name" id="name"
                                           class="form-control" :class="{'is-invalid':form.errors.has('name')}">
                                    <HasError :form="form" field="name"/>
                                </div>
                                <div class="form-group">
                                    <label>Department</label>
                                    <select name="department_id" id="department_id" v-model="form.department_id" class="form-control">
                                        <option value="" disabled>Please select the department</option>
                                        <option v-for="department in departments" :value="department.id">{{ department.name }}</option>
                                    </select>

                                    <HasError :form="form" field="department_id"/>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <b-button variant="success" v-if="!dis" disabled>
                                    <b-spinner small></b-spinner>
                                    {{ action }}
                                </b-button>
                                <button type="submit" v-if="dis" class="btn btn-primary" v-show="!editMode" >
                                    Save changes
                                </button>
                                <button type="submit" v-if="dis" class="btn btn-primary" v-show="editMode" >
                                    Update changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--end modal -->
        </div>
    </div>
</template>
<script>
export default {

    data() {
        return {
            units: null,
            departments:null,
            editMode: false,
            action:'',
            dis:true,
            loading:false,

            form: new Form({
                id:'',
                name: '',
                department_id: '',
            }),

        }
    },
    methods: {
        createMode() {
            this.editMode = false;
            this.form.reset();
            $('#createUnit').modal('show');
            this.form.clear();
        },
        getUnits() {
            this.loading=true;
            axios.get('/api/units').then((response) => {
                this.loading=false;
                this.units = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load units', 'Error');
            })
        },
        getDepartments() {
            axios.get('/api/departments').then((response) => {
                this.departments = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load departments', 'Error');
            })
        },

        editUnit(unit) {
            this.editMode = true;
            this.form.reset();
            this.form.fill(unit);
            $('#createUnit').modal('show');
        },
        deleteUnit(id) {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$Progress.start();
                    this.form.delete('/api/units/'+id).then((response)=>{
                        swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        Fire.$emit('loadData');
                        this.$Progress.finish();
                    }).catch(()=>{
                        toast.fire({
                            icon:'error',
                            title:'Oops... Something went wrong, try again!,'
                        });
                        this.$Progress.fail();
                    })

                }
            })

        },
        update() {
            this.$Progress.start()
            this.action='Updating record ...';
            this.dis=false;
            this.form.put('/api/units/'+this.form.id).then((response)=>{
                this.dis=true;
                this.$toastr.s('Update is successful','Success');
                Fire.$emit('loadData');
                $('#createUnit').modal('hide');
                this.form.reset();
                this.$Progress.finish()

            }).catch(()=>{
                this.dis=true;
                this.$toastr.e('Cannot update the information, try again', 'Error');
                this.$Progress.fail()
            });

        },
        save() {
            this.$Progress.start()
            this.action='Creating record ...';
            this.dis=false;
            this.form.post('/api/units').then((response) => {
                this.$Progress.finish()
                this.dis=true;
                toast.fire({
                    icon: 'success',
                    title: 'Record save successfully'
                });
                Fire.$emit('loadData');
                $('#createUnit').modal('hide');
                this.form.reset();
            }).catch(() => {
                this.$toastr.e('Cannot save record, try again!', 'Error');
                this.dis=true;
                this.$Progress.fail()
            });
        }

    },
    created() {
        this.getUnits();
        this.getDepartments();
        Fire.$on('loadData',()=>{
            this.getUnits();
        })
    }
}
</script>
