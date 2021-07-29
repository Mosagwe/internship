@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Edit Employee Information</h3>
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
                    <form action="{{ route('employee.update',$employee->id) }}" method="post">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">First Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                   class="form-control @error('firstname') is-invalid @enderror"
                                                   name="firstname" id="firstname"
                                                   value="{{ $employee->firstname }}">
                                            @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Last Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                   class="form-control @error('lastname') is-invalid @enderror"
                                                   name="lastname" id="lastname"
                                                   value="{{ $employee->lastname }}">
                                            @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Other Name</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control @error('middlename') is-invalid @enderror"
                                                   name="middlename" id="middlename"
                                                   value="{{ $employee->middlename }}">
                                            @error('middlename')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Gender</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select name="gender" id="gender"
                                                    class="form-control @error('gender') is-invalid @enderror">
                                                <option value=""> --select option--</option>
                                                <option value="Male" {{ $employee->gender=='Male' ? 'selected': '' }}>Male</option>
                                                <option value="Female" {{ $employee->gender=='Female' ? 'selected': '' }}>Female</option>
                                            </select>

                                            @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">National ID</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control @error('idno') is-invalid @enderror"
                                                   name="idno" id="idno"
                                                   value="{{ $employee->idno }}">
                                            @error('idno')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Phone Number</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                   class="form-control @error('phoneumber') is-invalid @enderror"
                                                   name="phonenumber" id="phonenumber"
                                                   value="{{ $employee->phonenumber }}">
                                            @error('phonenumber')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Employee Type</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select name="emptype_id" id="emptype_id"
                                                    class="form-control @error('emptype_id') is-invalid @enderror">
                                                <option value="" disabled selected> --select option--</option>
                                                @foreach($emptypes as $emptype)
                                                    <option
                                                        {{ $employee->employee_type_id==$emptype->id ? 'selected':'' }} value="{{ $emptype->id }}">{{ $emptype->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('emptype_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Designation</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select name="category_id" id="category_id"
                                                    class="form-control @error('category_id') is-invalid @enderror">
                                                <option value="" disabled selected> --select option--</option>
                                                @foreach($categories as $category)
                                                    <option {{ $employee->category_id==$category->id ? 'selected':'' }}
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @if($category->subcategories)
                                                        @foreach($category->subcategories as $sub)
                                                            <option
                                                                {{ $employee->category_id==$sub->id ? 'selected':'' }} value="{{ $sub->id }}">
                                                                --{{ $sub->name }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control @error('email') is-invalid @enderror"
                                                   name="email" id="email"
                                                   value="{{ $employee->email }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">KRA PIN</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                   class="form-control @error('krapin') is-invalid @enderror"
                                                   name="krapin" id="krapin"
                                                   value="{{ $employee->krapin }}">
                                            @error('krapin')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Qualification</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select name="qualification_id" id="qualification_id"
                                                    class="form-control @error('qualification_id') is-invalid @enderror">
                                                <option value="" disabled selected> --select option--</option>
                                                @foreach($qualifications as $qualification)
                                                    <option
                                                        {{ $employee->qualification_id==$qualification->id ? 'selected':'' }} value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('qualification_id')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Course</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"
                                                   class="form-control @error('coursename') is-invalid @enderror"
                                                   name="coursename" id="coursename"
                                                   value="{{ $employee->coursename }}">
                                            @error('coursename')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Date Hired</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                <input type="text"
                                                       class="form-control datepicker @error('date_hired') is-invalid @enderror"
                                                       id="date_hired" name="date_hired"
                                                       value="{{ $employee->date_hired }}"
                                                       autocomplete="off">
                                                @error('date_hired')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
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
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-row justify-content-between mx-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                            </div>
                            <div>
                                <a href="{{ route('employee.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            </div>
                        </div>
                    </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection






