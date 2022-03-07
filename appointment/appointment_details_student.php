<?php
    include_once("../dbconfig.php");
    // Student Session
    session_start();
    $student_id = $_SESSION["student_id"];
    $username1 = $_SESSION["student_username"];
    $query = mysqli_query($db, "SELECT * FROM tbl_student_registry WHERE student_id='{$student_id}'");
    $row = $query->fetch_assoc();
    if ($student_id == "" && $username1 == ""){
        echo '<script type="text/javascript">window.location.href="../login_system/login.php"</script>';
    }

?>
<h3>Student Appointment Details</h3>
<!----------------Shows Student's List of Appointments------------------------------------------------------------>
<?php

     $appointmentdetails="SELECT * FROM tbl_appointment_detail INNER JOIN tbl_appointment 
     ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
     INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
     INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
     WHERE tbl_student_registry.student_id = '$student_id'";
    
    $appointment_list = mysqli_query($db, $appointmentdetails);
                
    //check whether the query is executed or not
    if($appointment_list==TRUE) 
    { // count rows to check whether we have data in database or not
        $count = mysqli_num_rows($appointment_list);  //function to get all the rows in database
        //check the num of rows                 
        if($count>0) //we have data in database
        {
            $i = 1;
            while($rows=mysqli_fetch_assoc($appointment_list)) 
            //using while loop to get all the date from database
            //and while loop will run as long as we have data in database
            {
?>
                <div>
                    <td>
                        <?php   echo $i;
                                $i++; 
                        ?>
                    </td>
                    <p><span>Appointment Status:</span><pre><?php echo $rows['status']; ?></pre></p> 
                    <p><span>Appointment #:</span> <?php echo $rows['appointment_id']; ?></p>
                    <p><span>Appointment Date: </span><?php echo $rows['appointment_date']; ?></p> 
                    <p><span>Date Accepted: </span><?php echo $rows['date_accepted']; ?></p> 
                    <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p>
                    <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                    <p><span>My Note:</span><pre><?php echo $rows['note']; ?></pre></p>
                    <p><span>Staff's Comment:</span><pre><?php echo $rows['comment']; ?></pre></p> 
                </div>
<?php 
            }
        }
    }

?>