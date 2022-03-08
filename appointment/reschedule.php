<?php
include_once("../dbconfig.php");
session_start();
//Reschedule Appointment
if(isset($_POST['reschedule'])){
 // Prepare an update statement
    $original = $_POST['appointment_date'];  
    $newDate = date("Y-m-d", strtotime($original));  
                              	 echo $newDate; 	
    $updatedate = "UPDATE tbl_appointment_detail SET appointment_date ='$newDate' WHERE appointment_id ='".$_GET['appointment_id']."'";

if (mysqli_query($db, $updatedate)) {
    
   header('location: staff_accepted_requests.php');
          //exit();

	echo "Success";
} else {
	header('location: staff_accepted_requests.php');
       // exit();
    echo "Error inserting record " . mysqli_error($db);
}
mysqli_close($db);

}
?>
