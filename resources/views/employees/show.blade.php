@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10 margin-tb">
            <div class="pull-left">
                <h2> </h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('employee.index') }}" class="btn btn-primary" title="Go back">
                    <i class="fas fa-backward"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-success card-outline">
                <div class="card-header">View Employee</div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                   id="firstname" name="firstname" value="{{ strtoupper($employee->firstname) }}" readonly>
                            <label ></label>


                        </div>
                        <div class="form-group col-md-4">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                   id="lastname" name="lastname" value="{{ strtoupper($employee->lastname) }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="othername">Other Name</label>
                            <input type="text" class="form-control @error('othername') is-invalid @enderror"
                                   id="othername" name="othername" value="{{ strtoupper($employee->othername) }}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <input type="text" class="form-control" value="{{ strtoupper($employee->gender) }}" readonly >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="idno">National ID</label>
                            <input type="text" class="form-control @error('idno') is-invalid @enderror" id="idno"
                                   name="idno" value="{{ $employee->idno }}" readonly>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="phonenumber">Phone Number</label>
                            <input type="text" class="form-control @error('phonenumber') is-invalid @enderror"
                                   id="phonenumber" name="phonenumber" value="{{ $employee->phonenumber }}" readonly>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                   name="email" value="{{ strtoupper($employee->email) }}" readonly>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="krapin">KRA PIN</label>
                            <input type="text" class="form-control @error('krapin') is-invalid @enderror"
                                   id="krapin" name="krapin" value="{{ strtoupper($employee->krapin) }}" readonly>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="gender">Qualification</label>
                            <input type="text" class="form-control" value="{{ strtoupper($employee->qualification->name) }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="coursename">Course Name</label>
                            <input type="text" class="form-control @error('coursename') is-invalid @enderror"
                                   id="coursename" name="coursename" value="{{ strtoupper($employee->coursename) }}" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date_hired">Initial Recruitment Date</label>
                            <input type="text" class="form-control" value="{{ $employee->date_hired }}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="emptype">Employee Type</label>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="station_id">Station</label>

                        </div>
                        <div class="form-group col-md-4">

                            <label for="unit_id">Unit</label>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="emptype">Internship Duration</label>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="start_date">Start Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="salary">Salary</label>

                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <div class="form-row justify-content-between mx-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success">Edit</button>
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




