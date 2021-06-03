<template>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Banks List</h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item mr-1">
                        <button class="btn btn-primary" @click="createMode"><i class="fas fa-plus-circle"></i>Add New
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
                    <td>{{ bank.created_at }}</td>
                    <td>{{ bank.updated_at }}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" @click.prevent="editBank(bank)"><i
                            class="fa fa-edit"></i>Edit</a>
                        <a href="" class="btn btn-sm btn-danger" @click.prevent="deleteBank(bank)"><i
                            class="fa fa-trash"></i>Delete</a>
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
                        <form>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" name="bank_name" v-model="form.bank_name" id="bank_name" class="form-control">
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
        getBanks() {
            this.loading=true;
            axios.get('/api/banks').then((response) => {
                this.loading=false;
                this.banks = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load banks', 'Error');
            })
        },
        createMode() {
            this.editMode = false;
            this.form.clear();
            $('#createBank').modal('show');
            this.form.reset();

        },
        editBank(bank) {
            this.editMode = true;
            this.form.reset();
            this.form.fill(bank);
            $('#createBank').modal('show');



        },
        deleteBank(bank) {

        },
        update() {
            this.action='Updating record ...';
            this.dis=false;
            this.form.put('/api/banks/'+this.form.id).then((response)=>{
                this.dis=true;
                this.$toastr.s('Update is successful','Success');
                Fire.$emit('loadData');
                $('#createBank').modal('hide');
                this.form.reset();

            }).catch(()=>{
                this.dis=true;
                this.$toastr.e('Cannot update the information, try again', 'Error');
            });

        },
        save() {
            this.action='Creating record ...';
            this.dis=false;
            this.form.post('/api/banks').then((response) => {
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
