<?php
include('../db_connection.php');
if(isset($_POST['setappointment'])){
 // Prepare an update statement
    $student_id = $POST['student_id'];
    $staff_id= $POST['staff_id'];
    $appointment_type=$POST['appointment_type'];
    $note = $_POST['note'];  

	
    $set = "INSERT INTO tbl_appointment(student_id, staff_id, appointment_type, note)
    VALUES ('".$student_id."', '".$staff_id."', '".$note."')";


if (mysqli_query($db, $set)) {
    
    header('location: pending_requests_staff.php');
           //exit();
 
     echo "Success";
 } else {
     header('location: pending_requests_staff.php');
        // exit();
     echo "Error inserting record " . mysqli_error($db);
 }
 mysqli_close($db);
 
 }
 ?>