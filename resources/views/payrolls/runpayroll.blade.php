@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Run Payroll</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item mr-1">
                                <button class="btn btn-success" id="runpayroll">
                                    <i class="fas fa-check-circle fa-fw"></i>
                                    Run Process
                                </button>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ route('payroll.getemployees') }}" method="GET">
                        <div class="row mb-3">
                            <label for="month" class="col-sm-3 col-form-label">Frequency Month</label>
                            <div class="col-sm-5">
                                <select name="period" id="period" class="form-control">
                                    <option value="{{ \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')  }}" selected> {{ \Carbon\Carbon::now()->startOfMonth()->format('F Y') }}</option>

                                </select>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-success"> Show Employees</button>
                            </div>
                        </div>
                    </form>
                    <div>

                    </div>
                    <table class="table table-bordered" id="RunpayrollTable">
                        <thead>
                        <tr class="bg-success">
                            <th><input type="checkbox" id="chkCheckAll"></th>
                            <th>Employee Name</th>
                            <th>Category</th>
                            <th>Salary</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($contracts))
                            @foreach($contracts as $contract)
                                @if(isset($contract->employee->category) && $contract->employee->category->salary>0)
                                    <tr>
                                        <td><input type="checkbox" id="ids" class="chkBoxClass"
                                                   value="{{$contract->id}}"></td>
                                        <td>{{ $contract->employee->full_name }}</td>
                                        <td>{{$contract->employee->category->name}}</td>
                                        <td>{{$contract->employee->category->salary}}</td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('#RunpayrollTable').dataTable();
        });
    </script>
    <script type="text/javascript">
        $(function (e) {
            var table = $('#RunpayrollTable').dataTable();

            $('#chkCheckAll').click(function () {
                table.$('.chkBoxClass').prop('checked', $(this).prop('checked'))
            });

            $('#runpayroll').click(function (e) {
                e.preventDefault();
                var allids = [];
                let period=$('#period').val();
                table.$('.chkBoxClass:checked').each(function () {
                    allids.push($(this).val());
                });
                if (allids.length <= 0) {
                    swal.fire({
                        title: 'Error',
                        text: "Please select at least one record!",
                        icon: 'error'
                    });
                } else {
                    $('#runpayroll i').removeClass('fa fa-check-circle').addClass('fa fa-spin fa-spinner');
                    swal.fire({
                        title: 'Are you sure?',
                        text: "You are about to run " + allids.length + " payroll records!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, !'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('payrolls.store') }}",
                                //url:'/payroll/index',
                                method: "POST",
                                data: {
                                    ids: allids,
                                    period:period,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function (response) {
                                    $('#runpayroll i').removeClass('fa fa-spin fa-spinner').addClass('fa fa-check-circle');
                                    console.log(response);
                                    swal.fire(
                                        'Success!',
                                        'Payroll run successful.',
                                        'success'
                                    )
                                    window.location.href="{{ route('payrolls.index') }}";
                                }
                            });

                        }
                    })
                }
            });
        });
    </script>
@endpush






