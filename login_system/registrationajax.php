<?php
include_once("../dbconfig.php");
session_start();

// Verification
if ($_POST['type']==1){
	$s_id = $_POST['s_id']; 
    $first_name = $_POST['first_name']; 
    $last_name = $_POST['last_name']; 
    $first_name1 = ucwords($first_name);
    $last_name1 = ucwords($last_name);
	$query = mysqli_query($db, "SELECT * FROM tbl_student_record WHERE student_id='{$s_id}' AND first_name='{$first_name}' AND last_name='{$last_name}'");
	$query1 = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$s_id}'");
	$query2 = mysqli_query($db, "SELECT * FROM tbl_staff_record WHERE staff_id='{$s_id}' AND first_name='{$first_name}' AND last_name='{$last_name}'");
	$query3 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE staff_id='{$s_id}'");
	if (mysqli_num_rows($query) == 1 && mysqli_num_rows($query1) == 0){

        echo json_encode(array("statusCode"=>201, "student_id" => $s_id, "first_name" => $first_name1, "last_name" => $last_name1));
	}
	else if(mysqli_num_rows($query2) == 1 && mysqli_num_rows($query3) == 0){

        session_unset();
    	session_destroy();
		session_start();
        $_SESSION["s_id"] = $s_id;
        $_SESSION["first_name"] = $first_name1;
        $_SESSION["last_name"] = $last_name1;


        echo json_encode(array("statusCode"=>202, "staff_id"=>$s_id, "first_name"=>$first_name1, "last_name"=>$last_name1));
	}
	else if(mysqli_num_rows($query1) == 1 || mysqli_num_rows($query3) == 1){
        echo json_encode(array("statusCode"=>203));
	}

	
	else {
        echo json_encode(array("statusCode"=>204));
}
}
// Verification



// Student Registration
if ($_POST['type']==2) {
    $student_id = $_POST["student_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $username = $_POST['username']; 
    $number = $_POST['number']; 
    $course = $_POST['course']; 
    $year = $_POST['year']; 
    $passwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username='{$username}'");
            $query1 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username='{$username}'");

                if (mysqli_num_rows($query) == 0 && mysqli_num_rows($query1) == 0){
                $query2 = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE mobile_number='{$number}'");
                $query3 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE mobile_number='{$number}'");
                if (mysqli_num_rows($query2) == 0 && mysqli_num_rows($query3) == 0){
                $sql = "INSERT INTO tbl_student_registry ( `student_id`, `first_name`, `last_name`, `username`, `password`, `mobile_number`, `course`, `year`) VALUES ('{$student_id}', '{$first_name}', '{$last_name}', '{$username}', '{$passwd}', '{$number}', '{$course}', '{$year}')";
                    if (mysqli_query($db, $sql)) {
                        session_unset();
                        session_destroy();
                        session_start();
                        $_SESSION["student_id"] = $student_id;
                        $_SESSION["student_username"] = $username;
                        echo json_encode(array("statusCode"=>201));
                    }

                    else {
                    echo json_encode(array("statusCode"=>202));
                    }
                }
                else {
                    echo json_encode(array("statusCode"=>204));
                }
                    }
                else {
                echo json_encode(array("statusCode"=>203,"username" => $username));
                }
            }

// Student Registration
	



// Staff Registration
if ($_POST['type']==3) {
    $staff_id = $_POST["staff_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $username = $_POST['username']; 
    $number = $_POST['number']; 
    $position = $_POST['position']; 
    $type = $_POST['types'];
    $passwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE username='{$username}'");
            $query1 = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE username='{$username}'");
                if (mysqli_num_rows($query) == 0 && mysqli_num_rows($query1) == 0){
                    $query2 = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE mobile_number='{$number}'");
                    $query3 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE mobile_number='{$number}'");
                if (mysqli_num_rows($query2) == 0 && mysqli_num_rows($query3) == 0){
                        $sql = "INSERT INTO tbl_staff_registry ( `staff_id`, `first_name`, `last_name`, `username`, `password`, `position`, `mobile_number`) VALUES ('{$staff_id}', '{$first_name}', '{$last_name}', '{$username}', '{$passwd}', '{$position}', '{$number}')";
                        if (mysqli_query($db, $sql)){
                        foreach($type as $types){
                        $query = "INSERT INTO tbl_staff_appointment (appointment_type, staff_id)VALUES ('{$types}', '{$staff_id}')";
                        $query_run = mysqli_query($db, $query);
                        }
                        session_unset();
                        session_destroy();
                        session_start();
                        $_SESSION["staff_id"] = $staff_id;
                        $_SESSION["staff_username"] = $username;
                        $_SESSION["position"] = $position;
                        echo json_encode(array("statusCode"=>201));   
                        }

                        else {
                            echo json_encode(array("statusCode"=>202));   
                        }
                    }
                else{
                        echo json_encode(array("statusCode"=>204));   
                    }
                }

                else{
                    echo json_encode(array("statusCode"=>203,"username" => $username));
                }
                   
            }

// Staff Registration



?>