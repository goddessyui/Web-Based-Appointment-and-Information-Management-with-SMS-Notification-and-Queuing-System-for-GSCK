
<!----------------Shows Student's Cancelled Appointments------------------------------------------------------------>
<?php

    $cancelledappointments="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
        tbl_appointment.note, tbl_appointment_detail.comment
        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Cancelled' 
        ORDER BY tbl_appointment_detail.appointment_date DESC";
    
    $cancelled_appointment_list = mysqli_query($db, $cancelledappointments);
                
    //check whether the query is executed or not
    if($cancelled_appointment_list==TRUE) 
    { // count rows to check whether we have data in database or not
        $count = mysqli_num_rows($cancelled_appointment_list);  //function to get all the rows in database
        //check the num of rows                 
        if($count>0) //we have data in database
        {
            $i = 1;
            while($rows=mysqli_fetch_assoc($cancelled_appointment_list)) 
            {//using while loop to get all the date from database
            //and while loop will run as long as we have data in database
            
?>
                <div>
                    <td>
                        <?php   echo $i;
                                $i++; 
                        ?>
                    </td>
                    <p><span>Date Cancelled: </span><?php echo $rows['appointment_date']; ?></p>
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
            echo "No Cancelled Appointments.";
        }
    }

?>
<!----------------Shows Student's Declined/Cancelled Appointments------------------------------------------------------------>