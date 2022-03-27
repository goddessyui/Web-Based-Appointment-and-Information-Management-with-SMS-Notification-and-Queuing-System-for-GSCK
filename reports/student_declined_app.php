
<!----------------Shows Student's Declined Appointments------------------------------------------------------------>
<?php

    $declinedappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
        tbl_appointment.note, tbl_appointment_detail.comment
        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Declined' 
        ORDER BY appointment_date DESC";
    
    $declined_appointment_list = mysqli_query($db, $declinedappointment);
                
    //check whether the query is executed or not
    if($declined_appointment_list==TRUE) 
    { // count rows to check whether we have data in database or not
        $count = mysqli_num_rows($declined_appointment_list);  //function to get all the rows in database
        //check the num of rows                 
        if($count>0) //we have data in database
        {
            $i = 1;
            while($rows=mysqli_fetch_assoc($declined_appointment_list)) 
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
                    <p><span>Date Declined: </span><?php echo $rows['appointment_date']; ?></p>
                    <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p>
                    <p><span>Appointment ID:</span> <?php echo $rows['appointment_id']; ?></p>
                    <p><span>My Note:</span><pre><?php echo $rows['note']; ?></pre></p>
                    <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                    <p><span>Staff: </span><?php echo $rows['first_name']. " ". $rows['last_name']; ?></p>
                    <p><span>Staff's Comment:</span><pre><?php echo $rows['comment']; ?></pre></p>
                </div>
                <hr>
<?php 
            }
        }
        else {
            echo "No Declined Appointments.";
        }
    }

?>
<!----------------Shows Student's Declined/Cancelled Appointments------------------------------------------------------------>