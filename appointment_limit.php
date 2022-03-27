<?php
include_once('dbconfig.php');
    if(isset($_POST['limit'])){
        
        $limit_value = $_POST['limit_value'];
        echo $limit_value;
        $limitapp="UPDATE tbl_appointment_limit SET appointment_limit = '.$limit_value.' WHERE limit_id = '1'";
        if (mysqli_query($db, $limitapp)) {
             header('location: admin.php');
             
             echo "Success";
         } else {
             header('location: admin.php');
                //exit();
             echo "Error inserting record " . mysqli_error($db);
         }  
    }

    ?>