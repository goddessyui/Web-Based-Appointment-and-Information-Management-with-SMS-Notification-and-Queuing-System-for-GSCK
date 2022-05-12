<?php
 include_once("dbconfig.php");
 session_start();
 $staff_id = $_SESSION["staff_id"];

 if ($_POST['type']==1) {
    $new_mobilenumber = $_POST['new_mobilenumber'];
    $new_position = $_POST["new_position"];
    $type = $_POST['types'];

    $query = mysqli_query($db, "SELECT password FROM tbl_staff_registry WHERE staff_id ='{$staff_id}' AND mobile_number='{$new_mobilenumber}'");
    if (mysqli_num_rows($query) == 1){
    $sql = "UPDATE tbl_staff_registry SET mobile_number='$new_mobilenumber', position='$new_position' WHERE staff_id = '{$staff_id}'";
        if (mysqli_query($db, $sql)) {
            $stmt = $db->prepare("DELETE FROM tbl_staff_appointment WHERE staff_id = '{$staff_id}'");
	        if ($stmt->execute()){ 
                foreach($type as $types){
                    $query = "INSERT INTO tbl_staff_appointment (appointment_type, staff_id)VALUES ('{$types}', '{$staff_id}')";
                    $query_run = mysqli_query($db, $query);
                    } 
                    $_SESSION["position"] = $new_position;
                    echo json_encode(array("statusCode"=>200));
                } 
                else{
                    echo json_encode(array("statusCode"=>201)); 
                }
        } 
        else {
        echo json_encode(array("statusCode"=>201));
        }

    }

        else {
            $query1 = mysqli_query($db, "SELECT * FROM tbl_staff_registry WHERE mobile_number='{$new_mobilenumber}'");
            $query2 = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE mobile_number='{$new_mobilenumber}'");
            if(mysqli_num_rows($query1) == 0&&mysqli_num_rows($query2) == 0){
                
                $sql = "UPDATE tbl_staff_registry SET mobile_number='$new_mobilenumber', position='$new_position' WHERE staff_id = '{$staff_id}'";
                if (mysqli_query($db, $sql)) {
                    $stmt = $db->prepare("DELETE FROM tbl_staff_appointment WHERE staff_id = '{$staff_id}'");
	            if ($stmt->execute()){ 
                foreach($type as $types){
                    $query = "INSERT INTO tbl_staff_appointment (appointment_type, staff_id)VALUES ('{$types}', '{$staff_id}')";
                    $query_run = mysqli_query($db, $query);
                    } 
                    $_SESSION["position"] = $new_position;
                    echo json_encode(array("statusCode"=>200));
                } 
                else{
                    echo json_encode(array("statusCode"=>201)); 
                }
                } 
                else {
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
        $query = mysqli_query($db, "SELECT password FROM tbl_staff_registry WHERE staff_id ='{$staff_id}'");
        $row = $query->fetch_assoc();
        if (password_verify($currentpassword,$row["password"])) {
            $sql = "UPDATE tbl_staff_registry SET password = '".$newpassword."' WHERE staff_id = '{$staff_id}'";
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