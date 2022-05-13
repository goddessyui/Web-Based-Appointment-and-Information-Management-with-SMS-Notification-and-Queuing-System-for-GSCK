
<!----------------Shows Student's Pending Appointments------------------------------------------------------------>
<div class="table_pending">
<table class="pending_appnt">
    <tr class="pending_label">
        <th>#</th>
        <th>Date Requested</th>
        <th>Appointment ID</th>
        <th>Appointment Type</th>
        <th>Note</th>
    </tr>
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
                <tr class="pending_row">
                    <td>
                        <?php   echo $i;
                                $i++; 
                        ?>
                    </td>
                    <td><?php echo $rows['date_created']; ?></td>
                    <td><?php echo $rows['appointment_id']; ?></td>
                    <td><?php echo $rows['appointment_type']; ?></td>
                    <td><?php echo $rows['note']; ?></pre></p>
                </tr>
                
<?php 
            }
        }
        else{
            echo "No Pending Appointments.";
        }
    }

?>
</table>
</div>
<!----------------Shows Student's Pending Appointments------------------------------------------------------------>


<style>
    .table_pending {
        width: 100%;
        overflow-x: auto;
    }
    .pending_appnt {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;

    }
    .pending_appnt th {
        padding: 15px;
        background: #fff;
        border: none;
        font-family: 'Roboto';
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 400;
        text-align: left;
    }
    .pending_appnt td {
        padding: 15px;
        font-family: 'Roboto';
        font-size: 13px;
        color: #333;
    }
    tr {
        background: #fff;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2
    }
</style>