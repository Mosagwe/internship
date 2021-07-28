<template>
    <div class="col-md-12 mt-1 mx-auto">
        <div class="card card-success card-outline ">
            <div class="card-header">
                <h3 class="card-title">Pending Payroll Records</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped datatable">
                    <thead class="text-center">
                    <tr class="bg-success">
                        <th>Period</th>
                        <th>Paycode</th>
                        <th>Taxable Income</th>
                        <th>PAYE</th>
                        <th>Net Income</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="payroll in payrolls">
                        <td>{{ payroll.period }}</td>
                        <td>{{ payroll.paycode }} <span class="badge badge-secondary">{{ payroll.paycount }}</span></td>
                        <td style="text-align: right">{{ payroll.totaltaxable }}</td>
                        <td style="text-align: right">{{ payroll.totalpaye }}</td>
                        <td style="text-align: right">{{ payroll.totalnetincome }}</td>
                        <td style="text-align: center">
                            <a href="" class="btn btn-success" @click.prevent="approve(payroll)">Approve</a>
                            <a href="" class="btn btn-danger">Reject</a>
                        </td>
                    </tr>
                    </tbody>

                </table>
                <loading :loading="loading"></loading>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "Approve",
    data() {
        return {
            payrolls: null,
            loading:false,
        }
    },
    methods:{
        approve(payroll){
            swal.fire({
                title: 'Are you sure?',
                text: "You are about to approve this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Approve!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //this.$Progress.start();
                    axios.get('/api/payroll/approve/'+payroll.paycode).then((response)=>{

                        console.log(response)
                        swal.fire(
                            'Approved!',
                            'Your record has been approved.',
                            'success'
                        )
                        Fire.$emit('loadData');
                        //this.$Progress.finish();
                    }).catch(()=>{
                        toast.fire({
                            icon:'error',
                            title:'Oops... Something went wrong, try again!,'
                        });
                        //this.$Progress.fail();
                    })

                }
            })

        },
        getPayrolls(){
            this.loading=true;
            axios.get('/api/payroll/pending').then((response) => {
                this.loading=false;
                this.payrolls = response.data.data;
            }).catch(() => {
                this.$toastr.e('Cannot load payrolls', 'Error');
            })

        }

    },
    created() {
        this.getPayrolls();
        Fire.$on('loadData',()=>{
            this.getPayrolls();
        })

    }
}
</script>


