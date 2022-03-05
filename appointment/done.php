<?php
include_once("../dbconfig.php"); 

date_default_timezone_set('Asia/Manila');                           		
 $currentdate = date("Y-m-d");

$cancelappointment = "UPDATE tbl_appointment_detail 
SET appointment_date= '$currentdate', `status` ='done' 
WHERE appointment_id ='".$_GET['appointment_id']."'";



if (mysqli_query($db, $cancelappointment)) {

header('location: accepted_requests_staff.php');
      //exit();

echo "Success";
} else {
header('location: accepted_requests_staff.php');
   // exit();
echo "Error inserting record " . mysqli_error($db);
}
mysqli_close($db);

?>