<template>
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Categories List</h3>
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
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Salary</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category in categories">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td v-if="category.parent">{{ category.parent.name }}</td>
                    <td v-else> None</td>
                    <td>{{ category.salary}}</td>
                    <td>{{ category.created_at | myDate}}</td>
                    <td>{{ category.updated_at | myDate}}</td>
                    <td>
                        <a href="" class="btn btn-sm btn-warning" @click.prevent="editCategory(category)"><i
                            class="fa fa-edit fa-fw"></i> </a>
                        <a href="" class="btn btn-sm btn-danger" @click.prevent="deleteCategory(category.id)"><i
                            class="fa fa-trash fa-fw"></i> </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <loading :loading="loading"></loading>

            <!--modal -->
            <div class="modal fade" id="createCategory" tabindex="-1" role="dialog"
                 aria-labelledby="ceateCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCategoryModalLabel" v-show="!editMode">Create
                                Category</h5>
                            <h5 class="modal-title" id="createUnitModalLabel" v-show="editMode">Update
                                Category Details </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="editMode ? update() : save()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <input type="text" name="name" v-model="form.name" id="name"
                                           class="form-control" :class="{'is-invalid':form.errors.has('name')}">
                                    <HasError :form="form" field="name"/>
                                </div>
                                <div class="form-group">
                                    <label>Renumeration</label>
                                    <input type="text" name="salary" v-model="form.salary" id="salary"
                                           class="form-control" :class="{'is-invalid':form.errors.has('salary')}">
                                    <HasError :form="form" field="salary"/>
                                </div>
                                <div class="form-group">
                                    <label>Parent Category</label>
                                    <select name="parent_id" id="parent_id" v-model="form.parent_id" class="form-control">
                                        <option value="" disabled>Please select the category</option>
                                        <option value="0">None</option>
                                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                    </select>
                                    <HasError :form="form" field="parent_id"/>
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
            categories: null,
            editMode: false,
            action:'',
            dis:true,
            loading:false,

            form: new Form({
                id:'',
                name: '',
                salary:'',
                parent_id: '',
            }),
        }
    },
    methods: {
        createMode() {
            this.editMode = false;
            this.form.reset();
            $('#createCategory').modal('show');
            this.form.clear();
        },
        getCategories() {
            this.loading=true;
            axios.get('/api/categories').then((response) => {
                this.loading=false;
                this.categories = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load Categories', 'Error');
            })
        },


        editCategory(category) {
            this.editMode = true;
            this.form.reset();
            this.form.fill(category);
            $('#createCategory').modal('show');
        },
        deleteCategory(id) {
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
                    this.form.delete('/api/categories/'+id).then((response)=>{
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
            this.form.put('/api/categories/'+this.form.id).then((response)=>{
                this.dis=true;
                this.$toastr.s('Update is successful','Success');
                Fire.$emit('loadData');
                $('#createCategory').modal('hide');
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
            this.form.post('/api/categories').then((response) => {
                this.$Progress.finish()
                this.dis=true;
                toast.fire({
                    icon: 'success',
                    title: 'Record save successfully'
                });
                Fire.$emit('loadData');
                $('#createCategory').modal('hide');
                this.form.reset();
            }).catch(() => {
                this.$toastr.e('Cannot save record, try again!', 'Error');
                this.dis=true;
                this.$Progress.fail()
            });
        }

    },
    created() {
        this.getCategories();
        Fire.$on('loadData',()=>{
            this.getCategories();
        })
    }
}
</script>

