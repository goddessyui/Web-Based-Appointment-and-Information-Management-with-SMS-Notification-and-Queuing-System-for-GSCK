<?php
include('../db_connection.php');

if(isset($_POST['update'])){
 // Prepare an update statement	
    $updatestatus = "UPDATE tbl_appointment_detail SET `status` = 'done' WHERE appointment_id ='".$_GET['appointment_id']."'";



if (mysqli_query($conn, $updatestatus)) {
    
   header('location: accepted_requests_staff.php');
          //exit();

	echo "Success";
} else {
	header('location: accepted_requests_staff.php');
       // exit();
    echo "Error inserting record " . mysqli_error($conn);
}
mysqli_close($conn);

}
?>
