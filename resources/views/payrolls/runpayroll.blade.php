@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card card-success card-outline">
                <div class="card-header">Run Payroll</div>
                <div class="card-body">
                    <form action="{{ route('payroll.getemployees') }}" method="GET">
                        <div class="row mb-3">
                            <label for="month" class="col-sm-3 col-form-label">Frequency Month</label>
                            <div class="col-sm-5">
                                <select name="period" id="period" class="form-control">
                                    @foreach(\Carbon\CarbonPeriod::create(now()->startOfMonth()->subMonth(),'1 month',now()->startOfMonth()) as $date)
                                        @if($date==\Carbon\Carbon::now()->startOfMonth())
                                            <option value="{{ $date->format('Y-m-d') }}"
                                                    selected>{{ $date->format('F Y') }}</option>
                                        @else
                                            <option
                                                value="{{ $date->format('Y-m-d') }}">{{ $date->format('F Y') }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-success"> Show Employees</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Category</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($contracts))
                            @foreach($contracts as $contract)
                                @if($contract->employee->category->salary>0)
                                    <tr>
                                        <td></td>
                                        <td>{{ $contract->employee->full_name }}</td>
                                        <td>{{$contract->employee->category->name}}</td>
                                        <td>{{$contract->employee->category->salary}}</td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection






