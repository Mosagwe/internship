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
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <label for="month" class="col-sm-4 col-form-label">Frequency Month</label>
                            <div class="col-sm-8">
                                <select name="period" id="period" class="form-control">
                                    <option value="">--Select Month--</option>
                                    @foreach(\Carbon\CarbonPeriod::create(now()->startOfMonth()->subMonth(),'1 month',now()->startOfMonth()) as $date)
                                        @if($date==\Carbon\Carbon::now()->startOfMonth())
                                            <option value="{{ $date->format('Y-m-d') }}"
                                            >{{ $date->format('F Y') }}</option>
                                        @else
                                            <option
                                                value="{{ $date->format('Y-m-d') }}">{{ $date->format('F Y') }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <label for="category" class="col-sm-4 col-form-label">Categories</label>
                            <div class="col-sm-8">
                                <select name="category" id="category" class="form-control">
                                    <option value=""> --select category --</option>
                                    @foreach($categories as $category)
                                        @if(isset($category->parent))
                                            @foreach($category->subcategories as $sub)
                                                <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered datatable">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Idno</th>
                        <th>PIN</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('payroll.index') }}",

                    data: function (d) {
                        d.period = $('#period').val(),
                            d.category = $('#category').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'gender', name: 'gender'},
                    {data: 'idno', name: 'idno'},
                    {data: 'krapin', name: 'krapin'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $("#period").change(function () {
                table.draw();
            });
            $("#category").change(function () {
                table.draw();
            });

        });
    </script>

@endpush

