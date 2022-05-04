<?php
include_once('dbconfig.php');
    if(isset($_POST['limit'])){
        
        $limit_value = $_POST['limit_value'];

        date_default_timezone_set('Asia/Manila');                           		
        $currentdate = date("Y-m-d");
            $applimit = "SELECT appointment_detail_id FROM tbl_appointment_detail 
                WHERE `status` = ('Accepted' OR 'Cancelled') 
                AND appointment_date = '$currentdate'";
            $al = mysqli_query($db, $applimit);
            $count = mysqli_num_rows($al);
            echo $count;

        if($limit_value<=$count) { 
            header('location: admin.php?error=<p>Error: The value is less than the current number of appointments already filled today. Please use a higher value than the number of slots already taken.</p>');
         
        } 
        else {
            $limitapp="UPDATE tbl_appointment_limit SET appointment_limit = '.$limit_value.' WHERE limit_id = '1'";
            if (mysqli_query($db, $limitapp)) {
                header('location: admin.php?success=<p>Successfully updated appointment limit.</p>');
                
                echo "Success";
            } else {
                header('location: admin.php?error=<p>Error inserting record.</p>');
            }
        
        }  
    }

    ?>