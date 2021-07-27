<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fabcart</title>
    <style>
        body{
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 700px;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
            background-color: #0d1033;
            padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
            font-size: 50px;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        .sub-heading1{
            color: #f2f4f5;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            /*box-shadow: 0px 0px 5px 0.5px gray;*/
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="brand-section">
        <div class="row">
            <div class="col-6">
                <h2 class="text-white">HUDUMA KENYA SECRETARIAT</h2>
                <p class="sub-heading1">Phone: 020 6900020</p>
                <p class="sub-heading1">Email:info@hudumakenya.go.ke </p>
                <p class="sub-heading1">Address: P.O. Box 47771-00200 Nairobi </p>
            </div>
            <div class="col-6">
                <div class="company-details">
                    <p class="text-white">PAYSLIP</p>
                </div>
            </div>
        </div>
    </div>

    <div class="body-section">
        <div class="row">
            <div class="col-6">
                <h2 class="heading">{{ date('F Y',strtotime($payslip->period)) }}</h2>
                <p class="sub-heading">Employeer PIN: <b>P000000000A</b> </p>

            </div>
            <div class="col-6">
                <p class="sub-heading">Full Name: <b>{{ $payslip->fullname }}</b> </p>
                <p class="sub-heading">ID Number: <b>{{ $payslip->idno }}</b>  </p>
                <p class="sub-heading">KRA PIN: <b>{{ strtoupper($payslip->krapin) }}</b> </p>
            </div>
        </div>
    </div>

    <div class="body-section">
        <table class="table-bordered">
            <thead>
            <tr>
                <th>Earnings</th>
                <th class="w-20">Amount (KES)</th>
                <th>Deductions</th>
                <th class="w-20">Amount (KES)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Basic Salary</td>
                <td>{{ number_format($payslip->grossincome,2) }}</td>
                <td>Taxable Tax</td>
                <td>{{ number_format($payslip->grosstax,2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td> Personal Relief</td>
                <td>{{ number_format($payslip->personal_relief,2) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td> PAYE</td>
                <td>{{ number_format($payslip->paye,2) }}</td>
            </tr>
            <tr>
                <td>Taxable Income</td>
                <td>{{ number_format($payslip->taxableincome,2) }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Total Earnings</td>
                <td>{{ number_format($payslip->grossincome,2) }}</td>
                <td> Total Deductions</td>
                <td>{{ number_format($payslip->paye,2) }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Total Earnings</td>
                <td> {{ number_format($payslip->grossincome,2) }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Total Deductions</td>
                <td> {{ number_format($payslip->paye,2) }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right" >Net Salary</td>
                <td style="font-weight: bolder"> {{ number_format($payslip->net_income,2) }}</td>
            </tr>
            </tbody>
        </table>
        <br>
        <h3 class="heading">Paid</h3>
    </div>

    <div class="body-section">
        <p>&copy; Copyright {{ date('Y') }} - Huduma Kenya. All rights reserved.
            <a href="https://www.hudumakenya.go.ke/" class="float-right">HUDUMA KENYA</a>
        </p>
    </div>
</div>

</body>
</html>
