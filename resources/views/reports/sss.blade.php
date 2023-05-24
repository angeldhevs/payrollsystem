<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
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
        text-align: center;
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
    td:first-child { 
        text-align: left !important;
    }
    .text-center {
        text-align: center;
    }
    h3, h4 {
        margin: 5px;
    }
    .total-border td {
        border-top: 1px solid;
    }
    .total-border td {
        border-top: 1px solid;
    }
    .bt-n {
        border-top: none !important;
    }
    @page {
      margin: 20px;
    }
</style>
</head>
<body>
    <h4 style="text-align: center; font-weight: normal;">
        @if($sss_report->first())
        <strong>{{$sss_report->first()->departments->department_name}}</strong>
        <br>
            {{$sss_report->first()->departments->department_address}}
    </h4>
    <h3 style="text-align: center">Social Security System</h3>
    <p class="text-center">For the month of {{ \Carbon\Carbon::parse($month)->format('F Y')}} </p>
     @endif
    <table class="employee">
        <thead>
            <tr>
                <th rowspan="2">Employee Name</th>
                <th rowspan="2">SSS no.</th>
                <th rowspan="2">Monthly Salary</th>
                <th colspan="4">Employer</th>
                <th colspan="3">Employee</th>
                <th rowspan="2">Total</th>

            </tr>
            <tr>
                <th>SSS</th>
                <th>Privident Fund</th>
                <th>EC</th>
                <th>Total</th>
                <th>SSS</th>
                <th>Privident Fund</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sss_report as $sss_reports)
            <tr>
                <td style="text-transform: uppercase">{{$sss_reports->employee->full_name}}</td>
                <td>{{$sss_reports->employee->sss_number}}</td>
                <td>{{number_format($sss_reports->total_gross,2)}}</td>
                <td>{{number_format($sss_reports->sss()->sss_er,2)}}</td>
                <td>{{number_format($sss_reports->sss()->provident_fund*.085,2)}}</td>
                <td>{{number_format($sss_reports->sss()->ec_er,2)}}</td>
                <td>{{number_format($sss_reports->sss()->sss_er + $sss_reports->sss()->ec_er + ($sss_reports->sss()->provident_fund*.085),2)}}</td>
                <td>{{number_format($sss_reports->sss()->sss_ee,2)}}</td>
                <td>{{number_format($sss_reports->sss()->provident_fund*.045,2)}}</td>
                <td>{{number_format($sss_reports->sss()->sss_ee + ($sss_reports->sss()->provident_fund*.045),2)}}</td>
                <td>{{number_format($sss_reports->sss()->total,2)}}</td>
            </tr>
            @endforeach
        </tbody>
        <tbody class="total-border">
            <tr>
                <td class="bt-n"><strong>TOTAL</strong></td>
                <td class="bt-n"></td>
                <td><strong>{{number_format($sss_report->sum('total_gross'),2)}}</strong></td>
                <td><strong>{{number_format($total_sss_er,2)}}</strong></td>
                <td><strong>{{number_format($total_provident_er,2)}}</strong></td>
                <td><strong>{{number_format($total_ec_er,2)}}</strong></td>
                <td><strong>{{number_format($total_sss_er + $total_ec_er + $total_provident_er,2)}}</strong></td>
                <td><strong>{{number_format($total_sss_ee,2)}}</strong></td>
                <td><strong>{{number_format($total_provident_ee,2)}}</strong></td>
                <td><strong>{{number_format($total_sss_ee + $total_provident_ee,2)}}</strong></td>  
                <td><strong>{{number_format($total_sss_er + $total_ec_er + $total_sss_ee + $total_provident_ee + $total_provident_er ,2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>