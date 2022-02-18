<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script language="javascript" type="text/javascript">
function doReload(appointment_name){
	document.location = 'request_appointment.php?appointment_name=' + appointment_name;
}
</script>


</head>
<body>
<form class="request_appointment.php" method="POST">
<div><select name="appointment_name" onChange="doReload(this.value);"> 

    <option value="">---All Category---</option>  
    <option value="Teacher">Teacher Meet up</option>  
    <option value="Account Staff">Accounting Staff</option>  
    <option value="Account Staff">Unifast</option>
    <option value="Account Staff">Registrar</option>
    <option value="Account Staff">etctectec</option>
     </select>  </div>

    <?php
    if ($_GET["appointment_name"] == "Teacher"){?>
    <h1>teacher</h1>
    <?php } 
    else if ($_GET["appointment_name"] == "Account Staff"){?>
    <h1>acc</h1>
    <?php } ?>

    <div class="">
		<button class="" type="submit" name="button_register">Request Appointment</button>
	</div>
	







	</form>
</body>
</html>