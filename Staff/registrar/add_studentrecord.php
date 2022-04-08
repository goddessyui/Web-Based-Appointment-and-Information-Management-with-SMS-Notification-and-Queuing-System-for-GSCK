<?php
include_once("../../dbconfig.php");
session_start(); 

//--------------------------If Add is Pressed---------------------------//
if (isset($_POST['add'])) {
   $student_id = $_POST['studentid'];
   $first_name = $_POST['firstname'];
   $last_name = $_POST['lastname'];
    
   $findstudent = "SELECT student_id FROM tbl_unifast_grantee WHERE student_id = '$student_id'"; //check if student already exists in database
   $findstudent_result = mysqli_query($db, $findstudent);

      $count = mysqli_num_rows($findstudent_result);  //function to get all the rows in database
      //check the num of rows                 
      if($count>0) { //we have data in database 
         header('location: ../../upload_unifast_grantee.php?error="Failed to add the student into the system. Student ID already exists in the database"');
      }
      else {
         $addstudent = "INSERT INTO tbl_student_record (`student_id`, `first_name`, `last_name`)
                    VALUES ('$student_id', '$first_name', '$last_name')";

         if(mysqli_query($db, $addstudent)){
            header('location: ../../upload_student_records.php?success="Successfully Added Student!"');
         } 
         else {
            header('location: ../../upload_student_records.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
         }
      }
}
//--------------------------If Accept is Pressed---------------------------//
