
<!----------------Shows Student's Declined Appointments------------------------------------------------------------>
<div class="declined_appnt">
    <table>
        <tr>
            <th>#</th>
            <th>Date Declined</th>
            <th>Date Requested</th>
            <th>Appointment ID</th>
            <th>Note</th>
            <th>Appointment Type</th>
            <th>Staff</th>
        </tr>

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
                <tr>
                    <td>
                        <?php   echo $i;
                                $i++; 
                        ?>
                    </td>
                    <td><?php echo $rows['date_accepted']; ?></td>
                    <td><?php echo $rows['date_created']; ?></td>
                    <td><?php echo $rows['appointment_id']; ?></td>
                    <td><?php echo $rows['note']; ?></td>
                    <td><?php echo $rows['appointment_type']; ?></td>
                    <td><?php echo $rows['first_name']. " ". $rows['last_name']; ?></td>
                </tr>

<?php 
            }
        }
        else {
            echo "No Declined Appointments.";
        }
    }

?>
<!----------------Shows Student's Declined/Cancelled Appointments------------------------------------------------------------>
</table>
</div>




<style>
     .declined_appnt {
        width: 100%;
        overflow-x: auto;
    }
    .declined_appnt table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;

    }
    .declined_appnt table th {
        padding: 15px;
        background: #fff;
        border: none;
        font-family: 'Roboto';
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 400;
        text-align: left;
    }
    .declined_appnt table td {
        padding: 15px;
        font-family: 'Roboto';
        font-size: 13px;
        color: #333;
    }
    .declined_appnt table tr {
        background: #fff;
    }
    .declined_appnt table tr:nth-child(even) {
        background-color: #f2f2f2
    }
</style>