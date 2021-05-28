<template>
    <form @submit.prevent="submit">
        <div class="card-header">New Contract</div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Employee</label>
                    <input type="text" name="name" v-model="fields.name">
                    <div class="alert alert-danger" v-if="errors && errors.name">
                        {{ errors.name[0] }}
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label>Category</label>
<!--                    <b-form-select
                        v-model="fields.cat_id"
                        :options="categories"
                        text-field="name"
                        value-field="id"
                    ></b-form-select>-->
                   <select id="cat_id"  name="cat_id"  v-model="fields.cat_id"
                            class="form-control">
                        <option value="" disabled selected> &#45;&#45;select option&#45;&#45;</option>
                        <option v-for="category in categories"  :value="category.id">{{ category.name }}</option>
                    </select>
                    <div class="alert alert-danger" v-if="errors && errors.cat_id">
                        {{ errors.cat_id[0] }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-row justify-content-between mx-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
                <div>
                    <a href="#" class="btn btn-danger btn-sm">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    data(){
        return{
            categories:null,
            errors:{},
            fields:{

            },
        }
    },
    created() {
        axios.get('/api/categories').then(response=>{
           this.categories=response.data.data;
        });
    },
    methods:{
        submit(){
            this.errors={};
            axios.post('/api/tickets',this.fields).then(response=>{
                this.fields={};
                this.errors={};
            }).catch(error=>{
                if (error.response.status===422){
                    this.errors=error.response.data.errors;
                }
                console.log('Error')
            });
        },


    }
}
</script>
