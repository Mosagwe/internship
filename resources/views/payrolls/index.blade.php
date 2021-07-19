@extends('layouts.app')

@section('action')

@endsection
@section('content')
    <div class="col-md-12 mt-1 mx-auto">
        <div class="card card-success card-outline ">
            @if(isset($payrolls))
            <div class="card-header">
                <h3 class="card-title">Payroll</h3>
                <div>
                    Grand Total {{ $payrolls->sum('grossincome') }}
                </div>
            </div>
            <div class="card-body">

                    <div class="row">
                        <h3>Payroll for the month of {{-- date('M Y',strtotime($payrolls[0]->period)) --}}

                        </h3>
                    </div>
                <table class="table table-bordered table-striped datatable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>ID Number</th>
                        <th>KRA PIN</th>
                        <th>Gross Income</th>
                        <th>Taxable Income</th>

                        <th>PAYE</th>
                        <th>Net Income</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($payrolls as $index=>$payroll)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $payroll->employee->full_name }}</td>
                                <td>{{ $payroll->employee->category->name }}</td>
                                <td>{{ $payroll->idno }}</td>
                                <td>{{ $payroll->krapin }}</td>
                                <td>{{ $payroll->grossincome }}</td>
                                <td>{{ $payroll->taxableincome }}</td>
                                <td>{{ $payroll->paye }}</td>
                                <td>{{ $payroll->net_income }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="font-weight: bolder;">
                    <tr>
                        <td colspan="5">Page Totals:</td>
                        <td>{{ $payrolls->sum('grossincome') }}</td>
                        <td>{{ $payrolls->sum('taxableincome') }}</td>
                        <td>{{ $payrolls->sum('paye') }}</td>
                        <td>{{ $payrolls->sum('net_income') }}</td>
                    </tr>
                    </tfoot>
                </table>
<!--                <div class="text-center">
                    {{-- $payrolls->appends(request()->all()) --}}
                </div>-->
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

