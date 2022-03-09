<?php
include_once("../../dbconfig.php");
session_start(); 

//--------------------------If Add is Pressed---------------------------//
if (isset($_POST['add'])) {
   $staff_id = $_POST['staffid'];
   $first_name = $_POST['firstname'];
   $last_name = $_POST['lastname'];
    

      $addstaff = "INSERT INTO tbl_staff_record (`staff_id`, `first_name`, `last_name`)
                    VALUES ('$staff_id', '$first_name', '$last_name')";

      if(mysqli_query($db, $addstaff)){
         header("location: upload_staff_records.php");
      } 
      else {
        header("location: upload_staff_records.php");
         echo "ERROR: Not able to execute. " . mysqli_error($db);
      }
	
}
//--------------------------If Accept is Pressed---------------------------//
