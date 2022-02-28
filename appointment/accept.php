<?php
include('../db_connection.php');


 // Prepare a update statement

 date_default_timezone_set('Asia/Manila');                           		
 $currentdate = date("Y-m-d");
   	
$acceptappointment = "UPDATE tbl_appointment_detail 
                        SET `status` ='accepted', date_accepted = '$currentdate'
                        WHERE appointment_id ='".$_GET['appointment_id']."'";



if (mysqli_query($conn, $acceptappointment)) {
    
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
