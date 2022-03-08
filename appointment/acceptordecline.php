<?php
include_once("../dbconfig.php");
session_start(); 

//--------------------------If Accept is Pressed---------------------------//
if (isset($_POST['accept'])) {
   date_default_timezone_set('Asia/Manila');                           		
   $currentdate = date("Y-m-d");
   $appointment_id = $_GET['appointment_id'];
   $comment = $_POST['comment'];
   $appointment_date = $_POST['appointment_date'];
    
   if (empty($_POST['appointment_date'])) {//if appointment date is not filled
      header('location: pending_requests_staff.php');
		$Error = 'Appointment date should be filled';
	} 
   else { //if appointment date is filled 
   
      $acceptappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                           VALUES ('$appointment_id', '$currentdate', '$appointment_date', '$comment', 'Accepted')";

      if(mysqli_query($db, $acceptappointment)){
         header('location: pending_requests_staff.php');
         echo "Records inserted successfully.";
      } 
      else {
         header('location: pending_requests_staff.php');
         echo "ERROR: Not able to execute $acceptappointment. " . mysqli_error($db);
      }
	}
}
//--------------------------If Accept is Pressed---------------------------//

//--------------------------If Decline is Pressed--------------------------// 
else if (isset($_POST['decline'])) {
   date_default_timezone_set('Asia/Manila');                           		
   $currentdate = date("Y-m-d");
   $appointment_id = $_GET['appointment_id'];
   $comment = $_POST['comment'];
   
   $declineappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                        VALUES ('$appointment_id', '$currentdate', '$currentdate', '$comment', 'Declined')";
   
   if(mysqli_query($db, $declineappointment)){
      header('location: pending_requests_staff.php');
      echo "Records inserted successfully.";
   } 
   else{
      header('location: pending_requests_staff.php');
      echo "ERROR: Not able to execute $declineappointment. " . mysqli_error($db);
   }
 }
//--------------------------If Decline is Pressed--------------------------// 

// Close connection
mysqli_close($db);

?>
