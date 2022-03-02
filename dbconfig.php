<?php


$db = mysqli_connect("localhost", "admin", "admin", "db_appointment_system");

if($db == ""){
	echo '<script type="text/javascript">alert("Check database connection");window.location.href="404.html";</script>';
}


?>