<?php
include_once("../dbconfig.php");
session_start();
//Reschedule Appointment
if(isset($_POST['reschedule'])){
 // Prepare an update statement
   date_default_timezone_set('Asia/Manila');                           		
   $currentdate = date("Y-m-d");
   $original = $_POST['appointment_date'];  
   $newDate = date("Y-m-d", strtotime($original));  
                              	 echo $newDate;
   $appointment_id = $_GET['appointment_id'];
   $comment = $_POST['comment'];
                                                                	
   $updatedate = "UPDATE tbl_appointment_detail SET `status` ='Cancelled' WHERE appointment_id ='".$_GET['appointment_id']."'";
    
if (mysqli_query($db, $updatedate)) {
   
   $insertnew ="INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
   VALUES ('$appointment_id', '$currentdate', '$newDate', '$comment', 'Accepted')";
   
   if (mysqli_query($db, $insertnew)) {
      header("refresh:2;url=staff_accepted_requests.php");
      echo "Success";
   }
   else {
      header("refresh:2;url=staff_accepted_requests.php");
       echo "Error inserting record " . mysqli_error($db);
   }

} 

else {
	header("refresh:2;url=staff_accepted_requests.php");
    echo "Error updating record " . mysqli_error($db);
}

mysqli_close($db);

}
?>
