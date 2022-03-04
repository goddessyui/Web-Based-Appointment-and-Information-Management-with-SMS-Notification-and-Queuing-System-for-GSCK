<?php
include('../db_connection.php');

 // Prepare insert statement
 if (isset($_POST['accept'])) {
   date_default_timezone_set('Asia/Manila');                           		
   $currentdate = date("Y-m-d");
   $appointment_id = $_GET['appointment_id'];
   $comment = $_POST['comment'];
   $appointment_date = $_POST['appointment_date'];

   $acceptappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                           VALUES ('$appointment_id', '$currentdate', '$appointment_date', '$comment', 'accepted')";

   if(mysqli_query($db, $acceptappointment)){
      header('location: pending_requests_staff.php');
      echo "Records inserted successfully.";
   } else{
      header('location: pending_requests_staff.php');
      echo "ERROR: Not able to execute $acceptappointment. " . mysqli_error($db);
   }

 }

else if (isset($_POST['decline'])) {
      date_default_timezone_set('Asia/Manila');                           		
      $currentdate = date("Y-m-d");
   $appointment_id = $_GET['appointment_id'];
   $comment = $_POST['comment'];
   $appointment_date = $_POST['appointment_date'];
   
   $declineappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                        VALUES ('$appointment_id', '$currentdate', '$currentdate', '$comment', 'declined')";
   
   if(mysqli_query($db, $declineappointment)){
      header('location: pending_requests_staff.php');
      echo "Records inserted successfully.";
   } else{
      header('location: pending_requests_staff.php');
      echo "ERROR: Not able to execute $declineappointment. " . mysqli_error($db);
   }
  
 }


// Close connection
mysqli_close($db);

?>
