<div class="past_appnt">
    <table>
        <tr>
            <th>#</th>
            <th>Appointment Date</th>
            <th>Date Requested</th>
            <th>Appointment ID</th>
            <th>Note</th>
            <th>Appointment Type</th>
            <th>Staff</th>
            <th>Comment</th>
        </tr>
<!----------------Shows Student's Done Appointments------------------------------------------------------------>
<?php

    $doneappointment="SELECT tbl_appointment_detail.appointment_date, tbl_appointment.date_created, 
        tbl_appointment.appointment_id, appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
        tbl_appointment.note, tbl_appointment_detail.comment
        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Done' 
        ORDER BY appointment_date DESC";
    
    $done_appointment_list = mysqli_query($db, $doneappointment);
                
    //check whether the query is executed or not
    if($done_appointment_list==TRUE) 
    { // count rows to check whether we have data in database or not
        $count = mysqli_num_rows($done_appointment_list);  //function to get all the rows in database
        //check the num of rows                 
        if($count>0) //we have data in database
        {
            $i = 1;
            while($rows=mysqli_fetch_assoc($done_appointment_list)) 
            //using while loop to get all the date from database
            //and while loop will run as long as we have data in database
            {
?>
                <tr>
                    <td>
                        <?php   echo $i;
                                $i++; 
                        ?>
                    </td>

                    <td><?php echo $rows['appointment_date']; ?></td>
                    <td><?php echo $rows['date_created']; ?></td>
                    <td><?php echo $rows['appointment_id']; ?></td>
                    <td><?php echo $rows['note']; ?></td>
                    <td><?php echo $rows['appointment_type']; ?></td>
                    <td><?php echo $rows['first_name']. " ". $rows['last_name']; ?></td>
                    <td><?php echo $rows['comment']; ?></td>
                </tr>
      
<?php 
            }
        }
        else {
            echo "No Past Appointments.";
        }
    }

?>
<!----------------Shows Student's Done Appointments------------------------------------------------------------>
    </table>
</div>




<style>
     .past_appnt {
        width: 100%;
        overflow-x: auto;
    }
    .past_appnt table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;

    }
    .past_appnt table th {
        padding: 15px;
        background: #fff;
        border: none;
        font-family: 'Roboto';
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 400;
        text-align: left;
    }
    .past_appnt table td {
        padding: 15px;
        font-family: 'Roboto';
        font-size: 13px;
        color: #333;
    }
    .past_appnt table tr {
        background: #fff;
    }
    .past_appnt table tr:nth-child(even) {
        background-color: #f2f2f2
    }
</style>