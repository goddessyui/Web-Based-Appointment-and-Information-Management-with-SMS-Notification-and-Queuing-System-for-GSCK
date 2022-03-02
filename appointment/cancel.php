<?php
include('../db_connection.php');
if(isset($_POST['cancel'])){
 // Prepare an update statement
    $comment = $_POST['comment'];  
  	
    $cancelappointment = "UPDATE tbl_appointment_detail 
    SET `status` ='declined', comment = '$comment' 
    WHERE appointment_id ='".$_GET['appointment_id']."'";



if (mysqli_query($conn, $cancelappointment)) {
    
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
