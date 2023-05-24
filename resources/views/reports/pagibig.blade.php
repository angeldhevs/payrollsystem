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
		td:first-child {
			text-align: left !important;
		}
		.text-center {
			text-align: center;
		}
		.total-border td {
			border-top: 1px solid;
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
	@if($hdmf_report->first())
		<strong>{{$hdmf_report->first()->department}}</strong>
		<br>
		{{$hdmf_report->first()->departments->department_address}}
</h4>
<h3 style="text-align: center">Pag-IBIG Contributions</h3>
<p class="text-center">For the month of {{ \Carbon\Carbon::parse($month)->format('F Y')}} </p>
@endif

<table class="employee">
	<thead>
	<tr>
		<th rowspan="2">Employee TIN</th>
		<th rowspan="2">HDMF No.</th>
		<th colspan="3">NAME OF EMPLOYEES</th>
		<th colspan="3">CONTRIBUTIONS</th>
	</tr>
	<tr>
		<th>Family Name</th>
		<th>First Name</th>
		<th>Middle Name</th>
		<th>EMPLOYEE</th>
		<th>EMPLOYER</th>
		<th>TOTAL</th>
	</tr>
	</thead>
	<tbody>
	@foreach($hdmf_report as $hdmf_reports)
	<tr>
		<td>{{$hdmf_reports->employee->tin_number}}</td>
		<td>{{$hdmf_reports->employee->hdmf_number}}</td>
		<td>{{$hdmf_reports->employee->employee_Lname}}</td>
		<td>{{$hdmf_reports->employee->employee_Fname}}</td>
		<td>{{$hdmf_reports->employee->employee_Mname}}</td>
		<td>{{$hdmf_reports->total_hdmf}}</td>
		<td>{{$hdmf_reports->total_hdmf}}</td>
		<td>{{$hdmf_reports->total_hdmf*2}}</td>
	</tr>
		@endforeach
	</tbody>
	<tbody class="total-border">
	<tr>
		<td class="bt-n"><strong></strong></td>
		<td class="bt-n"><strong></strong></td>
		<td class="bt-n"><strong></strong></td>
		<td class="bt-n"><strong></strong></td>
		<td class="bt-n"><strong>TOTAL</strong></td>
		<td class="bt-n"><strong>{{$total_employee_hdmf}}</strong></td>
		<td class="bt-n"><strong>{{$total_employer_hdmf}}</strong></td>
		<td class="bt-n"><strong>{{$total_hdmf_contribution}}</strong></td>
	</tr>
	</tbody>

</table>
</body>
</html>