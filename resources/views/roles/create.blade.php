@extends('layouts.app')
@section('title','Users')
@section('action')

@endsection
@section('content')
    <div class="col-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add new Role</h3>

                <div class="card-tools">
                    <a href="{{ route('role.index') }}" class="btn btn-primary"><i class="fas fa-shield-alt"></i> View all Roles</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive no-padding">
                <role></role>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
@push('scripts')

@endpush
