@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Edit Employee Contract Information</h3>
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
                    <form action="{{ route('contract.update',$contract->id) }}" method="post">
                        @csrf
                        @method('PUT')
                      <div class="card-body">
                          <div class="form-group">
                              <label for="start_date">Full Name</label>
                              <input type="text" class="form-control"  value="{{ $contract->employee->fullname }}" readonly>
                          </div>
                          <div class="form-group">
                              <label for="start_date">Start Date</label>
                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                  <input type="text"
                                         class="form-control datepicker @error('start_date') is-invalid @enderror"
                                         id="start_date" name="start_date"
                                         value="{{ $contract->start_date }}"
                                         autocomplete="off">
                                  @error('start_date')
                                  <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                  @enderror
                              </div>

                          </div>
                          <div class="form-group">
                              <label for="station_id">Station</label>
                              <select name="station_id" id="station_id"
                                      class="form-control @error('station_id') is-invalid @enderror">
                                  @foreach($stations as $station)
                                      <option
                                          {{ $contract->station_id==$station->id ? 'selected':'' }} value="{{ $station->id }}">{{ $station->name }}</option>
                                  @endforeach
                              </select>

                              @error('station_id')
                              <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                              @enderror

                          </div>

                      </div>
                        <div class="card-footer ">
                            <div class="row justify-content-between">
                                <button class="btn btn-danger">Close</button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>

                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection






