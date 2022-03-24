<?php
include_once("../../dbconfig.php");
session_start(); 

//--------------------------If Add is Pressed---------------------------//
if (isset($_POST['add'])) {
   $student_id = $_POST['staffid'];
   $first_name = $_POST['firstname'];
   $last_name = $_POST['lastname'];
    

      $addstudent = "INSERT INTO tbl_student_record (`student_id`, `first_name`, `last_name`)
                    VALUES ('$student_id', '$first_name', '$last_name')";

      if(mysqli_query($db, $addstudent)){
         header('location: upload_student_records.php?success="Successfully Added Student!"');
      } 
      else {
         header('location: upload_student_records.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
      }
	
}
//--------------------------If Accept is Pressed---------------------------//
