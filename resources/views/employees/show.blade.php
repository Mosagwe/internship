@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">View Employee</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item mr-1">
                                <a href="{{ route('employee.index') }}" class="btn btn-primary btn-sm" title="Go back">
                                    <i class="fas fa-backward"> Go back</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                @if($employee)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($employee->fullname) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date of Birth</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ date('jS M,Y',strtotime($employee->dob)) }}
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($employee->gender) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">National ID</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($employee->idno) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Disability</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if($employee->pwd==0 || $employee->pwd==null )
                                            {{ __('No') }}
                                        @else
                                            {{ __('Yes') }}
                                        @endif
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($employee->phonenumber) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($employee->email) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Employee Type</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if($employee->employeeType)
                                            {{ $employee->employeeType->name }}
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Designation</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if($employee->category)
                                            {{ $employee->category->name }}
                                        @endif
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-6">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">KRA PIN</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($employee->krapin) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Qualification</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($employee->qualification->name ?? "Not Available") }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Course</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($employee->coursename) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Date Hired</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $employee->date_hired }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Next of Kin</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $employee->next_of_kin.' -Phone: '.$employee->next_of_kin_phone.' -Relation: '.$employee->next_of_kin_relation }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Referee 1</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $employee->ref1_name.' -Phone: '.$employee->ref1_phone.' -Email: '.$employee->ref1_email.' -Occupation: '.$employee->ref1_occupation }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Referee 2</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $employee->ref2_name.' -Phone: '.$employee->ref2_phone.' -Email: '.$employee->ref2_email.' -Occupation: '.$employee->ref2_occupation }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if($employee->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @elseif(!$employee->is_active)
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>

                        <div class="form-row">
                            <div><h3>Related Employee Contracts</h3></div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Designation</th>
                                    <th>Station</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Salary (KES) p.m</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employee->contracts as $contract)
                                    @if(isset($employee->contracts))
                                        <tr>
                                            <td>{{ strtoupper($contract->employee->category->name ?? "na") }}</td>
                                            <td>
                                                {{ $contract->station->name ?? "Not assigned!"}}
                                            </td>

                                            <td>{{ $contract->start_date }}</td>
                                            <td>{{ $contract->end_date }}</td>
                                            <td>
                                                @if($contract->employee->category)
                                                    {{ number_format($contract->employee->category->salary,2) ?? "0.00" }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($contract->status==0)
                                                    <span class="badge rounded-pill bg-danger">Inactive</span>
                                                @elseif($contract->status==1)
                                                    <span class="badge rounded-pill bg-success">Active</span>
                                                @endif
                                            </td>
                                        </tr>

                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endif
                <div class="card-footer">
                    <div class="form-row justify-content-between mx-4">
                        <div class="form-group">
                            @can('edit employee')
                                <a href="{{ route('employee.edit',$employee->id) }}"
                                   class="btn btn-sm btn-success">Edit</a>
                            @endcan
                        </div>
                        <div>
                            <a href="{{ route('employee.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection






