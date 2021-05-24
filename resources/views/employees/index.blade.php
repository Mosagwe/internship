@extends('layouts.app')
@section('title','Employees')
@section('action')
    <a href="{{ route('employee.create') }}" class="float-right mr-3 btn btn-sm btn-success shadow-sm d-none d-sm-inline-block">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i>
        Create New
    </a>
@endsection
@section('content')
        <div class="col-md-12 mt-1">
            <div class="card card-success card-outline">
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
@endsection
@push('scripts')
    {{$dataTable->scripts()}}
@endpush

