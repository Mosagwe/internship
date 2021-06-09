<template>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Departments List</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-1">
                        <button class="btn btn-success" @click="createMode"><i class="fas fa-plus-circle"></i>Add New
                        </button>
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Department Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="department in departments">
                    <td>{{ department.id }}</td>
                    <td>{{ department.name }}</td>
                    <td>{{ department.created_at }}</td>
                    <td>{{ department.updated_at }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" @click.prevent="editDepartment(department)"><i
                            class="fa fa-edit"></i>Edit</a>
                        <a href="" class="btn btn-sm btn-danger" @click.prevent="deleteDepartment(department)"><i
                            class="fa fa-trash"></i>Delete</a>
                    </td>
                </tr>
                </tbody>
            </table>
            <loading :loading="loading"></loading>

            <!--modal -->
            <div class="modal fade" id="createDepartment" tabindex="-1" role="dialog"
                 aria-labelledby="ceateDepartmentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createDepartmentModalLabel" v-show="!editMode">Create
                                Department</h5>
                            <h5 class="modal-title" id="createDepartmentModalLabel" v-show="editMode">Update
                                Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Department Name</label>
                                    <input type="text" name="name" v-model="form.name" id="name" class="form-control">
                                    <HasError :form="form" field="name"/>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <b-button variant="success" v-if="!dis" disabled>
                                    <b-spinner small></b-spinner>
                                    {{ action }}
                                </b-button>
                                <button type="button" v-if="dis" class="btn btn-primary" v-show="!editMode" @click.prevent="save">
                                    Save changes
                                </button>
                                <button type="button" v-if="dis" class="btn btn-primary" v-show="editMode" @click.prevent="update">
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
            departments: null,
            editMode: false,
            action:'',
            dis:true,
            loading:false,

            form: new Form({
                'name': '',
                'id':''
            }),

        }
    },
    methods: {
        getDepartments() {
            this.loading=true;
            axios.get('/api/departments').then((response) => {
                this.loading=false;
                this.departments = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load departments', 'Error');
            })
        },
        createMode() {
            this.editMode = false;
            $('#createDepartment').modal('show');

        },
        editDepartment(department) {
            this.editMode = true;
            this.form.reset();
            this.form.fill(department);
            $('#createDepartment').modal('show');



        },
        deleteDepartment(department) {

        },
        update() {
            this.action='Updating record ...';
            this.dis=false;
            this.form.put('/api/departments/'+this.form.id).then((response)=>{
                this.dis=true;
                this.$toastr.s('Update is successful','Success');
                Fire.$emit('loadDepartments');
                $('#createDepartment').modal('hide');
                this.form.reset();

            }).catch(()=>{
                this.dis=true;
                this.$toastr.e('Cannot update the information, try again', 'Error');
            });

        },
        save() {
            this.action='Creating record ...';
            this.dis=false;
            this.form.post('/api/departments').then((response) => {
                this.dis=true;
                toast.fire({
                    icon: 'success',
                    title: 'Record save successfully'
                });
                Fire.$emit('loadDepartments');
                $('#createDepartment').modal('hide');
                this.form.reset();
            }).catch(() => {
                this.$toastr.e('Cannot save record, try again!', 'Error');
                this.dis=true;
            });
        }

    },
    created() {
        this.getDepartments();
        Fire.$on('loadDepartments',()=>{
            this.getDepartments();
        })
    }
}
</script>
