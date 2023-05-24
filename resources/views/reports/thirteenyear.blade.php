<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="13month"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payroll Report</title>
    <style>
        table {
            border-collapse: collapse;
            font-size: 10px;
            margin-bottom: 20px;

        }
        th {
            border: 1px solid;
            text-align: center;
        }
        td {
            padding: 5px;
            /*text-align: right;*/
        }
        th {
            padding: 5px;
        }
        body {
            font-size: 12px;
            font-family: Raleway,sans-serif;
            color: #333;
        }
        .pull-right {
            text-align: right;
        }
        .employee {
            width: 100%;
        }

        .text-muted {
            color: #6c757d !important;
        }
        .pl-1 {
            padding-left: 15px;
        }
        hr {
            display: block;
            border: 0;
            border-top: 1px solid #a2a2a2;
            height: 0;
        }
        .total-border td {
            border-top: 1px solid;
        }
        td:first-child {
            text-align: left !important;
        }
        .text-center {
            text-align: center;
        }
        h3, h4 {
            margin: 5px;
        }
        @page {
            margin: 20px;
        }
    </style>
</head>
<body>
<h4 style="text-align: center; font-weight: normal;">
    @if($thirteen_years->first())
        <strong>{{$thirteen_years->first()->departments->department_name}}</strong>
        <br>
        {{$thirteen_years->first()->departments->department_address}}
</h4>
<h3 style="text-align: center">Thirteen Month</h3>
<p class="text-center">From the YEAR (2019)</p>
@endif
<table class="employee">
    <thead>
    <tr>
        <th>Employee Name</th>
        <th>Total Thirteenth Month Pay (2019)</th>
    </tr>

    </thead>
    <tbody>
    @foreach($thirteen_years as  $thirteen_year)
        <tr>
            <td>{{strtoupper($thirteen_year->employee->full_name)}}</td>
            <td><strong>{{number_format($thirteen_year->total_thirteen,2)}}</strong></td>


        </tr>
    @endforeach
    </tbody>
    <tbody class="total-border">
    <tr>
        <td class="bt-n"><strong>TOTAL</strong></td>
        <td class="bt-n"><strong>{{number_format($year_thirteen,2)}}</strong></td>
    </tr>
    </tbody>

</table>
</body>
</html>