<?php
   include_once("../dbconfig.php");
   // Student Session
   session_start();
   $student_id = $_SESSION["student_id"];
   $username1 = $_SESSION["student_username"];
   $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id}'");
   $row = $query->fetch_assoc();
   if ($student_id == "" && $username1 == ""){
      echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
   }

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
         header("refresh:2;url=student_appointment.php"); /* Redirect browser */
         echo "You already requested this appointment with the same staff. You can try again tomorrow.";
      }
      else {//if not exists, insert
         $requestappointment = "INSERT INTO tbl_appointment (`date_created`, `student_id`, `staff_id`, `appointment_type`, `note`, `status`)
                              VALUES ('$currentdate', '$student_id', '$staff_id', '$appointment_type', '$note', 'Pending')";

         if(mysqli_query($db, $requestappointment))
         {
            header("refresh:2;url=../student_index.php");/* Redirect browser */
            echo "You successfully sent a request for appointment.";     
         } 
         else
         {
            header("refresh:2;url=student_appointment.php"); /* Redirect browser */
            echo "ERROR: Not able to execute your request at this time. " . mysqli_error($db);
         }
      }
   }
// Close connection
mysqli_close($db);

?>
