 $(document).ready(function(){
 	 $( "#datepickerFrom" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "DD, d MM, yy",
      altField: "#alternateFrom",
      altFormat: "yy-mm-dd"
    });
 	$( "#datepickerTo" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "DD, d MM, yy",
      altField: "#alternateTo",
      altFormat: "yy-mm-dd"
    });
 });