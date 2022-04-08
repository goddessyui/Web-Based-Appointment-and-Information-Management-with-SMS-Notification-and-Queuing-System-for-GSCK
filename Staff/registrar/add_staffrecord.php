<?php
include_once("../../dbconfig.php");
session_start(); 

//--------------------------If Add is Pressed---------------------------//
if (isset($_POST['add'])) {
   $staff_id = $_POST['staffid'];
   $first_name = $_POST['firstname'];
   $last_name = $_POST['lastname'];
    
   $findstaff = "SELECT staff_id FROM tbl_staff_record WHERE staff_id = '$staff_id'";//check if staff already exists in database
   $findstaff_result = mysqli_query($db, $findstaff);

      $count = mysqli_num_rows($findstaff_result);  //function to get all the rows in database
      //check the num of rows                 
      if($count>0) //we have data in database
      { 
         header('location: ../../upload_unifast_grantee.php?error="Failed to add the staff into the system. Staff ID already exists in the database"');
      }
      else{
         $addstaff = "INSERT INTO tbl_staff_record (`staff_id`, `first_name`, `last_name`)
         VALUES ('$staff_id', '$first_name', '$last_name')";

         if(mysqli_query($db, $addstaff)){
            header('location: ../../upload_staff_records.php?success="Successfully Added Staff!"');
         } 
         else {
            header('location: ../../upload_staff_records.php?error="error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
         }
      }
}
//--------------------------If Accept is Pressed---------------------------//
