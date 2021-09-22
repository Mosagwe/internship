@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-success card-outline">
                <form action="{{ route('contract.store') }}" method="post">
                    @csrf
                    <div class="card-header">New Contract</div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="employee_id">Employee</label>
                                <select name="employee_id" id="employee_id"
                                        class="form-control @error('employee_id') is-invalid @enderror">
                                    <option value="" disabled selected> --select option--</option>
                                    @foreach($employees as $employee)
                                        <option
                                            {{ old('employee_id')==$employee->id ? 'selected':'' }} value="{{ $employee->id }}">
                                            {{ $employee->idno }} {{ $employee->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
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
                        </div>
                        <div class="form-row">
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
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="bank_id">Bank</label>
                                <select name="bank_id" id="bank_id"
                                        class="form-control @error('bank_id') is-invalid @enderror">
                                    <option value="" disabled selected> --select option--</option>
                                    @foreach($banks as $bank)
                                        <option
                                            {{old('bank_id')==$bank->id ? 'selected' : ''}} value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                    @endforeach
                                </select>
                                @error('bank_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bank_branch">Bank Branch</label>
                                <input type="text" name="bank_branch" id="bank_branch"
                                       class="form-control @error('bank_branch') is-invalid @enderror"
                                       value="{{ old('bank_branch') }}"
                                >
                                @error('bank_branch')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bank_account">Account Number</label>
                                <input type="text" name="bank_account" id="bank_account"
                                       class="form-control @error('bank_account') is-invalid @enderror"
                                       value="{{ old('bank_account') }}"
                                >
                                @error('bank_account')
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
                                <a href="{{ route('contract.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection




