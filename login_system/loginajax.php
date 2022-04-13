<?php
include_once("../dbconfig.php");
session_start();
  if ($_POST['type']==1) {
    $username = $_POST['username']; 
    $password = $_POST['password']; 
	$query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username='{$username}' AND password='{$password}'");
	$query2 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username='{$username}' AND password='{$password}'");
	
    if (mysqli_num_rows($query) == 1) {
        $row = $query->fetch_assoc();
        $student_id = $row["student_id"];
        $query1 = mysqli_query($db, "SELECT * FROM tbl_student_record WHERE student_id='{$student_id}'");
        
        if (mysqli_num_rows($query1) == 1) {
          
            session_unset();
            session_destroy();
            session_start();
            $_SESSION["student_id"] = $student_id;
            $_SESSION["student_username"] = $row["username"];
            echo json_encode(array("statusCode"=>200));
        }
        else{
            echo json_encode(array("statusCode"=>203));
       
        }
	}

	else if(mysqli_num_rows($query2) == 1) {
        $row = $query2->fetch_assoc();
        $staff_id = $row["staff_id"];
        $position = $row["position"];
        $query3 = mysqli_query($db, "SELECT * FROM tbl_staff_record WHERE staff_id='{$staff_id}'");

        if (mysqli_num_rows($query3) == 1) {
                session_unset();
                session_destroy();
                session_start();
                $_SESSION["staff_id"] = $staff_id;
                $_SESSION["position"] = $position;
                $_SESSION["staff_username"] = $row["username"];
               
                echo json_encode(array("statusCode"=>201));
           
        }
        else{
            echo json_encode(array("statusCode"=>204));
      
        }
    }
    else {
        echo json_encode(array("statusCode"=>202));
		
    }
	}
 

?>