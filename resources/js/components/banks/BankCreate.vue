<template>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Banks List</h3>
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
                <tr>
                    <th>#</th>
                    <th>Bank</th>
                    <th>Bank Code</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="bank in banks">
                    <td>{{ bank.id }}</td>
                    <td>{{ bank.bank_name }}</td>
                    <td>{{ bank.bank_code }}</td>
                    <td>{{ bank.created_at | myDate}}</td>
                    <td>{{ bank.updated_at}}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" @click.prevent="editBank(bank)"><i
                            class="fa fa-edit fa-fw"></i> </a>
                        <a href="" class="btn btn-sm btn-danger" @click.prevent="deleteBank(bank.id)"><i
                            class="fa fa-trash fa-fw"></i> </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <loading :loading="loading"></loading>

            <!--modal -->
            <div class="modal fade" id="createBank" tabindex="-1" role="dialog"
                 aria-labelledby="ceateBankModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createBankModalLabel" v-show="!editMode">Create
                                Bank</h5>
                            <h5 class="modal-title" id="createBankModalLabel" v-show="editMode">Update
                                Bank Details </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? update() : save()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" name="bank_name" v-model="form.bank_name" id="bank_name"
                                           class="form-control" :class="{'is-invalid':form.errors.has('bank_name')}">
                                    <HasError :form="form" field="bank_name"/>
                                </div>
                                <div class="form-group">
                                    <label>Bank Code</label>
                                    <input type="text" name="bank_code" v-model="form.bank_code" id="bank_code" class="form-control">
                                    <HasError :form="form" field="bank_code"/>
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
            banks: null,
            editMode: false,
            action:'',
            dis:true,
            loading:false,

            form: new Form({
                bank_name: '',
                id:'',
                bank_code: '',
            }),

        }
    },
    methods: {
        createMode() {
            this.editMode = false;
            this.form.reset();
            $('#createBank').modal('show');
            this.form.clear();
        },
        getBanks() {
            this.loading=true;
            axios.get('/api/banks').then((response) => {
                this.loading=false;
                this.banks = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load banks', 'Error');
            })
        },

        editBank(bank) {
            this.editMode = true;
            this.form.reset();
            this.form.fill(bank);
            $('#createBank').modal('show');
        },
        deleteBank(id) {
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
                    this.form.delete('/api/banks/'+id).then((response)=>{
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
            this.form.put('/api/banks/'+this.form.id).then((response)=>{
                this.dis=true;
                this.$toastr.s('Update is successful','Success');
                Fire.$emit('loadData');
                $('#createBank').modal('hide');
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
            this.form.post('/api/banks').then((response) => {
                this.$Progress.finish()
                this.dis=true;
                toast.fire({
                    icon: 'success',
                    title: 'Record save successfully'
                });
                Fire.$emit('loadData');
                $('#createBank').modal('hide');
                this.form.reset();
            }).catch(() => {
                this.$toastr.e('Cannot save record, try again!', 'Error');
                this.dis=true;
                this.$Progress.fail()
            });
        }

    },
    created() {
        this.getBanks();
        Fire.$on('loadData',()=>{
            this.getBanks();
        })
    }
}
</script>
