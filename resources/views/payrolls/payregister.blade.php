@extends('layouts.app')

@section('action')

@endsection
@section('content')
    <div class="col-md-12 mt-1 mx-auto">
        <div class="card card-success card-outline ">
            <div class="card-header">
                <h3 class="card-title">Payroll Register</h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item mr-1">
                            @if($payrolls->count()>0)
                                <form action="{{ route('reports.payregister') }}" method="GET" target="_blank">

                                    <input type="hidden" name="period" value="{{ $payrolls[0]->period }}">
                                    @foreach($payrolls->unique('category_id') as $category)
                                        <input type="hidden" name="category_id[]" value="{{ $category->category_id }}">
                                    @endforeach
                                    <button class="btn btn-success" id="runpayroll">
                                        <i class="fas fa-check-circle fa-fw"></i>
                                        Generate PDF
                                    </button>
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="GET">

                </form>
                <table class="table table-striped table-bordered datatable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>NAME</th>
                        <th>ID NUMBER</th>
                        <th>CATEGORY</th>
                        <th>TAXABLE</th>
                        <th>PAYE</th>
                        <th>NET INCOME</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($payrolls->count() >=0)
                        @forelse($payrolls as $index=>$payroll)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $payroll->fullname }}</td>
                                <td>{{ $payroll->idno}}</td>
                                <td>{{ $payroll->employee->category->name }}</td>
                                <td>{{ $payroll->taxableincome }}</td>
                                <td>{{ $payroll->paye }}</td>
                                <td>{{ $payroll->net_income }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No data found</td>
                            </tr>
                        @endforelse
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('.datatable').dataTable();
        })
    </script>



@endpush

