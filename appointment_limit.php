<?php
include_once('dbconfig.php');
    if(isset($_POST['limit'])){
        
        $limit_value = $_POST['limit_value'];

    if ($limit_value>0){
            $limitapp="UPDATE tbl_appointment_limit SET appointment_limit = '{$limit_value}' WHERE limit_id = '1'";

            if (mysqli_query($db, $limitapp)) {
                header('location: dashboard.php?success=Successfully updated appointment limit.');

            } 
            
            else {
            
                header('location: dashboard.php?error=Error in updating appointment limit.');
            }
    }
    else {
            header('location: dashboard.php?error=<p>Can not accept 0 value</p>');
    }
         
         
    }

    ?>