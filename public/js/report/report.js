$(document).ready(function(){
    $('#report_type').change(function () {
        console.log($( "#report_type option:selected" ).val());
        if($( "#report_type option:selected" ).val() == '1')
        {
            $('#payroll_number').prop('disabled',false);
            $('#payroll_no').show();
            $('#dateTo').hide();
        }
        if($( "#report_type option:selected" ).val() == '2')
        {
            $('#payroll_number').prop('disabled',true);
            $('#payroll_no').show();
            $('#dateTo').hide();
        }
        if($( "#report_type option:selected" ).val() == '3')
        {
            $('#payroll_number').prop('disabled',true);
            $('#payroll_no').show();
            $('#dateTo').hide();
        }
        if($( "#report_type option:selected" ).val() == '4')
        {
            $('#payroll_number').prop('disabled',true);
            $('#payroll_no').show();
            $('#dateTo').hide();
        }
        if($( "#report_type option:selected" ).val() == '5')
        {
            $('#payroll_number').prop('disabled',true);
            $('#payroll_no').show();
            $('#dateTo').hide();
        }
        if($( "#report_type option:selected" ).val() == '6')
        {
            $('#payroll_number').prop('disabled',false);
            $('#payroll_no').show();
            $('#dateTo').hide();
        }
        if($( "#report_type option:selected" ).val() == '8')
        {
            $('#payroll_no').hide();
            $('#dateTo').show();
        }
    });

});