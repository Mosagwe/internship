<template>
    <div class="col-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item mr-1">
                            <button class="btn btn-primary" @click="createMode"><i class="fas fa-plus-circle"></i>Add New</button>
                        </li>
                        <li class="nav-item">
                            <div class="input-group mt-0 input-group-sm" style="width: 350px;">
                                <input type="text" name="table_search" v-model="searchWord" class="form-control float-right" placeholder="Search by name,email">
                                <div class="input-group-append">
                                    <button type="submit"  class="btn btn-default" @click.prevent="search()"><i class="fas fa-search"></i></button>
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
                        <th>Station</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Date Posted</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td v-if="user.station_id!=null">{{ user.station.name }}</td>
                        <td v-else> No station assigned!</td>
                        <td>{{ user.role }}</td>
                        <td>{{ user.email}}</td>
                        <td>{{ user.created_at | myDate }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-info" @click.prevent="viewUser(user)"><i class="fa fa-eye"></i>View</a>
                            <a href="" class="btn btn-sm btn-warning" v-if="user.role!='super-admin'" @click.prevent="editUser(user)"><i class="fa fa-edit"></i>Edit</a>
                            <a href="" class="btn btn-sm btn-danger" v-if="user.role!='super-admin'" @click.prevent="deleteUser(user)"><i class="fa fa-trash"></i>Delete</a>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <loading :loading="loading"></loading>
        </div>
        <!--modal -->
        <!-- Modal -->
        <div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img :src="img" class="img-circle">
                            </div>
                            <div class="col-md-8">
                                <p><b>Name:</b>{{ user.name}}</p>
                                <p><b>Email:</b>{{ user.email}}</p>
                                <p><b>Last Updated:</b>{{ user.updated_at | myDate}}</p>
                                <p><b>Date Created:</b>{{ user.created_at | myDate}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel" v-show="!editMode">Create User</h5>
                        <h5 class="modal-title" id="createUserModalLabel" v-show="editMode">Edit User</h5>


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
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" name="email" placeholder="email" type="email"
                                       class="form-control" :class="{'is-invalid':form.errors.has('email')}">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input v-model="form.phone" name="phone" placeholder="Phone Number" type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('phone')}">
                                <has-error :form="form" field="phone"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Choose Station</label>
                                <b-form-select
                                    v-model="form.station_id"
                                    :options="stations"
                                    text-field="name"
                                    value-field="id"
                                ></b-form-select>
                                <has-error :form="form" field="station_id"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Choose Role</label>
                                <b-form-select
                                    v-model="form.role"
                                    :options="roles"
                                    text-field="name"
                                    value-field="id"
                                ></b-form-select>
                                <has-error :form="form" field="role"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input v-model="form.password" name="password" placeholder="Password" type="password"
                                       class="form-control" :class="{'is-invalid':form.errors.has('password')}">
                                <has-error :form="form" field="password"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Close</button>
                            <b-button variant="primary" v-if="!load" class="btn-lg" disabled>
                                <b-spinner small type="grow"></b-spinner>
                                {{ action }}
                            </b-button>
                            <button type="button" v-if="load" class="btn btn-lg btn-primary" v-show="!editMode" @click.prevent="createUser()">Save changes</button>
                            <button type="button" v-if="load" class="btn btn-lg btn-primary" v-show="editMode" @click.prevent="updateUser()">Update User</button>
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
    data(){
        return{
            loading:false,
            editMode:false,
            action:'',
            searchWord:'',
            load:true,
            user:{},
            img:'img/user.jpg',
            users:[],
            roles:[],
            stations:[],
            form:new Form({
                'id':'',
                'name':'',
                'phone':'',
                'password':'',
                'email':'',
                'role':16,
                'station_id':'',
            })
        }
    },
    methods:{
        createMode(){
            this.editMode=false;
            this.form.reset();
            $('#createUser').modal('show');
        },
        search(){
            this.loading=true;
            axios.get('/search/user?s='+this.searchWord).then((response)=>{
                this.loading=false;
                this.users=response.data.users;
            }).catch(()=>{
                this.loading=false;
                toast.fire({
                    icon:'error',
                    title:'Search failed, try again!'
                })
            });
        },
        deleteUser(user){
            swal.fire({
                title: 'Are you sure?',
                text: user.name +" will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/delete/user/'+user.id).then(()=>{
                        toast.fire({
                            icon: 'success',
                            title: user.name +' has been deleted successfully'
                        })
                        Fire.$emit("loadUser");
                    }).catch(()=>{
                        toast.fire({
                            icon: 'error',
                            title: user.name+' failed to delete, try again'
                        })
                    });
                }
            })
        },
        editUser(user){
            this.editMode=true;
            this.form.reset();
            this.form.fill(user);
            this.form.role=user.roles[0].id;
            //this.form.permissions=user.userPermissions;
            $('#createUser').modal('show');
        },
        updateUser(){
            this.action='Updating User...';
            this.load=false;
            this.form.put('/account/update/'+this.form.id).then((response)=>{
                this.load=true;
                this.$toastr.s("User information updated successfully","Updated");
                Fire.$emit("loadUser")
                $("#createUser").modal("hide");
                this.form.reset();
            }).catch(()=>{
                this.load=true;
                this.$toastr.e('Cannot update user information, try again!', 'Error');
            });
        },
        getUsers(){
            this.loading=true;
            axios.get('/getAllUsers').then((response)=>{
                this.loading=false;
                this.users=response.data.users
            }).catch(()=>{
                this.loading=false;
                this.$toastr.e("Cannot load users", "Error");
            })
        },
        getRoles(){
            axios.get('/getAllRoles').then((response)=>{
                this.roles=response.data.roles
            }).catch(()=>{
                this.$toastr.e("Cannot load roles", "Error");
            })
        },
        /*getPermissions(){
            axios.get('/getAllPermissions').then((response)=>{
                this.permissions=response.data.permissions
            }).catch(()=>{
                this.$toastr.e("Cannot load permissions", "Error");
            })
        },*/
        getStations(){
            axios.get('/api/stations').then((response) => {
                this.stations = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load stations', 'Error');
            })
       },
        createUser(){
            this.action='Creating User...';
            this.load=false;
            this.form.post('/account/create').then((response)=>{
                this.load=true;
                this.$toastr.s("User created successfully","Created");
                Fire.$emit("loadUser")
                $("#createUser").modal("hide");
                this.form.reset();
            }).catch(()=>{
                this.load=true;
                this.$toastr.e('Cannot create User', 'Error');
            });
        },
        viewUser(user){
            $("#viewUser").modal('show');
            this.user=user;
        }
    },
    created() {
        this.getUsers();
        this.getRoles();
        //this.getPermissions();
        this.getStations();
        Fire.$on('loadUser',()=>{
            this.getUsers();
        })
    }
}
</script>
