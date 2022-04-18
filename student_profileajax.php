<?php
include_once("dbconfig.php"); 
session_start();
$student_id = $_SESSION['student_id'];
 if ($_POST['type']==1) {
    $new_mobilenumber = $_POST['number'];
    $new_course = $_POST["course"];
    $new_year = $_POST['year'];
    $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id ='{$student_id}' AND mobile_number='{$new_mobilenumber}'");

    if (mysqli_num_rows($query) == 1){
        $sql = "UPDATE tbl_student_registry SET mobile_number='".$new_mobilenumber."', course='".$new_course."' , year='".$new_year."' WHERE student_id = '{$student_id}'";
        if (mysqli_query($db, $sql)) {
        echo json_encode(array("statusCode"=>200));
        } else {
        echo json_encode(array("statusCode"=>201));
        }   
    }

    else {
        $query1 = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE mobile_number='{$new_mobilenumber}'");
        $query2 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE mobile_number='{$new_mobilenumber}'");
        if(mysqli_num_rows($query1) == 0&&mysqli_num_rows($query2) == 0){
            $sql = "UPDATE tbl_student_registry SET mobile_number='".$new_mobilenumber."', course='".$new_course."' , year='".$new_year."' WHERE student_id = '{$student_id}'";
            if (mysqli_query($db, $sql)) {
            echo json_encode(array("statusCode"=>200));
            } else {
            echo json_encode(array("statusCode"=>201));
            }   
        }
        else{
            echo json_encode(array("statusCode"=>202));
        }
    }
}
  
    
if ($_POST['type']==2) {
    $currentpassword = $_POST['currentpass'];
    $newpassword  = password_hash($_POST['newpass'], PASSWORD_DEFAULT);
    $query = mysqli_query($db, "SELECT password FROM tbl_student_registry WHERE student_id ='{$student_id}'");
    $row = $query->fetch_assoc();
    if (password_verify($currentpassword,$row["password"])) {
        $sql = "UPDATE tbl_student_registry SET password = '".$newpassword."' WHERE student_id = '{$student_id}'";
        if (mysqli_query($db, $sql)) {
           
            echo json_encode(array("statusCode"=>200));
          } else {
            echo json_encode(array("statusCode"=>201));
            
          }
        
     }else{
       
         echo json_encode(array("statusCode"=>202));
     }
    
}

?>