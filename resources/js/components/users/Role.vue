<template>
    <div class="col-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Roles Table</h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item mr-1">
                            <button class="btn btn-primary" @click="createMode"><i class="fas fa-plus-circle"></i>Add
                                New
                            </button>
                        </li>
                        <li class="nav-item">
                            <div class="input-group mt-0 input-group-sm" style="width: 350px;">
                                <input type="text" name="table_search" v-model="searchWord"
                                       class="form-control float-right" placeholder="Search by name,email">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default" @click.prevent="search()"><i
                                        class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                    <tr class="bg-success">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Date Posted</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="role in roles" :key="role.id">
                        <td>{{ role.id }}</td>
                        <td>{{ role.name }}</td>
                        <td>
                            <button v-for="permission in role.rolePermissions" class="btn btn-warning btn-sm m-1" role="button">
                                <i class="fas fa-shield-alt"></i>{{ permission }}
                            </button>
                        </td>
                        <td>{{ role.created_at | myDate }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-info" @click.prevent="viewRole(role)"><i
                                class="fa fa-eye"></i>View</a>
                            <a href="" class="btn btn-sm btn-warning" v-if="role.name!='super-admin'" @click.prevent="editRole(role)"><i class="fa fa-edit"></i>Edit</a>
                            <!-- <a href="" class="btn btn-sm btn-danger" v-if="user.role!='super-admin'" @click.prevent="deleteUser(user)"><i class="fa fa-trash"></i>Delete</a>-->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <loading :loading="loading"></loading>
        </div>
        <!--modal -->
        <!-- Modal -->
        <div class="modal fade" id="viewRole" tabindex="-1" role="dialog" aria-labelledby="viewRoleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p><b>Name:</b>{{ role.name }}</p>
                                <p><b>Permissions:</b>
                                    <h6 v-for="permission in role.rolePermissions">{{ permission.name }}</h6>
                                </p>
                                <p><b>Last Updated:</b>{{ role.updated_at | myDate }}</p>
                                <p><b>Date Created:</b>{{ role.created_at | myDate }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createRole" tabindex="-1" role="dialog" aria-labelledby="createRoleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRoleModalLabel" v-show="!editMode">Create Role</h5>
                        <h5 class="modal-title" id="createRoleModalLabel" v-show="editMode">Edit Role</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" name="name" placeholder="name" type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('name')}">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <b-form-group label="Assign Permissions">
                                <b-form-checkbox
                                    v-for="option in permissions"
                                    v-model="form.permissions"
                                    :key="option.name"
                                    :value="option.name"
                                    name="flavour-3a"
                                >
                                    {{ option.name }}
                                </b-form-checkbox>
                            </b-form-group>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>
                            <b-button variant="primary" v-if="!load" class="btn-lg" disabled>
                                <b-spinner small type="grow"></b-spinner>
                                {{ action }}
                            </b-button>
                            <button type="button" v-if="load" class="btn btn-lg btn-primary" v-show="!editMode"
                                    @click.prevent="createRole()">Save changes
                            </button>
                            <button type="button" v-if="load" class="btn btn-lg btn-primary" v-show="editMode"
                                    @click.prevent="updateRole()">Update User
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.box -->

    </div>
</template>

<script>
export default {
    name: "Role",
    data() {
        return {
            loading: false,
            editMode: false,
            action: '',
            searchWord: '',
            load: true,
            role: {},
            roles: [],
            permissions: [],
            form: new Form({
                'id': '',
                'name': '',
                'permissions': [],
            })
        }
    },
    methods: {
        createMode() {
            this.editMode = false;
            this.form.reset();
            $('#createRole').modal('show');
        },
        createRole() {
            var ids = [];
            ids = this.form.permissions;
            if (ids.length <= 0) {
                swal.fire({
                    title: 'Error',
                    text: "Please select at least one record!",
                    icon: 'error'
                });
            } else {
                this.action = 'Creating Role...';
                this.load = false;
                this.form.post('/api/roles').then((response) => {
                    this.load = true;
                    //this.$toastr.s("Role created successfully","Created");
                    console.log(response.data.message)
                    Fire.$emit("loadRole")
                    $("#createRole").modal("hide");
                    this.form.reset();
                }).catch(() => {
                    this.load = true;
                    this.$toastr.e('Cannot create Role', 'Error');
                });

            }
        },
        editRole(role){
            this.editMode=true;
            this.form.reset();
            this.form.fill(role);
            this.form.permissions=role.rolePermissions;
            $('#createRole').modal('show');
        },
        updateRole(){
            this.action='Updating Role...';
            this.load=false;
            this.form.put('/api/roles/'+this.form.id).then((response)=>{
                this.load=true;
                this.$toastr.s("Role information updated successfully","Updated");
                Fire.$emit("loadRole")
                $("#createRole").modal("hide");
                this.form.reset();
            }).catch(()=>{
                this.load=true;
                this.$toastr.e('Cannot update role information, try again!', 'Error');
            });
        },
        viewRole(role) {
            $("#viewRole").modal('show');
            this.role = role;
        },
        getRoles() {
            axios.get('/api/roles').then((response) => {
                this.roles = response.data.roles
            }).catch(() => {
                this.$toastr.e("Cannot load roles", "Error");
            })
        },
        getPermissions() {
            axios.get('/getAllPermissions').then((response) => {
                this.permissions = response.data.permissions
            }).catch(() => {
                this.$toastr.e("Cannot load permissions", "Error");
            })
        }

    },

    created() {
        this.getRoles();
        this.getPermissions();

        Fire.$on('loadRole', () => {
            this.getRoles();
        })

    }

}
</script>

<style scoped>

</style>
