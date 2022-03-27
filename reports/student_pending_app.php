
<!----------------Shows Student's Pending Appointments------------------------------------------------------------>
<?php

    $pendingappointment="SELECT * FROM tbl_appointment INNER JOIN tbl_staff_registry 
        ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
        WHERE NOT EXISTS(SELECT * FROM tbl_appointment_detail 
        WHERE tbl_appointment.appointment_id = tbl_appointment_detail.appointment_id) 
        AND tbl_student_registry.student_id = '$student_id' AND tbl_appointment.status = 'Pending' 
        ORDER BY date_created ASC";
    
    $pending_appointment_list = mysqli_query($db, $pendingappointment);
                
    //check whether the query is executed or not
    if($pending_appointment_list==TRUE) 
    { // count rows to check whether we have data in database or not
        $count = mysqli_num_rows($pending_appointment_list);  //function to get all the rows in database
        //check the num of rows                 
        if($count>0) //we have data in database
        {
            $i = 1;
            while($rows=mysqli_fetch_assoc($pending_appointment_list)) 
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
                    <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p>
                    <p><span>Appointment ID:</span> <?php echo $rows['appointment_id']; ?></p>
                    <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                    <p><span>My Note:</span><pre><?php echo $rows['note']; ?></pre></p>
                </div>
                <hr>
<?php 
            }
        }
        else{
            echo "No Pending Appointments.";
        }
    }

?>
<!----------------Shows Student's Pending Appointments------------------------------------------------------------>