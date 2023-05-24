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
            font-size: 9.5px;
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
    @if($thirteen_month->first())
        <strong>{{$thirteen_month->first()->department}}</strong>
        {{--{{$thirteen_month->first()->departments->department_address}}--}}

</h4>
<p class="text-center">From the month of</p>
@endif
<table class="employee">
    <thead>
    <tr>
        <th>Employee Name</th>
        <th>Total Basic Pay from June this Year</th>
        <th>Thirteenth Month Pay</th>
    </tr>
    </thead>
    <tbody>
    @foreach($thirteen_month as  $thirteen_month_report)
        @php
            $rest_day = $thirteen_month_report->rest_special_hours/8;
            $rest_day_total = $rest_day *  $thirteen_month_report->employee->basic_pay;
        @endphp
        <tr>
            <td>{{strtoupper($thirteen_month_report->employee->full_name)}}</td>
            {{-- @if($thirteen_month_report->custom_thirteen == 1)
                <td>{{number_format((($thirteen_month_report->employee->basic_pay )*((\Carbon\Carbon::now()->diffInMonths(\Carbon\Carbon::parse('2020-06-01'))+1))*25)+ $thirteen_month_report->leave_amount)}}</td>
            @elseif($thirteen_month_report->custom_thirteen == 2)
                <td>{{number_format($thirteen_month_report->basic_pay  + $thirteen_month_report->leave_amount ,2)}}</td>
            @else --}}
            <td>{{number_format($thirteen_month_report->basic_pay + $thirteen_month_report->leave_amount)}}</td>
            {{-- @endif --}}
            {{-- @if($thirteen_month_report->custom_thirteen == 1)
                <td>{{number_format(((($thirteen_month_report->employee->basic_pay)*((\Carbon\Carbon::now()->diffInMonths(\Carbon\Carbon::parse('2020-06-01'))+1))*25)+ $thirteen_month_report->leave_amount)/12)}}</td>
            @elseif($thirteen_month_report->custom_thirteen == 2)
                <td>{{number_format(($thirteen_month_report->basic_pay + $thirteen_month_report->leave_amount)/12,2)}}</td>
            @else --}}
                <td>{{number_format(($thirteen_month_report->basic_pay + $thirteen_month_report->leave_amount)/12,2)}}</td>
            {{-- @endif --}}

        </tr>
    @endforeach
    </tbody>
    <tbody class="total-border">
    <tr>
        <td class="bt-n"><strong>TOTAL</strong></td>
        <td class="bt-n"><strong>{{number_format($total_thirteen,2)}}</strong></td>
        <td class="bt-n"><strong>{{number_format($total_thirteen/12,2)}}</strong></td>
    </tr>
    </tbody>

</table>
</body>
</html>