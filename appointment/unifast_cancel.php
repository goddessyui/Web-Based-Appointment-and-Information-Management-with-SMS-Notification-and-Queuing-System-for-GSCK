<?php
include_once("../dbconfig.php"); 
session_start();


if(isset($_POST['cancel'])){
 // Prepare an update statement
   $comment = $_POST['comment'];
   date_default_timezone_set('Asia/Manila');                           		
   $currentdate = date("Y-m-d");
  	
    $cancelappointment = "UPDATE tbl_appointment_detail 
    SET `date_accepted` = '$currentdate', `status` ='Cancelled', comment = '$comment' 
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

   // delete older notif if exced 10 rows
   $result = mysqli_query($db, "SELECT notification_id FROM tbl_notification WHERE id='$student_id' ORDER BY notification_id DESC LIMIT 10,1");
   $fetch = mysqli_fetch_assoc($result);
   mysqli_query($db, "DELETE FROM `tbl_notification` WHERE `notification_id` < '".$fetch['notification_id']."' AND `id`='$student_id'");

    // send sms to student if apppointment cancelled
    $querys = mysqli_query($db, "SELECT mobile_number, last_name, first_name FROM tbl_student_registry WHERE student_id='".$student_id."'");
    $rows1 = $querys->fetch_assoc();
    $m_number = $rows1['mobile_number'];
    $student_fullname = $rows1['first_name'].' '.$rows1['last_name'];
    $cancel='true';
    include ('sms_appointment.php');

   header('location: ../unifast_accepted_request.php?success="Appointment Cancelled"');
  
} else {
   header('location: ../unifast_accepted_request.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
}
mysqli_close($db);

}
?>
