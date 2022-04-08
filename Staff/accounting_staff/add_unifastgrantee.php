<?php
include_once("../../dbconfig.php"); 
session_start();
$staff_id = $_SESSION["staff_id"];
$position = $_SESSION["position"];
$username = $_SESSION["staff_username"];

if ($staff_id == "" && $username == "" && $position != "Accounting Staff/Scholarship Coordinator"){
    echo '<script type="text/javascript">window.location.href="../../login_system/login.php"</script>';
}

//--------------------------If Add is Pressed---------------------------//
if (isset($_POST['add'])) {

   $student_id = $_POST['studentid'];
   $first_name = $_POST['firstname'];
   $last_name = $_POST['lastname'];
   $batch_status = $_POST['batchstatus'];
    
   $findstudent = "SELECT student_id FROM tbl_unifast_grantee WHERE student_id = '$student_id'"; //check if student already exists in database
   $findstudent_result = mysqli_query($db, $findstudent);

      $count = mysqli_num_rows($findstudent_result);  //function to get all the rows in database
      //check the num of rows                 
      if($count>0) //we have data in database
      { 
         header('location: ../../upload_unifast_grantee.php?error="Failed to add the student into the system. Student ID already exists in the database"');
      }
      else {
         $addstudent = "INSERT INTO tbl_unifast_grantee (`student_id`, `first_name`, `last_name`, `batch_status`)
                     VALUES ('$student_id', '$first_name', '$last_name', '$batch_status')";

         if(mysqli_query($db, $addstudent)){
            header('location: ../../upload_unifast_grantee.php?success="Successfully Added UniFAST Grantee!"');
         } 
         else {
            header('location: ../../upload_unifast_grantee.php?error="<?php echo "ERROR: Not able to execute. " . mysqli_error($db);?>"');
         }
      }	
}
//--------------------------If Accept is Pressed---------------------------//
?>