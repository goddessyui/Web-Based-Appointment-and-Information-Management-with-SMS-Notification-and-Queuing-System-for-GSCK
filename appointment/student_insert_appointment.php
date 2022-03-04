<?php
include('../db_connection.php');
  //session_start();
    //$student_id = $_SESSION["student_id"];
    //$username1 = $_SESSION["student_username"];
    //$query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id}'");
    //$row = $query->fetch_assoc();
   // if ($student_id == "" && $username1 == ""){
    //    echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
    //}

 // Prepare insert statement
 if (isset($_POST['request'])) {
   date_default_timezone_set('Asia/Manila');                           		
   $currentdate = date("Y-m-d");
   $student_id = "STUDENTNO1"; //$_SESSION["student_id"];
   $staff_id = $_POST['staff_id'];
   $appointment_type = $_POST['appointmenttype'];
   $note = $_POST['note'];

    echo $staff_id;

   $requestappointment = "INSERT INTO tbl_appointment (`date_created`, `student_id`, `staff_id`, `appointment_type`, `note`, `status`)
                           VALUES ('$currentdate', '$student_id', '$staff_id', '$appointment_type', '$note', 'pending')";

   if(mysqli_query($db, $requestappointment)){
      header('location: appointment_student.php');
      echo "Records inserted successfully.";
      
   } else{
      header('location: appointment_student.php');
      echo "ERROR: Not able to execute $acceptappointment. " . mysqli_error($db);
   }
 }
// Close connection
mysqli_close($db);

?>
