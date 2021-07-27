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
                <form action="{{  route('payslip.getpayslip') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-sm-4 col-form-label">Frequency Month</label>
                                <div class="col-sm-8">
                                    <input class="form-control  @error('period') is-invalid @enderror" type="month"
                                           id="period"
                                           name="period">
                                    @error('period')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-sm-4 col-form-label">ID Number</label>
                                <div class="col-sm-8">
                                    <input class="form-control  @error('idnumber') is-invalid @enderror" type="text"
                                           id="idnumber"
                                           name="idnumber">
                                    @error('idnumber')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Process
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                @if(isset($payslip))
                    <table class="table table-striped table-bordered datatable" id="printable">
                        <thead>
                        <tr class="bg-success">
                            <th>Name</th>
                            <th>ID No</th>
                            <th>Month</th>
                            <th>Taxable</th>
                            <th>PAYE</th>
                            <th>Net Income</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>{{ $payslip->fullname }}</td>
                            <td>{{ $payslip->idno }}</td>
                            <td>{{ date('M Y',strtotime($payslip->period)) }}</td>
                            <td>{{ $payslip->taxableincome }}</td>
                            <td>{{ $payslip->paye }}</td>
                            <td>{{ $payslip->net_income }}</td>
                            <td>
                                <a href="{{ route('reports.payslip',$payslip->id) }}" class="btn btn-danger" target="_blank">
                                    <i class="fa fa-print"> Print</i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @else
                    <table class="table table-bordered">
                        <tbody>
                        <tr class="bg-danger" >
                            <td colspan="4" style="border-radius: 10px">No data found!</td>
                        </tr>
                        </tbody>
                    </table>

                @endif


            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush

