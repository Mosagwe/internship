@extends('layouts.app')
@section('title','Contracts')

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

