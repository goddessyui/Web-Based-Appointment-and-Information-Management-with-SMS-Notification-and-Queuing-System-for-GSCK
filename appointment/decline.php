<?php
include('../db_connection.php');
date_default_timezone_set('Asia/Manila');                           		
 $currentdate = date("Y-m-d");

 // Prepare a update statement
   	
$declineappointment = "UPDATE tbl_appointment 
                        SET date_created = '$currentdate', `status` ='declined'
                        WHERE appointment_id ='".$_GET['appointment_id']."'";



if (mysqli_query($conn, $declineappointment)) {
    
   header('location: pending_requests_staff.php');
          //exit();

	echo "Success";
} else {
	header('location: pending_requests_staff.php');
       // exit();
    echo "Error inserting record " . mysqli_error($conn);
}
mysqli_close($conn);


?>
