
<!----------------Shows Student's Cancelled Appointments------------------------------------------------------------>
<div class="cancelled_appnt">
    <table>
        <tr>
            <th>#</th>
            <th>Date Cancelled</th>
            <th>Appointment Date</th>
            <th>Date Requested</th>
            <th>Appointment ID</th>
            <th>Note</th>
            <th>Appointment Type</th>
            <th>Staff</th>
            <th>Comment</th>
        </tr>

<?php
if (isset($_GET['apde'])){
    $theapde = $_GET['apde'];
    $cancelledappointments="SELECT tbl_appointment_detail.date_accepted, tbl_appointment_detail.appointment_date, 
        tbl_appointment.date_created, tbl_appointment.appointment_id, 
        appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
        tbl_appointment.note, tbl_appointment_detail.comment
        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Cancelled'
        AND tbl_appointment.appointment_id = '$theapde'";
}
else {
    $cancelledappointments="SELECT tbl_appointment_detail.date_accepted, tbl_appointment_detail.appointment_date, 
        tbl_appointment.date_created, tbl_appointment.appointment_id, 
        appointment_type, tbl_staff_registry.first_name, tbl_staff_registry.last_name, 
        tbl_appointment.note, tbl_appointment_detail.comment
        FROM tbl_appointment_detail INNER JOIN tbl_appointment 
        ON tbl_appointment_detail.appointment_id = tbl_appointment.appointment_id 
        INNER JOIN tbl_staff_registry ON tbl_appointment.staff_id = tbl_staff_registry.staff_id 
        INNER JOIN tbl_student_registry ON tbl_appointment.student_id = tbl_student_registry.student_id 
        WHERE tbl_student_registry.student_id = '$student_id' AND tbl_appointment_detail.status = 'Cancelled' 
        ORDER BY tbl_appointment_detail.date_accepted DESC";
}
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
                <tr>
                    <td>
                        <?php   echo $i;
                                $i++; 
                        ?>
                    </td>

                    <td><?php echo $rows['date_accepted']; ?></td>
                    <td><?php echo $rows['appointment_date']; ?></td>
                    <td><?php echo $rows['date_created']; ?></p>
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
            echo "No Cancelled Appointments.";
        }
    }

?>
<!----------------Shows Student's Declined/Cancelled Appointments------------------------------------------------------------>
    </table>
</div>





<style>
     .cancelled_appnt {
        width: 100%;
        overflow-x: auto;
    }
    .cancelled_appnt table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;

    }
    .cancelled_appnt table th {
        padding: 15px;
        background: #fff;
        border: none;
        font-family: 'Roboto';
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 400;
        text-align: left;
    }
    .cancelled_appnt table td {
        padding: 15px;
        font-family: 'Roboto';
        font-size: 13px;
        color: #333;
    }
    .cancelled_appnt table tr {
        background: #fff;
    }
    .cancelled_appnt table tr:nth-child(even) {
        background-color: #f2f2f2
    }
</style>