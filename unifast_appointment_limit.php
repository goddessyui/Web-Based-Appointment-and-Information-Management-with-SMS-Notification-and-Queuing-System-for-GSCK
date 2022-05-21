<?php
include_once('dbconfig.php');
    if(isset($_POST['unifast_limit'])){
        
        $limit_value = $_POST['unifast_limit_value'];

        if ($limit_value>0){
            $limitapp="UPDATE tbl_appointment_limit SET appointment_limit = '{$limit_value}' WHERE limit_id = '2'";
            if (mysqli_query($db, $limitapp)) {
                header('location: dashboard.php?success=<p>Successfully updated appointment limit.</p>');
                
                echo "Success";
            } else {
                header('location: dashboard.php?error=<p>Error inserting record.</p>');
            }
        }
        else {
            header('location: dashboard.php?error=<p>Can not accept 0 value</p>');
        }
         
    }

    ?>