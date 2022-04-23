
<!----------------Shows Student's Declined Appointments------------------------------------------------------------>
<?php
if (isset($_GET['apde'])){
    
    $declinedappointment="SELECT tbl_appointment_detail.date_accepted,
        tbl_appointment.date_created, tbl_appointment.appointment_id, 
        appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
        tbl_appointment.note, tbl_appointment_detail.comment
        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status='Declined'
        AND tbl_appointment_detail.appointment_id = '".$_GET['apde']."' 
        ORDER BY tbl_appointment_detail.date_accepted DESC";
}
else {
    $declinedappointment="SELECT tbl_appointment_detail.date_accepted,
        tbl_appointment.date_created, tbl_appointment.appointment_id, 
        appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
        tbl_appointment.note, tbl_appointment_detail.comment
        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Declined' 
        ORDER BY tbl_appointment_detail.date_accepted DESC";
}
    $declined_appointment_list = mysqli_query($db, $declinedappointment);
                
    if($declined_appointment_list==TRUE) 
    { 
        $count = mysqli_num_rows($declined_appointment_list);  
                      
        if($count>0) 
        {
            $i = 1;
            while($rows=mysqli_fetch_assoc($declined_appointment_list)) {
?>
                <div>
                    <td>
                        <?php   echo $i;
                                $i++; 
                        ?>
                    </td>
                    <p><span>Date Declined: </span><?php echo $rows['date_accepted']; ?></p>
                    <p><span>Date Requested: </span><?php echo $rows['date_created']; ?></p>
                    <p><span>Appointment ID:</span> <?php echo $rows['appointment_id']; ?></p>
                    <p><span>My Note:</span><pre><?php echo $rows['note']; ?></pre></p>
                    <p><span>Appointment Type: </span><?php echo $rows['appointment_type']; ?></p>
                    <p><span>Staff: </span><?php echo $rows['first_name']. " ". $rows['last_name']; ?></p>
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