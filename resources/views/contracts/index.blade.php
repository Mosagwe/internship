@extends('layouts.app')
@section('title','Contracts')

@section('action')
    <a href="{{ route('contract.create') }}"
       class="float-right mr-4 btn btn-sm btn-success shadow-sm d-none d-sm-inline-block">
        <i class="fas fa-plus-circle fa-sm text-white-50"></i>
        Create New
    </a>
@stop


@section('content')
    <div class="col-md-12 mt-1 mx-auto justify-content-between">
        <div class="card card-success card-outline">
            <div class="table table-responsive">
            <div class="card-body">
                <div class="text-center" id="loading">
                    <b-spinner style="width: 3rem; height: 3rem;" variant="primary"></b-spinner>
                </div>
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{$dataTable->scripts()}}
    <script>
        $(document).ready(function () {
            $('#loading').hide();
        });

    </script>

@endpush

