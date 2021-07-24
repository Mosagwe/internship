<template>
    <div class="col-md-12 mt-1 mx-auto">
        <div class="card card-success card-outline ">
            <div class="card-header">
                <h3 class="card-title">Payroll</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Frequency Month</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="month" v-model="form.period" id="period"
                                           name="period">
                                    <HasError :form="form" field="period"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-sm-4 col-form-label">ID Number</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" v-model="form.idnumber" id="idnumber"
                                           name="idnumber">
                                    <HasError :form="form" field="idnumber"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" @click.prevent="getPayslips">Process
                                </button>
                            </div>
                        </div>
                    </div>
                </form>


                <table class="table table-striped table-bordered datatable">
                    <thead>
                    <tr class="bg-success">
                        <th>SN</th>
                        <th>Name</th>
                        <th>ID No</th>
                        <th>Month</th>
                        <th>Taxable</th>
                        <th>Net Income</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(payslip,index) in payslips">
                        <td>{{ index + 1 }}</td>
                        <td>{{ payslip.fullname }}</td>
                        <td>{{ payslip.idno }}</td>
                        <td>{{ payslip.period }}</td>
                        <td>{{ payslip.taxableincome }}</td>
                        <td>{{ payslip.net_income }}</td>
                        <td>
                            <a href="" class="btn btn-danger" @click.prevent="print(payslip.idno,payslip.period)">
                                <i class="fa fa-print" target="_blank"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Payslip",
    data() {
        return {
            payslips: null,
            action: '',
            dis: true,
            loading: false,
            form: new Form({
                period: '',
                idnumber: '',
            }),
        }
    },
    methods: {
        getPayslips() {
            axios.get('/api/payslip/getrecords', {
                params: {
                    period: this.form.period,
                    idnumber: this.form.idnumber
                }
            }).then((response) => {
                console.log(response);
                this.payslips = response.data.payslips;
                if (this.payslips.length > 0) {
                    this.$toastr.s('Payslip processed', 'Success');
                } else {
                    this.$toastr.i('No record found', 'Info');
                }

            }).catch(() => {
                this.$toastr.e('Cannot load payslip', 'Error');
            })
        },
        print(idno, period) {
            axios.get('/reports/payslip', {
                params: {
                    idno: idno,
                    period: period
                }
            }).then((response) => {
                console.log(response);
            }).catch(() => {
                this.$toastr.e('Cannot print payslip', 'Error');
            })
        }
    },
    created() {

    }
}
</script>





