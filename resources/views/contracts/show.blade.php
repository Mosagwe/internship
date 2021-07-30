@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">View Employee Contract Information</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item mr-1">
                                <a href="{{ route('contract.index') }}" class="btn btn-primary btn-sm" title="Go back">
                                    <i class="fas fa-backward"> Go back</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                @if($contract)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($contract->employee->fullname) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($contract->employee->gender) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">National ID</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($contract->employee->idno) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($contract->employee->phonenumber ?? "Not available") }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Station</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($contract->station->name ?? "Not assigned!")  }}
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
                                        {{ strtoupper($contract->employee->krapin ?? "Not available")  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Start Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ date('jS F Y', strtotime($contract->start_date)) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">End Date</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ date('jS F Y', strtotime($contract->end_date)) }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Category</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ strtoupper($contract->employee->category->name ?? "Not available") }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Renumeration</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        KES {{ number_format($contract->employee->category->salary,2)?? "Not available"  }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if($contract->status)
                                            <span class="badge badge-success">Active</span>
                                        @elseif(!$contract->status)
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection






