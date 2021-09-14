<template>
    <div class="card card-success card-outline">
        <form @submit.prevent="save">

            <div class="card-header">New Employee</div>
            <loading :loading="loading"></loading>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">First Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" :class="{'is-invalid':form.errors.has('firstname')}"
                                       id="firstname" name="firstname" v-model="form.firstname">
                                <HasError :form="form" field="firstname"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Last Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" :class="{'is-invalid':form.errors.has('lastname')}"
                                       id="lastname" name="lastname" v-model="form.lastname">
                                <HasError :form="form" field="lastname"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Other Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" :class="{'is-invalid':form.errors.has('othername')}"
                                       id="othername" name="othername" v-model="form.othername">
                                <HasError :form="form" field="othername"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Gender</label>
                            <div class="col-sm-8">
                                <select name="gender" id="gender"
                                        class="form-control" :class="{'is-invalid':form.errors.has('gender')}" v-model="form.gender">
                                    <option value=""> --select option--</option>
                                    <option value="Male" >Male</option>
                                    <option value="Female" >Female</option>
                                </select>
                                <HasError :form="form" field="gender"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Date of Birth</label>
                            <div class="col-sm-8">
                                <input type="date" name="dob" id="dob" class="form-control" :class="{'is-invalid':form.errors.has('dob')}"
                                v-model="form.dob">
                                <HasError :form="form" field="dob"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ID Number</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" :class="{'is-invalid':form.errors.has('idno')}"
                                       id="idno" name="idno" v-model="form.idno">
                                <HasError :form="form" field="idno"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Phone</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" :class="{'is-invalid':form.errors.has('phonenumber')}"
                                       id="phonenumber" name="phonenumber" v-model="form.phonenumber">
                                <HasError :form="form" field="phonenumber"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email Address</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control " :class="{'is-invalid':form.errors.has('email')}"
                                       id="email" name="email" v-model="form.email">
                                <HasError :form="form" field="email"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">KRA PIN</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control " :class="{'is-invalid':form.errors.has('krapin')}"
                                       id="krapin" name="krapin" v-model="form.krapin">
                                <HasError :form="form" field="krapin"/>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Employee Type</label>
                            <div class="col-sm-8">
                                <select name="emptype_id" id="emptype_id" class="form-control " :class="{'is-invalid':form.errors.has('emptype_id')}"
                                v-model="form.emptype_id">
                                    <option value="" disabled selected> --select option--</option>
                                    <option v-for="emptype in emptypes" :value="emptype.id">{{ emptype.name }}</option>
                                </select>
                                <HasError :form="form" field="emptype_id"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Physical Impairment</label>
                            <div class="col-sm-8">
                                <select name="pwd" id="pwd" v-model="form.pwd"
                                        class="form-control" :class="{'is-invalid':form.errors.has('pwd')}">
                                    <option value=""> --select option--</option>
                                    <option value="0" >No</option>
                                    <option value="1" >Yes</option>

                                </select>
                                <HasError :form="form" field="pwd"/>
                            </div>
                        </div>
                        <div v-if="form.pwd ==='1'" class="form-group row">
                            <label class="col-sm-4 col-form-label">PWD Number</label>
                            <div class="col-sm-8">
                                <input type="text" name="pwd_no" id="pwd_no" v-model="form.pwd_no"
                                       class="form-control" :class="{'is-invalid':form.errors.has('pwd_no')}">
                                <HasError :form="form" field="pwd_no"/>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Qualification</label>
                            <div class="col-sm-8">
                                <select name="qualification_id" id="qualification_id" v-model="form.qualification_id"
                                        class="form-control" :class="{'is-invalid':form.errors.has('qualification_id')}">
                                    <option value="" disabled selected> --select option--</option>
                                    <option v-for="qualification in qualifications" :value="qualification.id">{{ qualification.name }}</option>

                                </select>
                                <HasError :form="form" field="qualification_id"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Course Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('coursename')}"
                                       id="coursename" name="coursename" v-model="form.coursename">
                                <HasError :form="form" field="coursename"/>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Initial Recruitment
                                Date</label>
                            <div class="input-group col-sm-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date"
                                       class="form-control" :class="{'is-invalid':form.errors.has('date_hired')}"
                                       id="date_hired" name="date_hired" v-model="form.date_hired"
                                       autocomplete="off">
                                <HasError :form="form" field="date_hired"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Station</label>
                            <div class="col-sm-8">
                                <select name="station_id" id="station_id" v-model="form.station_id"
                                        class="form-control " :class="{'is-invalid':form.errors.has('station_id')}">
                                    <option value="" disabled selected> --select option--</option>
                                    <option v-for="station in stations"
                                        :value="station.id">{{ station.name }}</option>

                                </select>
                                <HasError :form="form" field="station_id"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Start Date</label>
                            <div class="input-group col-sm-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date"
                                       class="form-control" :class="{'is-invalid':form.errors.has('start_date')}"
                                       id="start_date" name="start_date" v-model="form.start_date"
                                       autocomplete="off">
                                <HasError :form="form" field="start_date"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <select name="category_id" id="category_id" v-model="form.category_id"
                                        class="form-control" :class="{'is-invalid':form.errors.has('category_id')}">
                                    <option value="" disabled selected> --select option--</option>

                                    <option v-for="category in categories"
                                    :value="category.id">{{ category.name }}</option>
<!--                                    @if($category->subcategories)
                                    @foreach($category->subcategories as $sub)
                                    <option {{ old('category_id')==$sub->id ? 'selected':'' }} value="{{ $sub->id }}">&#45;&#45;{{ $sub->name }}</option>
                                    @endforeach
                                    @endif-->

                                </select>
                                <HasError :form="form" field="category_id"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Next of Kin Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('next_of_kin')}"
                                       id="next_of_kin" name="next_of_kin" v-model="form.next_of_kin">
                                <HasError :form="form" field="next_of_kin"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Next of Kin Mobile</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('next_of_kin_phone')}"
                                       id="next_of_kin_phone" name="next_of_kin_phone" v-model="form.next_of_kin_phone">
                                <HasError :form="form" field="next_of_kin_phone"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Next of Kin Relation</label>
                            <div class="col-sm-8">
                                <select name="next_of_kin_relation" id="next_of_kin_relation" v-model="form.next_of_kin_relation"
                                        class="form-control" :class="{'is-invalid':form.errors.has('next_of_kin_relation')}">
                                    <option value="" disabled selected> --select option--</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="Parent">Parent</option>
                                    <option value="Sibling">Sibling</option>
                                    <option value="Relative">Relative</option>
                                    <option value="Guardian">Guardian</option>
                                </select>
                                <HasError :form="form" field="next_of_kin_relation"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Referee 1 Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref1_name')}"
                                       id="ref1_name" name="ref1_name" v-model="form.ref1_name">
                                <HasError :form="form" field="ref1_name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Referee 1 Email</label>
                            <div class="col-sm-8">
                                <input type="email"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref1_email')}"
                                       id="ref1_email" name="ref1_email" v-model="form.ref1_email">
                                <HasError :form="form" field="ref1_email"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Referee 1 Phone</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref1_phone')}"
                                       id="ref1_phone" name="ref1_phone" v-model="form.ref1_phone">
                                <HasError :form="form" field="ref1_phone"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Referee 1 Occupation</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref1_occupation')}"
                                       id="ref1_occupation" name="ref1_occupation" v-model="form.ref1_occupation">
                                <HasError :form="form" field="ref1_occupation"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Period known to you</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref1_period')}"
                                       id="ref1_period" name="ref1_period" v-model="form.ref1_period">
                                <HasError :form="form" field="ref1_period"/>

                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Referee 2 Name</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref2_name')}"
                                       id="ref2_name" name="ref2_name" v-model="form.ref2_name">
                                <HasError :form="form" field="ref2_name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Referee 2 Email</label>
                            <div class="col-sm-8">
                                <input type="email"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref2_email')}"
                                       id="ref2_email" name="ref2_email" v-model="form.ref2_email">
                                <HasError :form="form" field="ref2_email"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Referee 2 Phone</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref2_phone')}"
                                       id="ref2_phone" name="ref2_phone" v-model="form.ref2_phone">
                                <HasError :form="form" field="ref2_phone"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Referee 2 Occupation</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref2_occupation')}"
                                       id="ref2_occupation" name="ref2_occupation" v-model="form.ref2_occupation">
                                <HasError :form="form" field="ref2_occupation"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Period known to you</label>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control" :class="{'is-invalid':form.errors.has('ref2_period')}"
                                       id="ref2_period" name="ref2_period" v-model="form.ref2_period">
                                <HasError :form="form" field="ref2_period"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-row justify-content-between mx-4">
                    <div class="form-group">
                        <b-button variant="success" v-if="!dis" disabled>
                            <b-spinner small></b-spinner>
                            {{ action }}
                        </b-button>
                        <button type="submit" v-if="dis" class="btn btn-sm btn-success">Submit</button>
                    </div>
                    <div>
                        <a href="#" class="btn btn-danger btn-sm" @click.prevent="gohome">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return{
            categories:null,
            emptypes:null,
            qualifications:null,
            stations:null,

            action:'',
            dis:true,
            loading:false,

            form: new Form({
                id:'',
                firstname:'',
                lastname: '',
                othername: '',
                gender:'',
                dob:'',
                idno:'',
                phonenumber:'',
                email:'',
                krapin:'',
                emptype_id:'',
                pwd:'',
                pwd_no:'',
                qualification_id:'',
                coursename:'',
                date_hired:'',
                station_id:'',
                start_date:'',
                category_id:'',
                next_of_kin:'',
                next_of_kin_phone:'',
                next_of_kin_relation:'',
                ref1_name:'',
                ref1_email:'',
                ref1_phone:'',
                ref1_occupation:'',
                ref1_period:'',
                ref2_name:'',
                ref2_email:'',
                ref2_phone:'',
                ref2_occupation:'',
                ref2_period:'',
            }),
        }
    },
    methods:{
        getEmployeeTypes() {
            this.loading=true;
            axios.get('/api/employeetypes').then((response) => {
                this.loading=false;
                this.emptypes = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load Employee Types', 'Error');
            })
        },
        getQualifications() {
            this.loading=true;
            axios.get('/api/qualifications').then((response) => {
                this.loading=false;
                this.qualifications = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load Qualifications', 'Error');
            })
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
        getStations() {
            this.loading=true;
            axios.get('/api/stations').then((response) => {
                this.loading=false;
                this.stations = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load Stations', 'Error');
            })
        },

        save(){
            this.$Progress.start()
            this.action='Creating record ...';
            this.dis=false;
            this.form.post('/api/employees').then((response) => {
                this.$Progress.finish()
                this.dis=true;
                toast.fire({
                    icon: 'success',
                    title: 'Record save successfully'
                });
                window.location='/employee'
            }).catch(() => {
                this.$toastr.e('Cannot save record, try again!', 'Error');
                this.dis=true;
                this.$Progress.fail()
            });
        },
        gohome(){
            window.location='/employee';
        }
    },
    created() {
        this.getEmployeeTypes();
        this.getCategories();
        this.getQualifications();
        this.getStations();
    }
}
</script>
