@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-success card-outline">
                <form action="{{ route('employee.store') }}" method="post">
                    @csrf
                    <div class="card-header">New Employee</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="firstname" class="col-sm-4 col-form-label">First Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                               id="firstname" name="firstname" value="{{ old('firstname') }}">
                                        @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-sm-4 col-form-label">Last Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                               id="lastname" name="lastname" value="{{ old('lastname') }}">
                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="othername" class="col-sm-4 col-form-label">Other Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('othername') is-invalid @enderror"
                                               id="othername" name="othername" value="{{ old('othername') }}">
                                        @error('othername')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-4 col-form-label">Gender</label>
                                    <div class="col-sm-8">
                                        <select name="gender" id="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                            <option value=""> --select option--</option>
                                            <option value="Male" {{ old('gender')=='Male'?'selected':'' }}>Male</option>
                                            <option value="Female" {{ old('gender')=='Female'?'selected':'' }}>Female</option>
                                        </select>

                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-4 col-form-label">Date of Birth</label>
                                    <div class="col-sm-8">
                                        <input type="date" name="dob" id="dob">
                                        @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="idno" class="col-sm-4 col-form-label">ID Number</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('idno') is-invalid @enderror"
                                               id="idno" name="idno" value="{{ old('idno') }}">
                                        @error('idno')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phonenumber" class="col-sm-4 col-form-label">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('phonenumber') is-invalid @enderror"
                                               id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}">
                                        @error('phonenumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label">Email Address</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="krapin" class="col-sm-4 col-form-label">KRA PIN</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control @error('krapin') is-invalid @enderror"
                                               id="krapin" name="krapin" value="{{ old('krapin') }}">
                                        @error('krapin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="pwd" class="col-sm-4 col-form-label">Physical Impairment</label>
                                    <div class="col-sm-8">
                                        <select name="pwd" id="pwd"
                                                class="form-control @error('pwd') is-invalid @enderror">
                                            <option value=""> --select option--</option>
                                            <option value="0" {{ old('pwd')=='0'?'selected':'' }}>No</option>
                                            <option value="1" {{ old('pwd')=='1'?'selected':'' }}>Yes</option>

                                        </select>

                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pwd_category" class="col-sm-4 col-form-label">Specify </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="pwd_category" id="pwd_category" class="form-control">
                                        @error('pwd_category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="qualification_id" class="col-sm-4 col-form-label">Qualification</label>
                                    <div class="col-sm-8">
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
                                </div>
                                <div class="form-group row">
                                    <label for="coursename" class="col-sm-4 col-form-label">Course Name</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('coursename') is-invalid @enderror"
                                               id="coursename" name="coursename" value="{{ old('coursename') }}">
                                        @error('coursename')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_hired" class="col-sm-4 col-form-label">Initial Recruitment
                                        Date</label>
                                    <div class="input-group col-sm-8">
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
                                <div class="form-group row">
                                    <label for="emptype_id" class="col-sm-4 col-form-label">Employee Type</label>
                                    <div class="col-sm-8">
                                        <select name="emptype_id" id="emptype_id"
                                                class="form-control @error('emptype_id') is-invalid @enderror">
                                            <option value="" disabled selected> --select option--</option>
                                            @foreach($emptypes as $emptype)
                                                <option
                                                    {{ old('emptype_id')==$emptype->id ? 'selected':'' }} value="{{ $emptype->id }}">{{ $emptype->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('emptype_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="station_id" class="col-sm-4 col-form-label">Station</label>
                                    <div class="col-sm-8">
                                        <select name="station_id" id="station_id"
                                                class="form-control @error('station_id') is-invalid @enderror">
                                            <option value="" disabled selected> --select option--</option>
                                            @foreach($stations as $station)
                                                <option
                                                    {{ old('station_id')==$station->id ? 'selected':'' }} value="{{ $station->id }}">{{ $station->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('station_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="start_date" class="col-sm-4 col-form-label">Start Date</label>
                                    <div class="input-group col-sm-8">
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
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label">Category</label>
                                    <div class="col-sm-8">
                                        <select name="category_id" id="category_id"
                                                class="form-control @error('category_id') is-invalid @enderror">
                                            <option value="" disabled selected> --select option--</option>
                                            @foreach($categories as $category)
                                                <option {{ old('category_id')==$category->id ? 'selected':'' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                @if($category->subcategories)
                                                    @foreach($category->subcategories as $sub)
                                                        <option {{ old('category_id')==$sub->id ? 'selected':'' }} value="{{ $sub->id }}">--{{ $sub->name }}</option>
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
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="next_of_kin" class="col-sm-4 col-form-label">Next of Kin Name</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('next_of_kin') is-invalid @enderror"
                                               id="next_of_kin" name="next_of_kin" value="{{ old('next_of_kin') }}">
                                        @error('next_of_kin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="next_of_kin_phone" class="col-sm-4 col-form-label">Next of Kin Mobile</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('next_of_kin_phone') is-invalid @enderror"
                                               id="next_of_kin_phone" name="next_of_kin_phone" value="{{ old('next_of_kin_phone') }}">
                                        @error('next_of_kin_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="next_of_kin_relation" class="col-sm-4 col-form-label">Next of Kin Relation</label>
                                    <div class="col-sm-8">
                                        <select name="next_of_kin_relation" id="next_of_kin_relation"
                                                class="form-control @error('next_of_kin_relation') is-invalid @enderror">
                                            <option value="" disabled selected> --select option--</option>
                                            <option {{ old('next_of_kin_relation')=='Spouse' ? 'selected':'' }} value="Spouse">Spouse</option>
                                            <option {{ old('next_of_kin_relation')=='Parent' ? 'selected':'' }} value="Parent">Parent</option>
                                            <option {{ old('next_of_kin_relation')=='Sibling' ? 'selected':'' }} value="Sibling">Sibling</option>
                                            <option {{ old('next_of_kin_relation')=='Relative' ? 'selected':'' }} value="Relative">Relative</option>
                                            <option {{ old('next_of_kin_relation')=='Guardian' ? 'selected':'' }} value="Guardian">Guardian</option>
                                        </select>
                                        @error('next_of_relation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ref1_name" class="col-sm-4 col-form-label">Referee 1 Name</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('ref1_name') is-invalid @enderror"
                                               id="ref1_name" name="ref1_name" value="{{ old('ref1_name') }}">
                                        @error('ref1_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ref1_email" class="col-sm-4 col-form-label">Referee 1 Email</label>
                                    <div class="col-sm-8">
                                        <input type="email"
                                               class="form-control @error('ref1_email') is-invalid @enderror"
                                               id="ref1_email" name="ref1_email" value="{{ old('ref1_email') }}">
                                        @error('ref1_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ref1_phone" class="col-sm-4 col-form-label">Referee 1 Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('ref1_phone') is-invalid @enderror"
                                               id="ref1_phone" name="ref1_phone" value="{{ old('ref1_phone') }}">
                                        @error('ref1_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ref1_occupation" class="col-sm-4 col-form-label">Referee 1 Occupation</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('ref1_occupation') is-invalid @enderror"
                                               id="ref1_occupation" name="ref1_occupation" value="{{ old('ref1_occupation') }}">
                                        @error('ref1_occupation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ref1_period" class="col-sm-4 col-form-label">Period known to you</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('ref1_period') is-invalid @enderror"
                                               id="ref1_period" name="ref1_period" value="{{ old('ref1_period') }}">
                                        @error('ref1_period')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="ref2_name" class="col-sm-4 col-form-label">Referee 2 Name</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('ref2_name') is-invalid @enderror"
                                               id="ref2_name" name="ref2_name" value="{{ old('ref2_name') }}">
                                        @error('ref2_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ref2_email" class="col-sm-4 col-form-label">Referee 2 Email</label>
                                    <div class="col-sm-8">
                                        <input type="email"
                                               class="form-control @error('ref2_email') is-invalid @enderror"
                                               id="ref2_email" name="ref2_email" value="{{ old('ref2_email') }}">
                                        @error('ref2_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ref2_phone" class="col-sm-4 col-form-label">Referee 2 Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('ref2_phone') is-invalid @enderror"
                                               id="ref2_phone" name="ref2_phone" value="{{ old('ref2_phone') }}">
                                        @error('ref2_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ref2_occupation" class="col-sm-4 col-form-label">Referee 2 Occupation</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('ref2_occupation') is-invalid @enderror"
                                               id="ref2_occupation" name="ref2_occupation" value="{{ old('ref2_occupation') }}">
                                        @error('ref2_occupation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ref2_period" class="col-sm-4 col-form-label">Period known to you</label>
                                    <div class="col-sm-8">
                                        <input type="text"
                                               class="form-control @error('ref2_period') is-invalid @enderror"
                                               id="ref2_period" name="ref2_period" value="{{ old('ref2_period') }}">
                                        @error('ref2_period')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

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




