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
            font-size: 11px;

        }
        td, th {
            border: 1px solid;
            text-align: center;
            padding: 5px;
        }
        td {
            overflow-wrap: break-word;
        }
        body {
            font-size: 12px;
            font-family: Raleway,sans-serif;
            color: #333;
        }
        .pull-right {
            text-align: right;
            /*float:left;*/
        }
        .text-center {
            text-align: center;
        }
        .employee {
            width: 100%;
        }
        .text-muted {
            color: #6c757d !important;
        }
        .employee {
            width: 100%;
        }
        .col-4 {
            width: 33.33333333%;
            display: block;
            float: left;
        }
        h2 {
            margin: 5px 0px;
        }
        @page {
            margin: 15px;
        }
        .page_break { page-break-before: always; }
    </style>

</head>
<body>
<h4 style="text-align: center; font-weight: normal;">
    @if($employees->first())
        <strong>{{$employees->first()->department}}</strong>
        {{-- <p class="text-center">{{$employees->first()->departments->department_address}}</p> --}}
</h4>
@endif
<h3 style="text-align: center">Witholding Tax Report</h3>
<h4 class="text-center">For the Year of {{$year}} </h4>

<table class="employee">
    <thead>
    <tr>
        <th rowspan="3" colspan="3">Taxpayer's ID No.</th>
        <th rowspan="3" colspan="3">Employee Name</th>
        <th rowspan="3" colspan="3">Basic Salary</th>
        <th colspan="5">GROSS COMPENSATION INCOME</th>
        <th rowspan="3" colspan="3">TAX DUE</th>
        <th rowspan="3" colspan="3">TAX WITHELD</th>
        <th rowspan="3" colspan="3">DUES</th>
        <th rowspan="3" colspan="3">REFUND</th>
    </tr>
    <tr>
        <th colspan="3">NON-TAXABLE</th>
        <th colspan="2">TAXABLE</th>
    </tr>
    <tr>
        <th>13th Month</th>
        <th>SSS, PHIC & Pag-ibig Contribution</th>
        <th>Salaries & Other Compensation</th>

        <th>Total Grosspay and Leaves</th>
        <th>Net Taxable Income</th>
    </tr>
    </thead>
    <tbody>
    @foreach($employees as $employee)
    <tr>
        <td colspan="3">{{$employee->tin_number}}</td>
        <td colspan="3">{{strtoupper($employee->employee->full_name)}}</td>
        <td colspan="3">{{number_format($employee->basic_pay,2)}}</td>
    @php
        $rest_day = $employee->rest_special_hours/8;
        $rest_day_total = $rest_day *  $employee->employee->basic_pay;
    @endphp

        {{--<td>{{number_format(($employee->basic_pay + $employee->sick_leave_amount)/12,2)}}</td>--}}
        <td>{{number_format($employee->annual_thirteen,2)}}</td>
        <td>{{number_format($employee->annual_sss + $employee->annual_phic + $employee->annual_hdmf,2)}}</td>
        <td>{{number_format($employee->annual_non_tax_other + $employee->annual_cola_amount,2)}}</td>


        <td>{{number_format($employee->annual_work_days_amount + ($employee->sick_leave_amount)/12 ,2)}}</td>
        <td>{{number_format(($employee->annual_work_days_amount - ($employee->annual_non_tax_other + $employee->annual_cola_amount)) - ($employee->annual_sss + $employee->annual_phic + $employee->annual_hdmf) ,2)}}</td>
        @php
        $taxDues = 0;
        $dues = 0;
        $refund = 0;

            if ($employee->annual_work_days_amount <=250000)
            {
                $taxDues = 0;
            }
            if(($employee->annual_work_days_amount - ($employee->annual_sss + $employee->annual_phic + $employee->annual_hdmf))-($employee->annual_non_tax_other + $employee->annual_cola_amount) >=250000 && ($employee->annual_work_days_amount - ($employee->annual_sss + $employee->annual_phic + $employee->annual_hdmf))-($employee->annual_non_tax_other + $employee->annual_cola_amount) <= 399999.99)
                {
                    $taxDues = (($employee->annual_work_days_amount - ($employee->annual_sss + $employee->annual_phic + $employee->annual_hdmf))- ($employee->annual_non_tax_other + $employee->annual_cola_amount)) - 250000;
                    $taxDues = $taxDues *.2;


                }
            if(($employee->annual_work_days_amount - ($employee->annual_sss + $employee->annual_phic + $employee->annual_hdmf))-($employee->annual_non_tax_other + $employee->annual_cola_amount) >=400000 && ($employee->annual_work_days_amount - ($employee->annual_sss + $employee->annual_phic + $employee->annual_hdmf))-($employee->annual_non_tax_other + $employee->annual_cola_amount) <= 799999.99)
                {
                    $taxDues = ($employee->annual_work_days_amount - ($employee->annual_sss + $employee->annual_phic + $employee->annual_hdmf)- ($employee->annual_non_tax_other + $employee->annual_cola_amount)) - 400000;
                    $taxDues = ($taxDues *.25) + 30000;

                }


        $dues = number_format($taxDues - $employee->annual_witholding_tax,2);
        $refund = number_format($employee->annual_witholding_tax - $taxDues,2);

        @endphp
        <td colspan="3">{{number_format($taxDues,2)}}</td>
        <td colspan="3">{{number_format($employee->annual_witholding_tax,2)}}</td>
        <td colspan="3">{{$dues}}</td>
        <td colspan="3">{{$refund}}</td>
    </tr>
    @endforeach
    <tbody class="total-border">
    <tr>
        <td colspan="6"><strong>TOTAL</strong></td>
        <td colspan="3"><strong>{{number_format($employees->sum('basic_pay'),2)}}</strong></td>
        <td><strong>{{number_format($employees->sum('annual_thirteen'),2)}}</strong></td>
        <td><strong>{{number_format($employees->sum('annual_sss')+$employees->sum('annual_phic')+$employees->sum('annual_hdmf'),2)}}</strong></td>
        <td><strong>{{number_format($employees->sum('annual_non_tax_other') + $employees->sum('annual_cole_amount'),2)}}</strong></td>
        <td><strong>{{number_format($employees->sum('annual_work_days_amount'),2)}}</strong></td>
        <td><strong>{{number_format($employees->sum('annual_work_days_amount') - ($employees->sum('annual_non_tax_other')+$employees->sum('annual_sss')+$employees->sum('annual_phic')+$employees->sum('annual_hdmf')),2)}}</strong></td>
        <td colspan="3"><strong>{{number_format($totalDues,2)}}</strong></td>
        <td colspan="3"><strong>{{number_format($employees->sum('annual_witholding_tax'),2)}}</strong></td>
        <td colspan="3"><strong>{{number_format($totalDue,2)}}</strong></td>
        <td colspan="3"><strong>{{number_format($totalRefund,2)}}</strong></td>



    </tr>
    </tbody>
    </tbody>
</table>
<div class="page_break">
    <h3 style="text-align: center">INACTIVE EMPLOYEES</h3>
    <table class="employee">
        <thead>
        <tr>
            <th rowspan="3" colspan="3">Taxpayer's ID No.</th>
            <th rowspan="3" colspan="3">Employee Name</th>
            <th rowspan="3" colspan="3">Basic Pay</th>
            <th colspan="5">GROSS COMPENSATION INCOME</th>
            <th rowspan="3" colspan="3">TAX DUE</th>
            <th rowspan="3" colspan="3">TAX WITHELD</th>
            <th rowspan="3" colspan="3">DUES</th>
            <th rowspan="3" colspan="3">REFUND</th>
        </tr>
        <tr>
            <th colspan="3">NON-TAXABLE</th>
            <th colspan="2">TAXABLE</th>
        </tr>
        <tr>
            <th>13th Month</th>
            <th>SSS, PHIC & Pag-ibig Contribution</th>
            <th>Salaries & Other Compensation</th>

            <th>Total Grosspay and Leaves</th>
            <th>Net Taxable Income</th>
        </tr>
        </thead>
        <tbody>
        @foreach($inactive_employees as $inactive_employee)
            <tr>
                <td colspan="3">{{$inactive_employee->tin_number}}</td>
                <td colspan="3">{{strtoupper($inactive_employee->employee->full_name)}}</td>
                <td colspan="3">{{number_format($inactive_employee->basic_pay,2)}}</td>
                @php
                    $rest_day = $inactive_employee->rest_special_hours/8;
                    $rest_day_total = $rest_day *  $inactive_employee->employee->basic_pay;
                @endphp
                {{--<td>{{number_format(($inactive_employee->basic_pay + $inactive_employee->sick_leave_amount)/12,2)}}</td>--}}
                <td>{{number_format($inactive_employee->annual_thirteen,2)}}</td>
                <td>{{number_format($inactive_employee->annual_sss + $inactive_employee->annual_phic + $inactive_employee->annual_hdmf,2)}}</td>
                <td>{{number_format($inactive_employee->annual_non_tax_other + $inactive_employee->annual_cola_amount,2)}}</td>


                <td>{{number_format($inactive_employee->annual_work_days_amount + ($inactive_employee->sick_leave_amount)/12 ,2)}}</td>
                <td>{{number_format(($inactive_employee->annual_work_days_amount - ($inactive_employee->annual_non_tax_other + $inactive_employee->annual_cola_amount)) - ($inactive_employee->annual_sss + $inactive_employee->annual_phic + $inactive_employee->annual_hdmf) ,2)}}</td>
                @php
                    $taxDue = 0;
                    $dues = 0;
                    $refund = 0;
                        if($inactive_employee->annual_work_days_amount >=250000 && $inactive_employee->annual_work_days_amount <= 399999.99)
                            {
                                $taxDue = ($inactive_employee->annual_work_days_amount - ($inactive_employee->annual_sss + $inactive_employee->annual_phic + $inactive_employee->annual_hdmf)) - 250000;
                                $taxDue = $taxDue *.2;
                            }
                        if($inactive_employee->annual_work_days_amount >=400000 && $inactive_employee->annual_work_days_amount <= 799999.99)
                            {
                                $taxDue = ($inactive_employee->annual_work_days_amount - ($inactive_employee->annual_sss + $inactive_employee->annual_phic + $inactive_employee->annual_hdmf)) - 400000;
                                $taxDue = ($taxDue *.25) + 30000;
                            }
                    $dues = number_format($taxDue - $inactive_employee->annual_witholding_tax,2);
                    $refund = number_format($inactive_employee->annual_witholding_tax - $taxDue,2);

                @endphp
                <td colspan="3">{{number_format($taxDue,2)}}</td>
                <td colspan="3">{{number_format($inactive_employee->annual_witholding_tax,2)}}</td>
                <td colspan="3">{{$dues}}</td>
                <td colspan="3">{{$refund}}</td>
                @endphp
            </tr>
        @endforeach
        </tbody>
        <tbody class="total-border">
        <tr>
            <td colspan="6"><strong>TOTAL</strong></td>
            <td colspan="3"><strong>{{number_format($inactive_employees->sum('basic_pay'),2)}}</strong></td>
            <td><strong>{{number_format($inactive_employees->sum('annual_thirteen'),2)}}</strong></td>
            <td><strong>{{number_format($inactive_employees->sum('annual_sss')+$inactive_employees->sum('annual_phic')+$inactive_employees->sum('annual_hdmf'),2)}}</strong></td>
            <td><strong>{{number_format($inactive_employees->sum('annual_non_tax_other') + $inactive_employees->sum('annual_cole_amount'),2)}}</strong></td>
            <td><strong>{{number_format($inactive_employees->sum('annual_work_days_amount'),2)}}</strong></td>
            <td><strong>{{number_format($inactive_employees->sum('annual_work_days_amount') - ($inactive_employees->sum('annual_non_tax_other')+$inactive_employees->sum('annual_sss')+$inactive_employees->sum('annual_phic')+$inactive_employees->sum('annual_hdmf')),2)}}</strong></td>
            <td colspan="3"><strong>{{number_format($inactive_totalDues,2)}}</strong></td>
            <td colspan="3"><strong>{{number_format($inactive_employees->sum('annual_witholding_tax'),2)}}</strong></td>
            <td colspan="3"><strong>{{number_format($inactive_totalDue,2)}}</strong></td>
            <td colspan="3"><strong>{{number_format($inactive_totalRefund,2)}}</strong></td>



        </tr>
        </tbody>
    </table>
</div>

</body>
</html>
