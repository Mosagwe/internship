@extends('layouts.app')

@section('action')

@endsection
@section('content')
    <div class="col-md-12 mt-1 mx-auto">
        <div class="card card-success card-outline ">
            <div class="card-header">
                <h3 class="card-title">Payroll</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('payroll.getrecords') }}" method="GET">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <label for="month" class="col-sm-4 col-form-label">Frequency Month</label>
                                <div class="col-sm-8">
                                    <select name="period" id="period" class="form-control ">

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
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label for="category" class="col-sm-4 col-form-label">Categories</label>
                                <div class="col-sm-8">
                                    <select name="category[]" id="category"
                                            class="form-control select2 @error('category') is-invalid @enderror"
                                            multiple="multiple">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @if($category->subcategories)
                                                @foreach($category->subcategories as $sub)
                                                    <option value="{{ $sub->id }}"> --> {{ $sub->name }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
@endsection
@push('scripts')



@endpush

