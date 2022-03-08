<?php
include_once("../dbconfig.php"); 
if(isset($_POST['cancel'])){
 // Prepare an update statement
    $comment = $_POST['comment'];  
  	
    $cancelappointment = "UPDATE tbl_appointment_detail 
    SET `status` ='declined', comment = '$comment' 
    WHERE appointment_id ='".$_GET['appointment_id']."'";



if (mysqli_query($db, $cancelappointment)) {
    
   header('location: staff_accepted_requests.php');
          //exit();

	echo "Success";
} else {
	header('location: staff_accepted_requests.php');
       //exit();
    echo "Error inserting record " . mysqli_error($db);
}
mysqli_close($db);

}
?>
