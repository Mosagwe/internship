<template>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Stations List</h3>
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
                    <th>Station</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="station in stations">
                    <td>{{ station.id }}</td>
                    <td>{{ station.name }}</td>
                    <td>{{ station.created_at }}</td>
                    <td>{{ station.updated_at }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" @click.prevent="editStation(station)"><i
                            class="fa fa-edit"></i>Edit</a>
                        <a href="" class="btn btn-sm btn-danger" @click.prevent="deleteStation(station)"><i
                            class="fa fa-trash"></i>Delete</a>
                    </td>
                </tr>
                </tbody>
            </table>
            <loading :loading="loading"></loading>

            <!--modal -->
            <div class="modal fade" id="createStation" tabindex="-1" role="dialog"
                 aria-labelledby="ceateStationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createStationModalLabel" v-show="!editMode">Create
                                Station</h5>
                            <h5 class="modal-title" id="createStationModalLabel" v-show="editMode">Update
                                Station </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Station Name</label>
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
            stations: null,
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
        getStations() {
            this.loading=true;
            axios.get('/api/stations').then((response) => {
                this.loading=false;
                this.stations = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load stations', 'Error');
            })
        },
        createMode() {
            this.editMode = false;
            $('#createStation').modal('show');

        },
        editStation(station) {
            this.editMode = true;
            this.form.reset();
            this.form.fill(station);
            $('#createStation').modal('show');



        },
        deleteStation(station) {

        },
        update() {
            this.action='Updating record ...';
            this.dis=false;
            this.form.put('/api/stations/'+this.form.id).then((response)=>{
                this.dis=true;
                this.$toastr.s('Update is successful','Success');
                Fire.$emit('loadData');
                $('#createStation').modal('hide');
                this.form.reset();

            }).catch(()=>{
                this.dis=true;
                this.$toastr.e('Cannot update the information, try again', 'Error');
            });

        },
        save() {
            this.action='Creating record ...';
            this.dis=false;
            this.form.post('/api/stations').then((response) => {
                this.dis=true;
                toast.fire({
                    icon: 'success',
                    title: 'Record save successfully'
                });
                Fire.$emit('loadData');
                $('#createStation').modal('hide');
                this.form.reset();
            }).catch(() => {
                this.$toastr.e('Cannot save record, try again!', 'Error');
                this.dis=true;
            });
        }

    },
    created() {
        this.getStations();
        Fire.$on('loadData',()=>{
            this.getStations();
        })
    }
}
</script>
