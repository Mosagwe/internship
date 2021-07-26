<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payroll</title>
    <style>

        #payroll {
            font-font: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #payroll th {
            border: 1px solid #dddddd;
            padding: 8px;
            background-color: #ffbf1d;
        }

        #payroll td {
            border: 1px solid #dddddd;
            padding: 8px;
        }

        #payroll tr:nth-child(even) {
            background-color: lightgray;
        }

    </style>

</head>
<body>
<div>
    <h2>Huduma Kenya Secretariat</h2>
    @if($payrolls->count() >0)
    <h3>Payment Schedule for Fixed Contract Employee for the month of {{ date('M Y',strtotime($payrolls[0]->period)) }}</h3>
    @endif
    Categories:
    @foreach($payrolls->unique('category_id') as $payroll)
        @if(isset($payroll->category))
            {{ $payroll->category->name }}
            @if(!$loop->last),@endif
        @endif
    @endforeach
</div>
<div>

</div>
<div>

</div>
<table class="table table-striped table-bordered" id="payroll">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>ID Number</th>
        <th>KRA PIN</th>
        <th>Gross Income</th>
        <th>Taxable Income</th>
        <th>PAYE</th>
        <th>Net Income</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($payrolls))
        @forelse($payrolls as $index=>$payroll)
            <tr style="height: 0.5px">
                <td>{{ ++$index }}</td>
                <td>{{ $payroll->employee->full_name }}</td>
                <td>{{ $payroll->idno }}</td>
                <td>{{ $payroll->krapin }}</td>
                <td>{{ $payroll->grossincome }}</td>
                <td>{{ $payroll->taxableincome }}</td>
                <td>{{ $payroll->paye }}</td>
                <td>{{ $payroll->net_income }}</td>
            </tr>
        @empty
            <tr><td colspan="8">No data found</td></tr>
        @endforelse
    @endif
    </tbody>
    <tfoot style="font-weight: bolder;">
    <tr>
        <td colspan="4">Totals</td>
        <td>{{ $payrolls->sum('grossincome') }}</td>
        <td>{{ $payrolls->sum('taxableincome') }}</td>
        <td>{{ $payrolls->sum('paye') }}</td>
        <td>{{ $payrolls->sum('net_income') }}</td>
    </tr>
    </tfoot>
</table>
</body>
</html>
