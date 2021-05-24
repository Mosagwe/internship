@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-success card-outline">
                <form action="{{ route('employee.store') }}" method="post">
                    @csrf
                    <div class="card-header">New Employee</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                       id="firstname" name="firstname" value="{{ old('firstname') }}">
                                @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                       id="lastname" name="lastname" value="{{ old('lastname') }}">
                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="othername">Other Name</label>
                                <input type="text" class="form-control @error('othername') is-invalid @enderror"
                                       id="othername" name="othername" value="{{ old('othername') }}">
                                @error('othername')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender"
                                        class="form-control @error('gender') is-invalid @enderror">
                                    <option value=""> --select option--</option>
                                    <option value="M" {{ old('gender')=='M'?'selected':'' }}>Male</option>
                                    <option value="F" {{ old('gender')=='F'?'selected':'' }}>Female</option>
                                </select>

                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="idno">National ID</label>
                                <input type="text" class="form-control @error('idno') is-invalid @enderror" id="idno"
                                       name="idno" value="{{ old('idno') }}">
                                @error('idno')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="phonenumber">Phone Number</label>
                                <input type="text" class="form-control @error('phonenumber') is-invalid @enderror"
                                       id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}">
                                @error('phonenumber')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-7">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                       name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-5">
                                <label for="krapin">KRA PIN</label>
                                <input type="text" class="form-control @error('krapin') is-invalid @enderror"
                                       id="krapin" name="krapin" value="{{ old('krapin') }}">
                                @error('krapin')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="gender">Qualification</label>
                                <select name="qualification_id" id="qualification_id"
                                        class="form-control @error('qualification_id') is-invalid @enderror">
                                    <option value="" disabled selected> --select option--</option>
                                    @foreach($qualifications as $qualification)
                                        <option
                                            {{ old('qualification_id')==$qualification->id ? 'selected':'' }} value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                                    @endforeach
                                </select>

                                @error('qualification_id')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="coursename">Course Name</label>
                                <input type="text" class="form-control @error('coursename') is-invalid @enderror"
                                       id="coursename" name="coursename" value="{{ old('coursename') }}">
                                @error('coursename')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="date_hired">Initial Recruitment Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="text"
                                           class="form-control datepicker @error('date_hired') is-invalid @enderror"
                                           id="date_hired" name="date_hired" value="{{ old('date_hired') }}"
                                           autocomplete="off">
                                    @error('date_hired')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="emptype">Employee Type</label>
                                <select name="emptype" id="emptype"
                                        class="form-control @error('emptype') is-invalid @enderror">
                                    <option value="" disabled selected> --select option--</option>
                                    <option {{ old('emptype')=='casual'? 'selected' : '' }} value="casual">Casual
                                    </option>
                                    <option {{ old('emptype')=='attachee'? 'selected' : '' }} value="attachee">
                                        Attachee
                                    </option>
                                </select>

                                @error('emptype')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="station_id">Station</label>
                                <select name="station_id" id="station_id"
                                        class="form-control @error('station_id') is-invalid @enderror">
                                    <option value="" disabled selected> --select option--</option>
                                    @foreach($stations as $station)
                                        <option
                                            {{old('station_id')==$station->id ? 'selected' : ''}} value="{{ $station->id }}">{{ $station->name }}</option>
                                    @endforeach
                                </select>
                                @error('station_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">

                                <label for="unit_id">Unit</label>
                                <select name="unit_id" id="unit_id"
                                        class="form-control @error('unit_id') is-invalid @enderror">
                                    <option value="" disabled selected> --select option--</option>
                                    @foreach($units as $unit)
                                        <option
                                            value="{{ $unit->id }}" {{ old('unit_id')==$unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="emptype">Internship Duration</label>
                                <select name="duration" id="duration"
                                        class="form-control @error('duration') is-invalid @enderror">
                                        <option value="" disabled selected>--select duration-- </option>
                                        <option value="1" {{ old('duration')==1 ? 'selected' : ''}}> 1 Month</option>
                                        <option value="2" {{ old('duration')==2 ? 'selected' : ''}}> 2 Months</option>
                                        <option value="3" {{ old('duration')==3 ? 'selected' : '' }}> 3 Months</option>
                                        <option value="6" {{ old('duration')==6 ? 'selected' : ''}}> 6 Months</option>
                                        <option value="12" {{ old('duration')==12 ? 'selected' : ''}}> 1 Year</option>

                                </select>

                                @error('duration')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="start_date">Start Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <input type="text"
                                           class="form-control datepicker @error('start_date') is-invalid @enderror"
                                           id="start_date" name="start_date" value="{{ old('start_date') }}"
                                           autocomplete="off">
                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="salary">Salary</label>
                                <input type="text" name="salary" id="salary"
                                       class="form-control @error('salary') is-invalid @enderror"
                                       value="{{ old('salary') }}"
                                >
                                @error('salary')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="form-row justify-content-between mx-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                            <div>
                                <a href="{{ route('employee.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




