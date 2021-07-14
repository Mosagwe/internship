@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card card-success card-outline">
                <div class="card-header">Run Payroll</div>
                <form action="{{ route('payroll.getemployees') }}" method="GET">
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="month" class="col-sm-3 col-form-label">Frequency Month</label>
                            <div class="col-sm-5">
                                <select name="monthname" id="monthname">
                                    @foreach($months as $month)
                                        <option value="">{{ $month->month }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-success"> Show Employees</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection






