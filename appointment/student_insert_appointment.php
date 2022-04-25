<?php
   include_once("../dbconfig.php");
   // Student Session
   session_start();
 

 // Prepare insert statement
   if (isset($_POST['request'])) 
   {
      date_default_timezone_set('Asia/Manila');                           		
      $currentdate = date("Y-m-d");
      $student_id = $_SESSION["student_id"];
      $staff_id = $_POST['staff_id'];
      $appointment_type = $_POST['appointmenttype'];
      $note = $_POST['note'];
      //check if student already sent the same request



      
      $check = "SELECT * FROM tbl_appointment
               WHERE student_id = '$student_id' AND appointment_type = '$appointment_type' 
               AND staff_id ='$staff_id' AND date_created='$currentdate'";

      $result = mysqli_query($db, $check);
     
      if(mysqli_num_rows($result) > 0) 
      {//if exists, do not insert
         /* Redirect browser and send form validation message */
         header('location: ../student_appointment.php?msg=<font color="red">You already requested this appointment with the same staff. <br> You can try again tomorrow.</font>'); 
      }
      else 
      {//if not exists, insert
         $requestappointment = "INSERT INTO tbl_appointment
                               (`date_created`, `student_id`, `staff_id`, `appointment_type`, `note`, `status`)
                              VALUES ('$currentdate', '$student_id', '$staff_id', '$appointment_type', '$note', 'Pending')";

         if(mysqli_query($db, $requestappointment))
         {  /* Redirect browser and send form validation message */
            $app_id = $db->insert_id;
            // insert data into tbl_notification if student reqeusted an appointment
            $querys = mysqli_query($db, "SELECT tbl_student_registry.first_name, tbl_student_registry.last_name FROM tbl_student_registry WHERE student_id='".$student_id."'");
            $rows = $querys->fetch_assoc();
            $fullnames = $rows['first_name'].' '.$rows['last_name'];
            mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`, `link`) 
            VALUES ('Requested an Appointment', '$fullnames requested for $appointment_type', '0', '$staff_id', 'staff_pending_requests.php?status=pending&apde=$app_id')");

            // delete older notif if exced 10 rows
            $result = mysqli_query($db, "SELECT notification_id FROM tbl_notification WHERE id='$staff_id' ORDER BY notification_id DESC LIMIT 10,1");
            $fetch = mysqli_fetch_assoc($result);
            mysqli_query($db, "DELETE FROM `tbl_notification` WHERE `notification_id` < '".$fetch['notification_id']."' AND `id`='$staff_id'");

            header('location: ../student_appointment.php?msg=<font color="blue">You successfully sent a request.</font>'); 

         } 
         else
         {/* Redirect browser and send form validation message */
            header('location: ../student_appointment.php?msg=<font color="red">ERROR: Not able to execute your request at this time.</font>');
         }
      }
   }
// Close connection
mysqli_close($db);

?>
