<?php include_once("../dbconfig.php"); 

$month = date('Y/m');
echo $month;
?>
<div class="container" style="padding-top:50px">
<h2>Generate Appointment Reports</h2>

<form class="form-inline" method="post" action="generatereport.php" target="_blank">


<div>
<select name="status" id="status">  
			<option value="Accepted">Accepted</option>
			<option value="Declined">Declined</option>
			<option value="Canceled">Canceled</option>
			<option value="Done">Done</option>
            <option value="Missed">Missed</option>
</select>
</div>

<div>
<input type="checkbox" name="check_list" value="Meeting">
<label>Daily Report</label><br>
<input type="checkbox" name="check_list" value="Meeting">
<label>Weekly Report</label><br>
<input type="checkbox" name="check_list" value="Meeting">
<label>Monthly Report</label><br>
</div>

<button type="submit" id="pdf" name="generate_pdf" class="btn btn-primary">
Generate PDF</button>
</form>




</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('input[type="checkbox"]').on('change', function() {
   $('input[type="checkbox"]').not(this).prop('checked', false);
});
</script>