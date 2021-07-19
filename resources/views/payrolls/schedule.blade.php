<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payroll</title>
    <style>
        #payroll{
            font-font: Arial,Helvetica,sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        #payroll th{
            border: 1px solid #dddddd;
            padding: 8px;
            background-color: #ffbf1d;
        }
        #payroll td{
            border: 1px solid #dddddd;
            padding: 8px;
        }
        #payroll tr:nth-child(even){
            background-color: #0c84ff;
        }
    </style>
</head>
<body>

<table class="table table-striped table-bordered" id="payroll">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Gross Income</th>
        <th>Taxable Income</th>
        <th>PAYE</th>
        <th>Net Income</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($payrolls))
        @foreach($payrolls as $index=>$payroll)
            <tr>
                <td>{{ ++$index }}</td>
                <td>{{ $payroll->employee->full_name }}</td>
                <td>{{ $payroll->grossincome }}</td>
                <td>{{ $payroll->taxableincome }}</td>
                <td>{{ $payroll->paye }}</td>
                <td>{{ $payroll->net_income }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot style="font-weight: bolder;">
    <tr>
        <td colspan="2">Totals</td>
        <td>{{ $payrolls->sum('grossincome') }}</td>
        <td>{{ $payrolls->sum('taxableincome') }}</td>
        <td>{{ $payrolls->sum('paye') }}</td>
        <td>{{ $payrolls->sum('net_income') }}</td></tr>
    </tfoot>
</table>


</body>
</html>
