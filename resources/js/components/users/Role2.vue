<template>
    <form>
        <div class="form-group">
            <label>Name</label>
            <input v-model="form.name" type="text" name="name" placeholder="Role Name"
                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
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
                {{ option.name}}
            </b-form-checkbox>
        </b-form-group>
        <button type="submit" v-if="dis" @click.prevent="createRole()" class="btn btn-lg btn-primary"><i class="fas fa-save"></i>Save Role</button>
    </form>
</template>

<script>
export default {
    data(){
        return{
            options:[],
            dis:true,
            action:'',
            permissions:[],
            form:new Form({
                'name':'',
                'permissions':[]
            })
        }
    },
    methods:{
        getPermissions(){
            axios.get("/getallpermission")
                .then((response)=>{
                    this.permissions=response.data.permissions
                }).catch(()=>{
                swal.fire({
                    icon:'error',
                    title:'Oops...',
                    text: 'Something went wrong!'
                })
            });
        },
        createRole(){
            this.dis=false;
            this.form.post("/postRole").then(()=>{
                swal.fire({
                    icon:'success',
                    title:'Role Created',
                    text: 'Your Role has been created.'
                })
                window.location='/role';
            }).catch(()=>{
                swal.fire({
                    icon:'error',
                    title:'Oops...',
                    text: 'Something went wrong!'
                })
            });
            this.dis=true;
        }
    },
    created() {
        this.getPermissions();
    }
}
</script>
