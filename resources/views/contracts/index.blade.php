@extends('layouts.app')
@section('title','Contracts')

@section('action')
    <a href="{{ route('contract.create') }}" class="float-right mr-4 btn btn-sm btn-success shadow-sm d-none d-sm-inline-block">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i>
        Create New
    </a>
@stop


@section('content')
    <div class="col-md-12 mt-1">
        <div class="card card-success card-outline">
            <div class="card-body">
                <div class="table table-responsive table-striped">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{$dataTable->scripts()}}
@endpush

