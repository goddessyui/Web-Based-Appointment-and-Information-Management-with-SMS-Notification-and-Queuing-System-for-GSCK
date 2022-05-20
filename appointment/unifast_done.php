<?php
include_once("../dbconfig.php"); 
session_start();

date_default_timezone_set('Asia/Manila');                           		
$currentdate = date("Y-m-d");

$cancelappointment = "UPDATE tbl_appointment_detail 
SET appointment_date= '$currentdate', `status` ='Done' 
WHERE appointment_id ='".$_GET['appointment_id']."'";

if (mysqli_query($db, $cancelappointment)) {
      header('location: ../unifast_accepted_request.php?success="Done with Appointment"');

} else {
      header('location: ../unifast_accepted_request.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
}
mysqli_close($db);

?>