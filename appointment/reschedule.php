<?php
include('../db_connection.php');
if(isset($_POST['reschedule'])){
 // Prepare an update statement
    $original = $_POST['appointment_date'];  
    $newDate = date("Y-m-d", strtotime($original));  
                              	 echo $newDate; 	
    $updatedate = "UPDATE tbl_appointment_detail SET appointment_date ='".$newDate."' WHERE appointment_id ='".$_GET['appointment_id']."'";



if (mysqli_query($conn, $updatedate)) {
    
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