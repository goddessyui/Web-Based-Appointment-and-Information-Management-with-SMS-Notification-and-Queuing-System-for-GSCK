<?php
include_once("../dbconfig.php"); 
session_start();

date_default_timezone_set('Asia/Manila');                           		
$currentdate = date("Y-m-d");

$cancelappointment = "UPDATE tbl_appointment_detail 
SET appointment_date= '$currentdate', `status` ='Done' 
WHERE appointment_id ='".$_GET['appointment_id']."'";

if (mysqli_query($db, $cancelappointment)) {

header('location: staff_accepted_requests.php');
      //exit();

echo "Success";
} else {
header('location: staff_accepted_requests.php');
   // exit();
echo "Error inserting record " . mysqli_error($db);
}
mysqli_close($db);

?>