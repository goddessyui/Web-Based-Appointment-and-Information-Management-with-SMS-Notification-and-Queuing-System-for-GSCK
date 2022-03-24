<?php
include_once("../dbconfig.php");
session_start(); 

//--------------------------Start of If Accept is Pressed---------------------------//
if (isset($_POST['accept'])) {
   date_default_timezone_set('Asia/Manila');                           		
   $currentdate = date("Y-m-d");
   $appointment_id = $_GET['appointment_id'];
   $comment = $_POST['comment'];
   $appointment_date = $_POST['appointment_date'];
    
   if (empty($_POST['appointment_date'])) {//if appointment date is not filled
      header("refresh:1;url=staff_pending_requests.php");
		echo "Appointment date should be filled";
	} 
   else { //if appointment date is filled 
   
      $acceptappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                           VALUES ('$appointment_id', '$currentdate', '$appointment_date', '$comment', 'Accepted')";

      if(mysqli_query($db, $acceptappointment)){
         header("refresh:2;url=staff_pending_requests.php");
         echo "Appointment request accepted and scheduled on". " ". $appointment_date;
            //Add Queueing and SMS function here???-----------------------------------------
            $q="SELECT queuenum FROM (SELECT *, ROW_NUMBER() OVER(ORDER BY appointment_id) AS queuenum 
            FROM tbl_appointment_detail WHERE (`status` = 'Accepted' OR `status` = 'Cancelled') 
            AND appointment_date = '$appointment_date') T2 WHERE appointment_id='$appointment_id'";
            $qnum = mysqli_query($db, $q); 
            $queue = mysqli_fetch_assoc($qnum);
            //Queue Number---------------------------------------------------------------------------------------//
            $queuenumber = $queue['queuenum'];
            echo "<br><br>Queue Number:" . $queuenumber;
            //Queue Number---------------------------------------------------------------------------------------//

            
      } 
      else {
         header("refresh:2;url=staff_pending_requests.php");
         echo "ERROR: Not able to execute. " . mysqli_error($db);
      }
	}
}
//--------------------------End of If Accept is Pressed---------------------------//

//--------------------------Start of If Decline is Pressed--------------------------// 
else if (isset($_POST['decline'])) {
   date_default_timezone_set('Asia/Manila');                           		
   $currentdate = date("Y-m-d");
   $appointment_id = $_GET['appointment_id'];
   $comment = $_POST['comment'];
   
   $declineappointment = "INSERT INTO tbl_appointment_detail (`appointment_id`, `date_accepted`, `appointment_date`, `comment`, `status`)
                        VALUES ('$appointment_id', '$currentdate', '$currentdate', '$comment', 'Declined')";
   
   if(mysqli_query($db, $declineappointment)){
      header("refresh:2;url=staff_pending_requests.php");
      echo "Appointment Request Declined.";
   } 
   else{
      header("refresh:2;url=staff_pending_requests.php");
      echo "ERROR: Not able to execute. " . mysqli_error($db);
   }
 }
//--------------------------End of If Decline is Pressed--------------------------// 

// Close connection
mysqli_close($db);

?>
