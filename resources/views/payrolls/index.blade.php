@extends('layouts.app')

@section('action')

@endsection
@section('content')
    <div class="col-md-12 mt-1 mx-auto">
        <div class="card card-success card-outline ">
            @if(isset($payrolls))
                <div class="card-header">
                    <h3 class="card-title">Payroll Summary Report</h3>

                </div>
                <div class="card-body">
                    <div class="row">
                        @if($payrolls->count() >0)
                            <h3>Payroll for the month of {{ date('M Y',strtotime($payrolls[0]->period)) }}
                            </h3>
                        @endif
                    </div>
                    <table class="table table-bordered table-striped datatable">
                        <thead class="text-center">
                        <tr class="bg-success">
                            <th>SN</th>
                            <th>Period</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Taxable Income</th>
                            <th>PAYE</th>
                            <th>Net Income</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payrolls as $index=>$payroll)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $payroll->period }}</td>
                                <td>{{ $payroll->category->name }} <span
                                        class="badge badge-primary">{{ $payroll->categorycount }}</span></td>
                                <td>
                                    @if($payroll->status==0)
                                        <span class="badge badge-warning">pending approval</span>
                                    @elseif($payroll->status==1)
                                        <span class="badge badge-success">approved</span>
                                    @endif
                                </td>
                                <td style="text-align: right">{{ number_format($payroll->totaltaxable,2) }}</td>
                                <td style="text-align: right">{{ number_format($payroll->totalpaye,2) }}</td>
                                <td style="text-align: right">{{ number_format($payroll->totalnetincome,2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="font-weight-bolder">
                        <tr>
                            <td colspan="4">Grand Total:</td>
                            <td style="text-align: right">{{ number_format($payrolls->sum('totaltaxable'),2) }}</td>
                            <td style="text-align: right">{{ number_format($payrolls->sum('totalpaye'),2) }}</td>
                            <td style="text-align: right">{{ number_format($payrolls->sum('totalnetincome'),2) }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.datatable').dataTable()
    </script>

@endpush

