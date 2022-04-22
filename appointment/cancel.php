<?php
include_once("../dbconfig.php"); 
session_start();


if(isset($_POST['cancel'])){
 // Prepare an update statement
    $comment = $_POST['comment'];  
  	
    $cancelappointment = "UPDATE tbl_appointment_detail 
    SET `status` ='Cancelled', comment = '$comment' 
    WHERE appointment_id ='".$_GET['appointment_id']."'";



if (mysqli_query($db, $cancelappointment)) {
   // insert data into tbl_notification if staff  cancel an appointment
   $appointment_id = $_GET['appointment_id'];
   $appointment_type = $_POST['appointment_type'];
   $student_id = $_POST['student_id'];
   $staff_id = $_SESSION["staff_id"];
   $querys = mysqli_query($db, "SELECT tbl_staff_registry.first_name, tbl_staff_registry.last_name FROM tbl_staff_registry WHERE staff_id='".$staff_id."'");
   $rows = $querys->fetch_assoc();
    $fullnames = $rows['first_name'].' '.$rows['last_name'];
    mysqli_query($db, "INSERT INTO tbl_notification (`notification_subject`, `notification_text`, `notification_status`, `id`, `link`) VALUES 
   ('APPOINTMENT CANCELLED', 
   '$fullnames has CANCELLED your appointment for $appointment_type', '0', 
   '$student_id', 'student_appointment_details.php?status=cancel&apde=$appointment_id')");

   header('location: ../staff_accepted_requests.php?success="Appointment Cancelled"');
  
} else {
   header('location: ../staff_accepted_requests.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
}
mysqli_close($db);

}
?>
