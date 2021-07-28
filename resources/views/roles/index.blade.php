@extends('layouts.app')
@section('title','Users')
@section('action')

@endsection
@section('content')
    <div class="col-10">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Roles Table</h3>

                <div class="card-tools">
                    <a href="{{ route('role.create') }}" class="btn btn-primary">Create new Role</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                    <tr class="bg-success">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Date Posted</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <button class="btn btn-warning" role="button"><i class="fas fa-shield-alt"></i>{{ $permission->name }}</button>
                                @endforeach
                            </td>
                            <td>{{ $role->created_at }}</td>
                            @if($role->name !='super-admin')
                            <td><a href="" class="btn btn-success btn-sm">Edit</a></td>
                                @endif
                        </tr>
                    @empty
                        <tr>
                            <td><i class="fas fa-folder-open"></i>No data found!</td>
                        </tr>

                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
@push('scripts')

@endpush
